<?php

namespace TSS\AutomailerBundle\Library;

use Symfony\Component\DependencyInjection\ContainerInterface;
use TSS\AutomailerBundle\Entity\Automailer as AmEntity;
use TSS\AutomailerBundle\Document\Automailer as AmDocument;

class AutomailerSpool extends \Swift_ConfigurableSpool
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    private $container;

    private $automailerClass;

    /**
     * Create a new AutomailerSpool.
     *
     * @param ContainerInterface $container
     *
     * @throws \Swift_IoException
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->automailerClass = $container->getParameter('tss_automailer.class');
    }

    /**
     * Tests if this Spool mechanism has started.
     *
     * @return bool
     */
    public function isStarted()
    {
        return true;
    }

    /**
     * Starts this Spool mechanism.
     */
    public function start()
    {
    }

    /**
     * Stops this Spool mechanism.
     */
    public function stop()
    {
    }

    /**
     * @return AmEntity|AmDocument
     *
     * @throws \InvalidArgumentException
     */
    protected function newMail()
    {
        $class = $this->container->getParameter('tss_automailer.class');

        return new $class();
    }

    protected function getManager()
    {
        return $this->container->get('tss_automailer.manager');
    }

    protected function save($mail)
    {
        $manager = $this->getManager();
        $manager->persist($mail);
        $manager->flush();
    }

    /**
     * Queues a message.
     *
     * @param \Swift_Mime_Message $message The message to store
     *
     * @return bool
     *
     * @throws \Swift_IoException
     */
    public function queueMessage(\Swift_Mime_Message $message)
    {
        $mail = $this->newMail();
        $mail->setSubject($message->getSubject());
        $fromArray = $message->getFrom();
        $fromArrayKeys = array_keys($fromArray);
        $mail->setFromEmail($fromArrayKeys[0]);
        $mail->setFromName(isset($fromArray[$fromArrayKeys[0]]) ? $fromArray[$fromArrayKeys[0]] : $fromArrayKeys[0]);
        $toArray = $message->getTo();
        $toArrayKeys = array_keys($toArray);
        $mail->setToEmail($toArrayKeys[0]);
        $mail->setBody($message->getBody());
        $mail->setAltBody(strip_tags(preg_replace(
            array(
                '@<head[^>]*?>.*?</head>@siu',
                '@<style[^>]*?>.*?</style>@siu',
                '@<script[^>]*?.*?</script>@siu',
                '@<noscript[^>]*?.*?</noscript>@siu',
            ),
            '',
            $message->getBody()
        )));
        $mail->setIsHtml(($message->getContentType() == 'text/html') ? true : false);
        $mail->setSwiftMessage($message);

        $this->save($mail);
    }

    /**
     * Execute a recovery if for anyreason a process is sending for too long.
     */
    public function recover($timeout = 900)
    {
        return $this->getManager()->getRepository($this->automailerClass)->recoverSending($timeout);
    }

    /**
     * Sends messages using the given transport instance.
     *
     * @param \Swift_Transport $transport         A transport instance
     * @param string[]         &$failedRecipients An array of failures by-reference
     *
     * @return int The number of sent emails
     */
    public function flushQueue(\Swift_Transport $transport, &$failedRecipients = null)
    {
        if (!$transport->isStarted()) {
            $transport->start();
        }

        $failedRecipients = (array) $failedRecipients;
        $count = 0;
        $time = time();

        $limit = !$this->getMessageLimit() ? 50 : $this->getMessageLimit();

        $mails = $this->getManager()->getRepository($this->automailerClass)->findNext($limit);

        //first mark all for sending
        foreach ($mails as $mail) {
            $mail->setIsSending(true);
            $mail->setStartedSendingAt(new \DateTime());
            $this->save($mail);
        }

        reset($mails);

        foreach ($mails as $mail) {
            if ($transport->send($mail->getSwiftMessage(), $failedRecipients)) {
                ++$count;
                $mail->setIsSending(false);
                $mail->setIsSent(true);
                $mail->setSentAt(new \DateTime());
            } else {
                $mail->setIsSending(false);
                $mail->setIsFailed(true);
            }
            $this->save($mail);

            if ($this->getMessageLimit() && $count >= $this->getMessageLimit()) {
                break;
            }

            if ($this->getTimeLimit() && (time() - $time) >= $this->getTimeLimit()) {
                break;
            }
        }

        return $count;
    }
}

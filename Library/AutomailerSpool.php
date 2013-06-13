<?php

namespace TSS\AutomailerBundle\Library;

use TSS\AutomailerBundle\Entity\Automailer as Am;

class AutomailerSpool extends \Swift_ConfigurableSpool
{
    /**
     * The Entity Manager
     */
    private $_em;

    /**
     * Create a new AutomailerSpool.
     * @param  Doctrine\EntityManager $em
     * @throws Swift_IoException
     */
    public function __construct($em)
    {
        $this->_em = $em;
    }

    /**
     * Tests if this Spool mechanism has started.
     *
     * @return boolean
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
     * Queues a message.
     * @param  Swift_Mime_Message $message The message to store
     * @return boolean
     * @throws Swift_IoException
     */
    public function queueMessage(\Swift_Mime_Message $message)
    {
        $mail = new Am;
    	$mail->setSubject($message->getSubject());
    	$fromArray = $message->getFrom();
    	$fromArrayKeys = array_keys($fromArray);
    	$mail->setFromEmail($fromArrayKeys[0]);
    	$mail->setFromName($fromArray[$fromArrayKeys[0]]);
    	$toArray = $message->getTo();
    	$toArrayKeys = array_keys($toArray);
    	$mail->setToEmail($toArrayKeys[0]);
    	$mail->setBody($message->getBody());
    	$mail->setAltBody(strip_tags($message->getBody()));
    	$mail->setIsHtml(($message->getContentType()=='text/html')?1:0);    
    	$mail->setSwiftMessage($message);	
    	
    	$this->_em->persist($mail);
        $this->_em->flush();
    }

    /**
     * Execute a recovery if for anyreason a process is sending for too long
     */
    public function recover($timeout = 900)
    {
        return $this->_em->getRepository("TSSAutomailerBundle:Automailer")->recoverSending($timeout);
    }

    /**
     * Sends messages using the given transport instance.
     *
     * @param Swift_Transport $transport A transport instance
     * @param string[]        &$failedRecipients An array of failures by-reference
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
        
        $mails = $this->_em->getRepository("TSSAutomailerBundle:Automailer")->findNext($limit);

        //first mark all for sending
        foreach ($mails as $mail) {
            
            $mail->setIsSending(true);
            $mail->setStartedSendingAt(new \DateTime());
            $this->_em->persist($mail);
            $this->_em->flush();
        }

        foreach ($mails as $mail) {
            if($transport->send($mail->getSwiftMessage(), $failedRecipients))
            {
                $count++;
                
                $mail->setIsSending(false);
                $mail->setIsSent(true);
                $mail->setSentAt(new \DateTime());
                $this->_em->persist($mail);
                $this->_em->flush();
            }
            else {
                $mail->setIsSending(false);
                $mail->setIsFailed(true);
                $this->_em->persist($mail);
                $this->_em->flush();
            }

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
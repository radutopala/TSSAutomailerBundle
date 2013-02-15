<?php

namespace TSS\AutomailerBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;

/**
 * Send Emails from the spool.
 *
 * @author Radu Topala <radu.topala@trisoft.ro>
 */
class SendEmailCommand extends ContainerAwareCommand
{
    /**
     * @see Command
     */
    protected function configure()
    {
        $this
            ->setName('automailer:spool:send')
            ->setDescription('Sends emails from the spool')
            ->addOption('message-limit', 0, InputOption::VALUE_OPTIONAL, 'The maximum number of messages to send.')
            ->addOption('time-limit', 0, InputOption::VALUE_OPTIONAL, 'The time limit for sending messages (in seconds).')
            ->addOption('recover-timeout', 0, InputOption::VALUE_OPTIONAL, 'The timeout for recovering messages that have taken too long to send (in seconds).')
            ->setHelp(<<<EOF
The <info>automailer:spool:send</info> command sends all emails from the spool.

<info>php app/console automailer:spool:send --message-limit=10 --time-limit=10 --recover-timeout=900</info>

EOF
            )
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $mailer     = $this->getContainer()->get('mailer');
        $transport  = $mailer->getTransport();

        if ($transport instanceof \Swift_Transport_SpoolTransport) {
            $spool = $transport->getSpool();
            if ($spool instanceof \TSS\AutomailerBundle\Library\AutomailerSpool) {
                $spool->setMessageLimit($input->getOption('message-limit'));
                $spool->setTimeLimit($input->getOption('time-limit'));

                if (null !== $input->getOption('recover-timeout')) {
                    $spool->recover($input->getOption('recover-timeout'));
                } else {
                    $spool->recover();
                }
            }
            $sent = $spool->flushQueue($this->getContainer()->get('swiftmailer.transport.real'));

            $output->writeln(sprintf('sent %s emails', $sent));
        }
    }
}

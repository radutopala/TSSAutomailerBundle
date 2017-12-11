<?php

namespace TSS\AutomailerBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class EmailTestCommand extends ContainerAwareCommand
{
    protected function _getEm()
    {
        return $this->getContainer()->get('doctrine')->getEntityManager();
    }

    protected function _getRepo($repo)
    {
        return $this->_getEm()->getRepository($repo);
    }

    public function configure()
    {
        $this
            ->setName('automailer:test')
            ->addArgument('email', InputArgument::REQUIRED, 'your test email')
            ->setDescription('Send Test Email');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $message = new \Swift_Message();
        $message->setSubject('Automailer test email '.uniqid());
        $message->setFrom('info@trisoft.ro', 'Tri Software Solutions');
        $message->setTo($input->getArgument('email'));
        $message->setBody($this->getContainer()->get('templating')->render('TSSAutomailerBundle:Email:test.html.twig', array('email' => $input->getArgument('email'))), 'text/html');
        $this->getContainer()->get('mailer')->send($message);
    }
}

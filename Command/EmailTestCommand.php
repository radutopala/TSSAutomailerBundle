<?php

namespace TSS\AutomailerBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\ORM\Query\ResultSetMapping;

use Symfony\Component\HttpFoundation\Request;

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
            ->addOption('email', null, InputOption::VALUE_REQUIRED, 'email')
            ->setDescription('Send Test Email');
    }
    
    protected function execute(InputInterface $input, OutputInterface $output)
    {            
        $message = \Swift_Message::newInstance();
        $message->setSubject("Automailer test email ".uniqid());
        $message->setFrom('info@trisoft.ro', 'Tri Software Solutions');
        $message->setTo($input->getOption('email'));
        $message->setBody($this->getContainer()->get('templating')->render("TSSAutomailerBundle:Email:test.html.twig",array('email' => $input->getOption('email'))), 'text/html');
        $this->getContainer()->get('mailer')->send($message);
        
    }
}
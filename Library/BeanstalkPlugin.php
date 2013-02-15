<?php

namespace TSS\AutomailerBundle\Library;

/**
 * Beanstalk queuing plugin for Swiftmailer
 *
 * @package    Automailer
 * @author     Radu Topala
 */
class BeanstalkPlugin implements \Swift_Events_SendListener
{

    public $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    /**
     * Not used.
     */
    public function beforeSendPerformed(\Swift_Events_SendEvent $evt)
    {
    }

    /**
     * Invoked immediately after the Message is sent.
     *
     * @param Swift_Events_SendEvent $evt
     */
    public function sendPerformed(\Swift_Events_SendEvent $evt)
    {
        if($this->container->has("leezy.pheanstalk")) {

            //put a job into pheanstalk default connection, in automailer queue
            $pheanstalk = $this->container->get("leezy.pheanstalk");

            $pheanstalk
                ->useTube('automailer')
                ->put("automailer:spool:send --time-limit=10");
        }
    }
}

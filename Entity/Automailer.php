<?php

namespace TSS\AutomailerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TSS\AutomailerBundle\Entity\Automailer
 * @ORM\Table(
 *     name="automailer",
 *     indexes={
 *         @ORM\Index(name="find_next", columns={"is_sent", "is_failed", "is_sending", "created_at"}),
 *         @ORM\Index(name="recover_sending", columns={"is_sending", "started_sending_at"}),
 *     }
 * )
 * @ORM\Entity(repositoryClass="TSS\AutomailerBundle\Entity\AutomailerRepository")
 */
class Automailer
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     * 
     * @var integer $id
     */
    private $id;
    
    /**
     * @var string $fromEmail
     * 
     * @ORM\Column(name="from_email", type="string", length=255, nullable=false)
     */
    private $fromEmail;
    
    /**
     * @var string $fromName
     * 
     * @ORM\Column(name="from_name", type="string", length=255)
     */
    private $fromName;
    
    /**
     * @var string $toEmail
     * 
     * @ORM\Column(name="to_email", type="string", length=255, nullable=false)
     */
    private $toEmail;
    
    /**
	 * @var text $subject
	 *
	 * @ORM\Column(name="subject", type="text", nullable=false)
	 *
	 */
	private $subject;
	
	/**
	 * @var text $body
	 *
	 * @ORM\Column(name="body", type="text", nullable=false)
	 *
	 */
	private $body;
	
	/**
	 * @var text $altBody
	 *
	 * @ORM\Column(name="alt_body", type="text", nullable=false)
	 *
	 */
	private $altBody;
	
	/**
	 * @var text $swift_message
	 *
	 * @ORM\Column(name="swift_message", type="text", nullable=false)
	 *
	 */
	private $swiftMessage;
            
    /**
     * @var datetime $createdAt
     * 
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    private $createdAt;       
    
    /**
     * @var datetime $sentAt
     * 
     * @ORM\Column(name="sent_at", type="datetime", nullable=true)
     */
    private $sentAt;

    /**
     * @var datetime $startedSendingAt
     *
     * @ORM\Column(name="started_sending_at", type="datetime", nullable=true)
     */
    private $startedSendingAt;
    
    /**
     * @var boolean $isHtml
     *
     * @ORM\Column(name="is_html", type="boolean", nullable=false)
     */
    private $isHtml;
    
    /**
     * @var boolean $isSending
     *
     * @ORM\Column(name="is_sending", type="boolean", nullable=true)
     */
    private $isSending;
    
    /**
     * @var boolean $isSent
     *
     * @ORM\Column(name="is_sent", type="boolean", nullable=true)
     */
    private $isSent;
    
    /**
     * @var boolean $isFailed
     *
     * @ORM\Column(name="is_failed", type="boolean", nullable=true)
     */
    private $isFailed;
    
    
    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->isHtml = 1;
        $this->isSending = 0;
        $this->isSent = 0;
        $this->isFailed = 0;
    }
        
    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set fromEmail
     *
     * @param string $fromEmail
     * @return Automailer
     */
    public function setFromEmail($fromEmail)
    {
        $this->fromEmail = $fromEmail;
        return $this;
    }

    /**
     * Get fromEmail
     *
     * @return string 
     */
    public function getFromEmail()
    {
        return $this->fromEmail;
    }

    /**
     * Set fromName
     *
     * @param string $fromName
     * @return Automailer
     */
    public function setFromName($fromName)
    {
        $this->fromName = $fromName;
        return $this;
    }

    /**
     * Get fromName
     *
     * @return string 
     */
    public function getFromName()
    {
        return $this->fromName;
    }

    /**
     * Set toEmail
     *
     * @param string $toEmail
     * @return Automailer
     */
    public function setToEmail($toEmail)
    {
        $this->toEmail = $toEmail;
        return $this;
    }

    /**
     * Get toEmail
     *
     * @return string 
     */
    public function getToEmail()
    {
        return $this->toEmail;
    }

    /**
     * Set subject
     *
     * @param text $subject
     * @return Automailer
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * Get subject
     *
     * @return text 
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set body
     *
     * @param text $body
     * @return Automailer
     */
    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    /**
     * Get body
     *
     * @return text 
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set altBody
     *
     * @param text $altBody
     * @return Automailer
     */
    public function setAltBody($altBody)
    {
        $this->altBody = $altBody;
        return $this;
    }

    /**
     * Get altBody
     *
     * @return text 
     */
    public function getAltBody()
    {
        return $this->altBody;
    }

    /**
     * Set createdAt
     *
     * @param datetime $createdAt
     * @return Automailer
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * Get createdAt
     *
     * @return datetime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set sentAt
     *
     * @param datetime $sentAt
     * @return Automailer
     */
    public function setSentAt($sentAt)
    {
        $this->sentAt = $sentAt;
        return $this;
    }

    /**
     * Get sentAt
     *
     * @return datetime
     */
    public function getSentAt()
    {
        return $this->sentAt;
    }

    /**
     * Get startedSendingAt
     *
     * @return datetime 
     */
    public function getStartedSendingAt()
    {
        return $this->startedSendingAt;
    }

    /**
     * Set startedSendingAt
     *
     * @param datetime $startedSendingAt
     * @return Automailer
     */
    public function setStartedSendingAt($startedSendingAt)
    {
        $this->startedSendingAt = $startedSendingAt;
        return $this;
    }

    /**
     * Set isHtml
     *
     * @param boolean $isHtml
     * @return Automailer
     */
    public function setIsHtml($isHtml)
    {
        $this->isHtml = $isHtml;
        return $this;
    }

    /**
     * Get isHtml
     *
     * @return boolean 
     */
    public function getIsHtml()
    {
        return $this->isHtml;
    }

    /**
     * Set isSent
     *
     * @param boolean $isSent
     * @return Automailer
     */
    public function setIsSent($isSent)
    {
        $this->isSent = $isSent;
        return $this;
    }

    /**
     * Get isSent
     *
     * @return boolean 
     */
    public function getIsSent()
    {
        return $this->isSent;
    }

    /**
     * Set isFailed
     *
     * @param boolean $isFailed
     * @return Automailer
     */
    public function setIsFailed($isFailed)
    {
        $this->isFailed = $isFailed;
        return $this;
    }

    /**
     * Get isFailed
     *
     * @return boolean 
     */
    public function getIsFailed()
    {
        return $this->isFailed;
    }

    /**
     * Set isSending
     *
     * @param boolean $isSending
     * @return Automailer
     */
    public function setIsSending($isSending)
    {
        $this->isSending = $isSending;
        return $this;
    }

    /**
     * Get isSending
     *
     * @return boolean 
     */
    public function getIsSending()
    {
        return $this->isSending;
    }

    /**
     * Set swiftMessage
     *
     * @param text $swiftMessage
     * @return Automailer
     */
    public function setSwiftMessage($swiftMessage)
    {
        $this->swiftMessage = serialize($swiftMessage);
        return $this;
    }

    /**
     * Get swiftMessage
     *
     * @return text 
     */
    public function getSwiftMessage()
    {
        return unserialize($this->swiftMessage);
    }
}
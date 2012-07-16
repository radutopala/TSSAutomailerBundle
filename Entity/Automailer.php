<?php

namespace TSS\AutomailerBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TSS\AutomailerBundle\Entity\Automailer
 * @ORM\Table(name="automailer")
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
    public $id;
    
    /**
     * @var string $fromEmail
     * 
     * @ORM\Column(name="from_email", type="string", length=255, nullable=false)
     */
    public $fromEmail;
    
    /**
     * @var string $fromName
     * 
     * @ORM\Column(name="from_name", type="string", length=255)
     */
    public $fromName;
    
    /**
     * @var string $toEmail
     * 
     * @ORM\Column(name="to_email", type="string", length=255, nullable=false)
     */
    public $toEmail;
    
    /**
	 * @var text $subject
	 *
	 * @ORM\Column(name="subject", type="text", nullable=false)
	 *
	 */
	public $subject;
	
	/**
	 * @var text $body
	 *
	 * @ORM\Column(name="body", type="text", nullable=false)
	 *
	 */
	public $body;
	
	/**
	 * @var text $altBody
	 *
	 * @ORM\Column(name="alt_body", type="text", nullable=false)
	 *
	 */
	public $altBody;
	
	/**
	 * @var text $swift_message
	 *
	 * @ORM\Column(name="swift_message", type="text", nullable=false)
	 *
	 */
	public $swiftMessage;
            
    /**
     * @var datetime $createdAt
     * 
     * @ORM\Column(name="created_at", type="datetime", nullable=false)
     */
    public $createdAt;       
    
    /**
     * @var datetime $sentAt
     * 
     * @ORM\Column(name="sent_at", type="datetime", nullable=true)
     */
    public $sentAt;
    
    /**
     * @var boolean $isHtml
     *
     * @ORM\Column(name="is_html", type="boolean", nullable=false)
     */
    public $isHtml;
    
    /**
     * @var boolean $isSending
     *
     * @ORM\Column(name="is_sending", type="boolean", nullable=true)
     */
    public $isSending;
    
    /**
     * @var boolean $isSent
     *
     * @ORM\Column(name="is_sent", type="boolean", nullable=true)
     */
    public $isSent;
    
    /**
     * @var boolean $isFailed
     *
     * @ORM\Column(name="is_failed", type="boolean", nullable=true)
     */
    public $isFailed;
    
    
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
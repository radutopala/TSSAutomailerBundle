<?php

namespace TSS\AutomailerBundle\Document;


use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;

/**
 * TSS\AutomailerBundle\Document\Automailer
 * @ODM\Indexes({
 *   @ODM\Index(name="find_next", keys={"is_sent", "is_failed", "is_sending", "created_at"}),
 *   @ODM\Index(name="recover_sending", keys={"is_sending", "started_sending_at"}),
 * })
 * @ODM\Document(collection="automailer", repositoryClass="TSS\AutomailerBundle\Document\AutomailerRepository")
 */
class Automailer
{
    /**
     * @ODM\Id
     *
     * @var integer $id
     */
    private $id;

    /**
     * @var string $fromEmail
     *
     * @ODM\String(name="from_email", nullable=false)
     */
    private $fromEmail;

    /**
     * @var string $fromName
     *
     * @ODM\String(name="from_name")
     */
    private $fromName;

    /**
     * @var string $toEmail
     *
     * @ODM\String(name="to_email", nullable=false)
     */
    private $toEmail;

    /**
     * @var text $subject
     *
     * @ODM\String(name="subject", nullable=false)
     *
     */
    private $subject;

    /**
     * @var text $body
     *
     * @ODM\String(name="body", nullable=false)
     *
     */
    private $body;

    /**
     * @var text $altBody
     *
     * @ODM\String(name="alt_body", nullable=false)
     *
     */
    private $altBody;

    /**
     * @var text $swift_message
     *
     * @ODM\String(name="swift_message", nullable=false)
     *
     */
    private $swiftMessage;

    /**
     * @var datetime $createdAt
     *
     * @ODM\Date(name="created_at", nullable=false)
     */
    private $createdAt;

    /**
     * @var datetime $sentAt
     *
     * @ODM\Date(name="sent_at", nullable=true)
     */
    private $sentAt;

    /**
     * @var datetime $startedSendingAt
     *
     * @ODM\Date(name="started_sending_at", nullable=true)
     */
    private $startedSendingAt;

    /**
     * @var boolean $isHtml
     *
     * @ODM\Boolean(name="is_html", nullable=false)
     */
    private $isHtml;

    /**
     * @var boolean $isSending
     *
     * @ODM\Boolean(name="is_sending", nullable=true)
     */
    private $isSending;

    /**
     * @var boolean $isSent
     *
     * @ODM\Boolean(name="is_sent", nullable=true)
     */
    private $isSent;

    /**
     * @var boolean $isFailed
     *
     * @ODM\Boolean(name="is_failed", nullable=true)
     */
    private $isFailed;


    public function __construct()
    {
        $this->createdAt = new \DateTime();
        $this->isHtml = true;
        $this->isSending = false;
        $this->isSent = false;
        $this->isFailed = false;
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
        $this->isSending = (bool)$isSending;
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
        $this->swiftMessage = base64_encode(serialize($swiftMessage));
        return $this;
    }

    /**
     * Get swiftMessage
     *
     * @return text
     */
    public function getSwiftMessage()
    {
        return unserialize(base64_decode($this->swiftMessage));
    }
}

<?php

namespace TSS\AutomailerBundle\Model;

class Automailer
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $fromEmail;

    /**
     * @var string
     */
    private $fromName;

    /**
     * @var string
     */
    private $toEmail;

    /**
     * @var string
     */
    private $subject;

    /**
     * @var string
     */
    private $body;

    /**
     * @var string
     */
    private $altBody;

    /**
     * @var string
     */
    private $swiftMessage;

    /**
     * @var \DateTime
     */
    private $createdAt;

    /**
     * @var \DateTime
     */
    private $sentAt;

    /**
     * @var \DateTime
     */
    private $startedSendingAt;

    /**
     * @var bool
     */
    private $isHtml;

    /**
     * @var bool
     */
    private $isSending;

    /**
     * @var bool
     */
    private $isSent;

    /**
     * @var bool
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
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set fromEmail.
     *
     * @param string $fromEmail
     *
     * @return Automailer
     */
    public function setFromEmail($fromEmail)
    {
        $this->fromEmail = $fromEmail;

        return $this;
    }

    /**
     * Get fromEmail.
     *
     * @return string
     */
    public function getFromEmail()
    {
        return $this->fromEmail;
    }

    /**
     * Set fromName.
     *
     * @param string $fromName
     *
     * @return Automailer
     */
    public function setFromName($fromName)
    {
        $this->fromName = $fromName;

        return $this;
    }

    /**
     * Get fromName.
     *
     * @return string
     */
    public function getFromName()
    {
        return $this->fromName;
    }

    /**
     * Set toEmail.
     *
     * @param string $toEmail
     *
     * @return Automailer
     */
    public function setToEmail($toEmail)
    {
        $this->toEmail = $toEmail;

        return $this;
    }

    /**
     * Get toEmail.
     *
     * @return string
     */
    public function getToEmail()
    {
        return $this->toEmail;
    }

    /**
     * Set subject.
     *
     * @param string $subject
     *
     * @return Automailer
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject.
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set body.
     *
     * @param string $body
     *
     * @return Automailer
     */
    public function setBody($body)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body.
     *
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set altBody.
     *
     * @param string $altBody
     *
     * @return Automailer
     */
    public function setAltBody($altBody)
    {
        $this->altBody = $altBody;

        return $this;
    }

    /**
     * Get altBody.
     *
     * @return string
     */
    public function getAltBody()
    {
        return $this->altBody;
    }

    /**
     * Set createdAt.
     *
     * @param \DateTime $createdAt
     *
     * @return Automailer
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt.
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set sentAt.
     *
     * @param \DateTime $sentAt
     *
     * @return Automailer
     */
    public function setSentAt($sentAt)
    {
        $this->sentAt = $sentAt;

        return $this;
    }

    /**
     * Get sentAt.
     *
     * @return \DateTime
     */
    public function getSentAt()
    {
        return $this->sentAt;
    }

    /**
     * Get startedSendingAt.
     *
     * @return \DateTime
     */
    public function getStartedSendingAt()
    {
        return $this->startedSendingAt;
    }

    /**
     * Set startedSendingAt.
     *
     * @param \DateTime $startedSendingAt
     *
     * @return Automailer
     */
    public function setStartedSendingAt($startedSendingAt)
    {
        $this->startedSendingAt = $startedSendingAt;

        return $this;
    }

    /**
     * Set isHtml.
     *
     * @param bool $isHtml
     *
     * @return Automailer
     */
    public function setIsHtml($isHtml)
    {
        $this->isHtml = $isHtml;

        return $this;
    }

    /**
     * Get isHtml.
     *
     * @return bool
     */
    public function getIsHtml()
    {
        return $this->isHtml;
    }

    /**
     * Set isSent.
     *
     * @param bool $isSent
     *
     * @return Automailer
     */
    public function setIsSent($isSent)
    {
        $this->isSent = $isSent;

        return $this;
    }

    /**
     * Get isSent.
     *
     * @return bool
     */
    public function getIsSent()
    {
        return $this->isSent;
    }

    /**
     * Set isFailed.
     *
     * @param bool $isFailed
     *
     * @return Automailer
     */
    public function setIsFailed($isFailed)
    {
        $this->isFailed = $isFailed;

        return $this;
    }

    /**
     * Get isFailed.
     *
     * @return bool
     */
    public function getIsFailed()
    {
        return $this->isFailed;
    }

    /**
     * Set isSending.
     *
     * @param bool $isSending
     *
     * @return Automailer
     */
    public function setIsSending($isSending)
    {
        $this->isSending = $isSending;

        return $this;
    }

    /**
     * Get isSending.
     *
     * @return bool
     */
    public function getIsSending()
    {
        return $this->isSending;
    }

    /**
     * Set swiftMessage.
     *
     * @param \Swift_Mime_Message $swiftMessage
     *
     * @return Automailer
     */
    public function setSwiftMessage($swiftMessage)
    {
        $this->swiftMessage = base64_encode(serialize($swiftMessage));

        return $this;
    }

    /**
     * Get swiftMessage.
     *
     * @return string
     */
    public function getSwiftMessage()
    {
        return unserialize(base64_decode($this->swiftMessage));
    }
}

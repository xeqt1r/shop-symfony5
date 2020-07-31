<?php

namespace App\Entity;

use DateTime;
use DateTimeInterface;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MessageRepository")
 */
class Message
{

    public function __construct()
    {
        $this->dateAdded = new DateTime("now");
    }

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $messageTitle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $messageContent;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateAdded;


    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User",inversedBy="userSenderMessage")
     */
    private $messageSender;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\User",inversedBy="userRecipientMessage")
     */
    private $messageRecipient;

    /**
     * @return User
     */
    public function getMessageSender(): User
    {
        return $this->messageSender;
    }

    /**
     * @param User $messageSender
     * @return Message
     */
    public function setMessageSender(User $messageSender): Message
    {
        $this->messageSender = $messageSender;
        return $this;
    }

    /**
     * @return User
     */
    public function getMessageRecipient(): User
    {
        return $this->messageRecipient;
    }

    /**
     * @param User $messageRecipient
     * @return Message
     */
    public function setMessageRecipient(User $messageRecipient)
    {
        $this->messageRecipient = $messageRecipient;
        return $this;
    }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessageTitle(): ?string
    {
        return $this->messageTitle;
    }

    public function setMessageTitle(string $messageTitle): self
    {
        $this->messageTitle = $messageTitle;

        return $this;
    }

    public function getMessageContent(): ?string
    {
        return $this->messageContent;
    }

    public function setMessageContent(string $messageContent): self
    {
        $this->messageContent = $messageContent;

        return $this;
    }

    public function getDateAdded(): ?DateTimeInterface
    {
        return $this->dateAdded;
    }

    public function setDateAdded(DateTimeInterface $dateAdded): self
    {
        $this->dateAdded = $dateAdded;

        return $this;
    }
}

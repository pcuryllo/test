<?php

namespace App\Model\Base;

use App\Model\User;
use Symfony\Component\Validator\Constraints as Assert;

abstract class BaseNotification implements NotificationInterface
{
    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min="3")
     */
    protected $title = null;

    /**
     * @var string|null
     * @Assert\Length(max="100")
     */
    protected $description = null;

    /**
     * @var \DateTime|null
     * @Assert\NotBlank()
     * @Assert\Type("\DateTime")
     */
    protected $dateOfSending = null;

    /**
     * @var User|null
     * @Assert\NotBlank()
     */
    protected $sender = null;

    /**
     * @var User|null
     * @Assert\NotBlank()
     */
    protected $recipient = null;

    /**
     * @var bool
     */
    protected $isSeen = false;

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     * @return BaseNotification
     */
    public function setTitle(?string $title): BaseNotification
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     * @return BaseNotification
     */
    public function setDescription(?string $description): BaseNotification
    {
        $this->description = $description;
        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getDateOfSending(): ?\DateTime
    {
        return $this->dateOfSending;
    }

    /**
     * @param \DateTime|null $dateOfSending
     * @return BaseNotification
     */
    public function setDateOfSending(\DateTime $dateOfSending): BaseNotification
    {
        $this->dateOfSending = $dateOfSending;
        return $this;
    }

    /**
     * @return User|null
     */
    public function getSender(): ?User
    {
        return $this->sender;
    }

    /**
     * @param User|null $sender
     * @return BaseNotification
     */
    public function setSender(?User $sender): BaseNotification
    {
        $this->sender = $sender;
        return $this;
    }

    /**
     * @return User|null
     */
    public function getRecipient(): ?User
    {
        return $this->recipient;
    }

    /**
     * @param User|null $recipient
     * @return BaseNotification
     */
    public function setRecipient(?User $recipient): BaseNotification
    {
        $this->recipient = $recipient;
        return $this;
    }

    /**
     * @return bool
     */
    public function isSeen(): bool
    {
        return $this->isSeen;
    }

    /**
     * @param bool $isSeen
     * @return BaseNotification
     */
    public function setIsSeen(bool $isSeen): BaseNotification
    {
        $this->isSeen = $isSeen;
        return $this;
    }

    /**
     * @return NotificationInterface
     */
    public function markAsSeen(): NotificationInterface
    {
        $this->isSeen = true;
        return $this;
    }

    /**
     * @return NotificationInterface
     */
    public function markAsUnseen(): NotificationInterface
    {
        $this->isSeen = false;
        return $this;
    }

    /**
     * @return bool
     */
    public function getIsSeen(): bool
    {
        return $this->isSeen;
    }

    /**
     * @return bool
     */
    public function send(): bool
    {
        //echo sprintf("-> Wysyłanie notyfikacji tekstowej: %s\n\n", $this->getTitle());
        return true;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'title'           => $this->getTitle(),
            'date_of_sending' => $this->getDateOfSending(),
            'is_seen'         => (int)$this->getIsSeen(),
            'sender'          => $this->getSender() ? $this->getSender()->toArray() : null,
        ];
    }

}
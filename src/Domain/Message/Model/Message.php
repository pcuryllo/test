<?php

namespace App\Domain\Message\Model;

use App\Domain\Notification\Model\Base\BaseModelInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Message
 * @package App\Model
 */
class Message implements BaseModelInterface
{

    /**
     * @var int|null
     */
    private $id = null;

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min="3")
     */
    private $title = null;

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(max="100")
     */
    private $message = null;

    /**
     * Message constructor.
     * @param int $id
     * @param string $title
     * @param string $message
     */
    public function __construct(int $id, string $title, string $message)
    {
        $this->id = $id;
        $this->title = $title;
        $this->message = $message;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return Message
     */
    public function setId(?int $id): Message
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
     * @return Message
     */
    public function setTitle(?string $title): Message
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getMessage(): ?string
    {
        return $this->message;
    }

    /**
     * @param string|null $message
     * @return Message
     */
    public function setMessage(?string $message): Message
    {
        $this->message = $message;
        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id'      => $this->getId(),
            'title'   => $this->getTitle(),
            'content' => $this->getMessage()
        ];
    }

}
<?php

namespace App\Domain\Notification\Model;



use App\Domain\Notification\Model\Base\BaseModelInterface;
use App\Domain\Notification\Model\Base\BaseNotification;
use App\Domain\User\Model\User;

/**
 * Class NotificationObject
 * @package App\Model
 */
class NotificationObject extends BaseNotification
{
    /**
     * @var null|BaseModelInterface
     */
    protected $model = null;

    /**
     * @return BaseModelInterface|null
     */
    public function getModel(): BaseModelInterface
    {
        return $this->model;
    }

    /**
     * @param BaseModelInterface|null $model
     */
    public function setModel(BaseModelInterface $model): self
    {
        $this->model = $model;
        return $this;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return parent::toArray() + [
            'model'           => $this->getModel()->toArray()
        ];
    }

    /**
     * @return bool
     */
    public function send(): bool
    {
        //echo sprintf("-> Wysyłanie notyfikacji: %s z obiektem %s \n\n", $this->getTitle(), get_class($this->getModel()));
        return true;
    }

}
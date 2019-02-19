<?php

namespace App\Model;


use App\Model\Base\BaseModelInterface;
use App\Model\Base\BaseNotification;

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
     * NotificationObject constructor.
     * @param BaseModelInterface $baseModel
     */
    public function __construct(BaseModelInterface $baseModel)
    {
        $this->model = $baseModel;
    }

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
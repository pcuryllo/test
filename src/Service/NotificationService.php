<?php

namespace App\Service;


use App\Domain\Notification\Model\Base\NotificationInterface;

/**
 * Class NotificationService
 * @package App\Service
 */
class NotificationService
{
    /**
     * @param NotificationInterface $notification
     * @return bool
     */
    public function send(NotificationInterface $notification)
    {
        return $notification->send();
    }
}
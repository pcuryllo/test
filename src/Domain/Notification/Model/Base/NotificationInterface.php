<?php

namespace App\Domain\Notification\Model\Base;

/**
 * Class NotificationInterface
 */
interface NotificationInterface
{
    public function markAsSeen():self;

    public function markAsUnseen():self;

    public function send():bool;

    public function toArray(): array;
}
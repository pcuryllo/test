<?php

namespace App\Model\Base;

/**
 * Class NotificationInterface
 * @package App\Model
 */
interface NotificationInterface
{
    public function markAsSeen():self;

    public function markAsUnseen():self;

    public function send():bool;

    public function toArray(): array;
}
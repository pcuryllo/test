<?php

namespace App\Domain\Notification\Model\Base;


/**
 * Interface BaseModelInterface
 */
interface BaseModelInterface
{
    /**
     * @return array
     */
    public function toArray():array;
}
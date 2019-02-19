<?php

namespace App\Model\Base;


/**
 * Interface BaseModelInterface
 * @package App\Model\Base
 */
interface BaseModelInterface
{
    /**
     * @return array
     */
    public function toArray():array;
}
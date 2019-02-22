<?php
/**
 * Created by PhpStorm.
 * User: pcuryllo
 * Date: 22.02.19
 * Time: 14:57
 */

namespace App\Domain\Notification\ValueObject;


class DateOfSending
{

    private $date;

    /**
     * @param string $dateString
     * @param string $format
     */
    public function fromString(string $dateString, $format = 'Y-m-d H:i:s') {
        $this->date = \DateTime::createFromFormat($format, $dateString);
    }

    public function getDateTime() {
        return new \DateTime();
    }
}
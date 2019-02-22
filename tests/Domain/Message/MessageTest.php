<?php

namespace App\Tests\Domain\Message;

use App\Domain\Message\Model\Message;
use PHPUnit\Framework\TestCase;

class MessageTest extends TestCase
{
    public function testReturnedValue() {
        $message = new Message(1, $title = 'Testowa wiadomość', $messageText = 'Treść wiadomości');

        $this->assertNotNull($message->getId());
        $this->assertEquals($message->getTitle(), $title);
        $this->assertEquals($message->getMessage(), $messageText);
    }
}
<?php

namespace App\Tests;


use App\Model\Message;
use App\Model\Notification;
use App\Model\NotificationObject;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Class NotificationTest
 * @package App\Tests
 */
class NotificationTest extends WebTestCase
{
    /**
     * @throws \Exception
     */
    public function testCreateNotification()
    {

        $title = 'Tytuł notyfikacji';
        $dateOfSending = new \DateTime("+6 days");

        $message = new Message();
        $message->setTitle('Testowa wiadomość');
        $message->setMessage('Treść wiadomości');

        $notification1 = new NotificationObject($message);
        $notification1->setTitle($title);
        $notification1->setDateOfSending($dateOfSending);
        $notification1->markAsSeen();

        $this->assertEquals($notification1->getTitle(), $title);
        $this->assertEquals($notification1->getDateOfSending(), $dateOfSending);
        $this->assertTrue($notification1->getIsSeen());
        $this->assertInstanceOf(Message::class, $notification1->getModel());
        $this->assertTrue($notification1->send());

        $notification2 = new Notification();
        $notification2->setDateOfSending(new \DateTime());
        $notification2->markAsUnseen();
        $notification2->setTitle('Przykładowa tekstowa notyfikacja');

        $this->assertFalse($notification2->getIsSeen());
        $this->assertTrue($notification2->send());
        $this->assertInternalType('array', $notification2->toArray());
    }



}

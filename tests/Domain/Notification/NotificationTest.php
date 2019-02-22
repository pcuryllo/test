<?php

namespace App\Tests\Domain\Notification;


use App\Domain\Message\Model\Message;
use App\Domain\Notification\Model\Notification;
use App\Domain\Notification\Model\NotificationObject;
use App\Domain\User\Model\User;
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
    public function testSimpleNotification()
    {
             $user = new User("Admin","Test");

        $notification2 = new Notification();
        $notification2->create(
            "Tytuł notyfikacji",
            "Opis",
            new \DateTime(),
            $user,
            $user);

        $this->assertTrue($notification2->getIsSeen());
        $this->assertTrue($notification2->send());
        $this->assertInternalType('array', $notification2->toArray());
    }

    public function testObjectNotification()
    {
        $title = 'Tytuł notyfikacji';
        $dateOfSending = new \DateTime("+6 days");

        $message = new Message(1, 'Test','Test');
        $user = new User("Admin","Test");


        $notification1 = new NotificationObject();
        $notification1->create(
            "Tytuł notyfikacji",
            "Opis",
            $dateOfSending,
            $user,
            $user);
        $notification1->setModel($message);

        $this->assertEquals($notification1->getTitle(), $title);
        $this->assertEquals($notification1->getDateOfSending(), $dateOfSending);
        $this->assertTrue($notification1->getIsSeen());
        $this->assertInstanceOf(Message::class, $notification1->getModel());
        $this->assertTrue($notification1->send());
    }

}

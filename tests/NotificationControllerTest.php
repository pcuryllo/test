<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class NotificationControllerTest extends WebTestCase
{
    /**
     * @throws \Exception
     */
    public function testValidateNotification()
    {

        $client = static::createClient();

        $client->request('POST', '/notification/create', [
            'title'         => '3n',
            'description'   => 'LbZRelMl6uZubNHllKKzORYDYgEdh0D6S4AI55XsaJU0GUnaHLqqH8auCI1eCgGxfW6Q0Ie78ah5n3kUgof0244zNI0fM8aJhGrll9w7kyVx3rz4hwYLoJNzyv9wMJiV',
            'dateOfSending' => (new \DateTime())->format('yyyy-MM-dd H:i:s'),
            'sender'        => 1,
            'recipient'     => 1,
            'submit'        => 1]);

        $responseArray = (array)json_decode($client->getResponse()->getContent());

        $this->assertArrayHasKey('success', $responseArray);
        $this->assertArrayHasKey('errors', $responseArray);
        $this->assertArrayHasKey('description', (array)$responseArray['errors']);
        $this->assertArrayHasKey('title', (array)$responseArray['errors']);

        $this->assertEquals(500, $client->getResponse()->getStatusCode());

        $this->assertTrue(true);
    }

    /**
     * @throws \Exception
     */
    public function testCreateNotification()
    {
        $client = static::createClient();

        $client->request('POST', '/notification/create', [
            'title'         => 'Testowa notyfikacja',
            'description'   => 'testowy',
            'dateOfSending' => (new \DateTime())->format('Y-m-d H:i:s'),
            'sender'        => 1,
            'recipient'     => 1
        ]);

        $responseArray = (array)json_decode($client->getResponse()->getContent());

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertArrayHasKey('success', $responseArray);
        $this->assertTrue($responseArray['success']);

    }


}

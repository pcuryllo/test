<?php

namespace App\Tests\UI\Rest\Controller\Message;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MessageControllerTest extends WebTestCase
{
    public function testValidationMessage()
    {
        $client = static::createClient();

        $client->request('POST', '/message/create', ['title' => 'test']);
        $response =  (array) json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(500, $client->getResponse()->getStatusCode());
        $this->assertArrayHasKey('success', $response);
    }

    public function testCreatedMessage()
    {
        $client = static::createClient();

        $client->request('POST', '/message/create', ['title' => 'test', 'message' => 'Opis wiadomości']);
        $response =  (array) json_decode($client->getResponse()->getContent(), true);

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertArrayHasKey('success', $response);
    }
}

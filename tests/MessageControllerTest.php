<?php

namespace App\Tests;


use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class MessageControllerTest extends WebTestCase
{
    public function testCreateMessage()
    {
        $client = static::createClient();

        $client->request('POST', '/message/create', ['title' => 'test']);

        $this->assertEquals(500, $client->getResponse()->getStatusCode());
    }
}

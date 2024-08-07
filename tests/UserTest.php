<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class UserTest extends WebTestCase
{
    public function testSomething(): void
    {
        $client = static::createClient();
        $crawler = $client->request(
            'POST',
            '/user',
            [
                'email' => 'test@email.com',
                'last_name' => 'John',
                'first_name' => 'Dane'
            ]
            );

        $this->assertResponseIsSuccessful();
    }
}

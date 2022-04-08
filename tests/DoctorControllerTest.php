<?php

namespace App\Tests;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DoctorControllerTest extends WebTestCase
{
    public function testListDoctors(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/doctor/');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h4', 'Dr. Jack Smith');
    }
}

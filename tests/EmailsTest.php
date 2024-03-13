<?php

// tests/Controller/PostControllerTest.php
namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class PostControllerTest extends WebTestCase
{
    public function testSomething(): void
    {
        // This calls KernelTestCase::bootKernel(), and creates a
        // "client" that is acting as the browser
        $client = static::createClient();
        $client->enableProfiler();

        // Request a specific page
        $crawler = $client->request('GET', '/home');

        // Retrieve the mail collector
        $profile = $client->getProfile();
        $mailCollector = $profile->getCollector('mailer');

        // Retrieve the email events
        $emails = $mailCollector->getEvents();

        // Assert that one email was sent
        $this->assertCount(1, $emails);

        // Validate a successful response and some content
        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains($crawler->filter('h1')->text(), 'Hello World');
    }
}

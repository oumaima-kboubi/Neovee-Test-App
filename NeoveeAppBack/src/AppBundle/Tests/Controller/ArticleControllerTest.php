<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ArticleControllerTest extends WebTestCase
{
    public function testGetarticle()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/getArticle');
    }

    public function testAddarticle()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/addArticle');
    }

    public function testEditarticle()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/editArticle');
    }

    public function testDeletearticle()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/deleteArticle');
    }

    public function testGetallarticle()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', '/getAllArticle');
    }

}

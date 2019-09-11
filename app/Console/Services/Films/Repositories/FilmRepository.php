<?php

namespace App\Console\Services\Films\Repositories;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;
use App\Console\Services\Films\Contracts\FilmContract;

class FilmRepository implements FilmContract
{
    protected $client;

    protected $url = 'https://www.lostfilm.tv/new';

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function fetch()
    {
        $response = $this->client->request('GET', $this->url);

        $films = $response->filter('div.row > a')->each(function ($node) {
            dump($node->filter('div.name-ru')->extract('_text'));
        });
    }
}

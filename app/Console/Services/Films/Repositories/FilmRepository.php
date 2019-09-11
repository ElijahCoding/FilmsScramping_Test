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
        $this->client = $client->request('GET', $this->url);
    }

    public function fetchLink()
    {
        $this->client->filter('a[style*="text-decoration:none;display:block"]')->each(function ($node) {
            return $node->extract('href');
        });
    }

    public function fetchName()
    {
        $this->client->filter('div.name-ru')->each(function ($node) {
            return $node->extract('_text');
        });
    }

    public function fetchDate()
    {
        $this->client->filter('div.alpha')->each(function ($node) {
            return $node->extract('_text');
        });
    }
}

<?php

namespace App\Console\Services\Films\Repositories;

use Goutte\Client;
use Symfony\Component\DomCrawler\Crawler;
use App\Console\Services\Films\Contracts\FilmContract;

class FilmRepository implements FilmContract
{
    protected $client;

    protected $data;

    protected $url = 'https://www.lostfilm.tv/new';

    public function __construct(Client $client)
    {
        $this->client = $client->request('GET', $this->url);

        $this->fetchLink();
        $this->fetchName();
        $this->fetchDate();
    }

    public function output()
    {
        return [
            'links' => $this->data['link'],
            'names' => $this->data['name'],
            'dates' => $this->data['date']
        ];
    }

    public function fetchLink()
    {
        $this->data['link'] = $this->client->filter('a[style*="text-decoration:none;display:block"]')->each(function ($node) {
            return $node->extract('href')[0];
        });
    }

    public function fetchName()
    {
        $this->data['name'] = $this->client->filter('div.name-ru')->each(function ($node) {
            return $node->extract('_text')[0];
        });
    }

    public function fetchDate()
    {
         $this->data['date'] = $this->client->filter('div.details-pane > div.alpha')->each(function ($node) {
            $date = preg_replace( '/[^0-9.]/i', '', $node->extract('_text')[0]);
            if (strlen($date) > 2) return $date;
         });

         foreach($this->data['date'] as $key => $value) {
             if(empty($value))
                 unset($this->data['date'][$key]);
         }

         $this->data['date'] = array_values($this->data['date']);
    }
}

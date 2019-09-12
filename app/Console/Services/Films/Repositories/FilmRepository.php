<?php

namespace App\Console\Services\Films\Repositories;

use App\Film;
use Goutte\Client;
use App\Console\Services\Films\Contracts\FilmContract;

class FilmRepository implements FilmContract
{
    protected $client;

    protected $url = 'https://www.lostfilm.tv/new';

    public function __construct(Client $client)
    {
        $this->client = $client->request('GET', $this->url);
    }

    public function DBCreate()
    {
        foreach ($this->transformedData() as $item) {
            Film::create($item);
        }
    }

    public function transformedData()
    {
        $data = [];

        for ($i = 0; $i < count($this->fetchLink()); $i++) {
            $data[] = [
                'name' => $this->fetchName()[$i],
                'url' => $this->fetchLink()[$i],
                'published_at' => $this->fetchDate()[$i]
            ];
        }

        return $data;
    }

    public function fetchLink()
    {
        return $this->client->filter('a[style*="text-decoration:none;display:block"]')->each(function ($node) {
            return $node->extract('href')[0];
        });
    }

    public function fetchName()
    {
        return $this->client->filter('div.name-ru')->each(function ($node) {
            return $node->extract('_text')[0];
        });
    }

    public function fetchDate()
    {
         $data = $this->client->filter('div.details-pane > div.beta')->each(function ($node) {
            $date = preg_replace( '/[^0-9.]/i', '', $node->extract('_text')[0]);
            if (strlen($date) > 2) return $date;
         });

         foreach($data as $key => $value) {
             if(empty($value))
                 unset($data[$key]);
         }

         return array_values($data);
    }
}

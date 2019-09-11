<?php

namespace App\Console\Services\Films\Repositories;

use App\Console\Services\Films\Contracts\FilmContract;

class FilmRepository implements FilmContract
{
    public function fetch()
    {
        dd('working');
    }
}

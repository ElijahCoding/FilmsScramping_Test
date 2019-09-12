<?php

namespace App\Console\Services\Films\Contracts;

interface FilmContract
{
    public function fetchLink();

    public function fetchName();

    public function fetchDate();

    public function DBCreate();

    public function transformedData();
}

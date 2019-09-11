<?php

namespace App\Providers;

use App\Console\Services\Films\Contracts\{
    FilmContract
};
use App\Console\Services\Films\Repositories\{
    FilmRepository
};

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(FilmContract::class, FilmRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}

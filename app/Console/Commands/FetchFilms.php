<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Console\Services\Films\Contracts\FilmContract;

class FetchFilms extends Command
{
    protected $filmContract;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'fetch:films';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch latest films';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(FilmContract $filmContract)
    {
        parent::__construct();

        $this->filmContract = $filmContract;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->filmContract->fetch();
    }
}

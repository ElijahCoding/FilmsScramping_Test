<?php

namespace App\Http\Controllers;

use App\Film;
use Illuminate\Http\Request;
use App\Http\Resources\FilmResource;

class FilmController extends Controller
{
    public function index()
    {
        return FilmResource::collection(Film::orderBy('published_at', 'desc')->get());
    }
}

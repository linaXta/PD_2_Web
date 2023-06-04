<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;

class DataController extends Controller
{
    public function getTopMovies()
    {
        return Movie::where('display', true)
        ->inRandomOrder()
        ->take(3)            // atgriež 3 nejauši izvēlētas grāmatas
        ->get();
    }

     
    public function getMovie(Movie $movie)
    {
        return Movie::where([
            'id' => $movie->id,
            'display' => true,
        ])
        ->firstOrFail();
    }

    public function getRelatedMovies(Movie $movie)
    {
        return Movie::where('display', true)
        ->where('id', '<>', $movie->id)
        ->inRandomOrder()
        ->take(3)
        ->get();
    }

        
    
    
}

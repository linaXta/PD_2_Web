<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Director;
use App\Http\Requests\MovieRequest;
use App\Models\Genre;

class MovieController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    //display all movies
    public function list()
    {
        $items = Movie::orderBy('name', 'asc')->get();

        return view(
            'movie.list',
            [
                'title' => 'Filmas',
                'items' => $items,
            ]
        );
    }

    // display new movie form
    public function create()
    {
        $directors = Director::orderBy('name', 'asc')->get();
        $genres = Genre::orderBy('name', 'asc')->get();
        return view(
            'movie.form',
            [
                'title' => "Pievienot filmu",
                'movie' => new Movie(),
                'directors' => $directors,
                'genres' => $genres,
            ]
        );
    }

    private function saveMovieData(Movie $movie, MovieRequest $request)
    {
        $validatedData = $request->validated();
        $movie->fill($validatedData);
        $movie->display = (bool) ($validatedData['display'] ?? false);
        if ($request->hasFile('image')) {
            $uploadedFile = $request->file('image');
            $extension = $uploadedFile->clientExtension();
            $name = uniqid();
            $movie->image = $uploadedFile->storePubliclyAs(
                '/',
                $name . '.' . $extension,
                'uploads'
            );
        }
        $movie->save();
    }

    public function put(MovieRequest $request) // save new movies
    {
        $movie = new Movie();
        $this->saveMovieData($movie, $request);
        return redirect('/movies');
    }

    public function patch(Movie $movie, MovieRequest $request)
    {
        $this->saveMovieData($movie, $request);
        return redirect('/movies/update/' . $movie->id);
    }

     public function update(Movie $movie)
    {
        $directors = Director::orderBy('name', 'asc')->get();
        $genres = Genre::orderBy('name', 'asc')->get();
        return view(
            'movie.form',
            [
                'title' => 'Rediģēt filmu',
                'movie' => $movie,
                'directors' => $directors,
                'genres' => $genres,
            ]
        );
    }

    public function delete(Movie $movie)
    {
        $movie->delete();
        return redirect('/movies');
    }

}

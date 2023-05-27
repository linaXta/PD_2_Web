<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Director;

class DirectorController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    //display all directors
    public function list()
    {
        $items = Director::orderBy('name', 'asc')->get();

        return view(
            'director.list',
            [
                'title'=> 'Režisori',
                'items' => $items,
            ]
            );
    }

    // display new director form
    public function create()
    {
        return view(
            'director.form',
            [
                'title' => "Pievienot režisoru",
                'director' => new Director(),
            ]
        );
    }

    // save new director
    public function put(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        $director = new Director();
        $director->name = $validatedData['name'];
        $director->save();

        return redirect('/directors');
    }

    // update director
    public function update(Director $director)
    {
        return view(
            'director.form',
            [
                'title' => 'Rediģēt režisoru',
                'director' => $director,
            ]
        );
        
    }

    public function patch(Director $director, Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
        ]);

        
        $director->name = $validatedData['name'];
        $director->save();

        return redirect('/directors');
    }

    public function delete(Director $director)
    {
        $director->delete();

        return redirect('/directors');
    }

    
}

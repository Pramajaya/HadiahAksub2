<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Http\Requests\StoreMovieRequest;
use App\Http\Requests\UpdateMovieRequest;
use App\Models\Genre;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MovieController extends Controller
{
    function getHome() {
        $movies = Movie::all();
        return view('home', compact('movies'));
    }

    function getCreateMovie() {
        $genres = Genre::all();
        return view('createMovie', compact('genres'));
    }

    function storeMovie(Request $request) {
        $request->validate([
            'MovieName' => 'required',
            'MovieDuration' => 'required',
            'MovieImage' => ['required', 'image'],
            'MovieDirector' => 'required',
            'GenreName' => 'required'
        ]);

        $now = now()->format('Y-m-d_H.i.s');
        $filename = $now.'_'.$request->file('MovieImage')->getClientOriginalName();
        $request->file('MovieImage')->storeAs('/public'.'/'.$filename);

        Movie::create([
            'MovieName' => $request->MovieName,
            'MovieDuration' => $request->MovieDuration,
            'MovieImage' => $filename,
            'MovieDirector' => $request->MovieDirector,
            'GenreId' => $request->GenreName
        ]);

        return redirect('/home');
    }

    function updateMovie($id) {
        $movie = Movie::find($id);
        return view('updateMovie', compact('movie'));
    }

    function editMovie(Request $request, $id) {
        $movie = Movie::find($id);

        $request->validate([
            'MovieName' => 'required',
            'MovieDuration' => 'required',
            'MovieImage' => ['required', 'image'],
            'MovieDirector' => 'required'
        ]);

        Storage::delete('/public'.'/'.$movie->MovieImage);
        $now = now()->format('Y-m-d_H.i.s');
        $filename = $now.'_'.$request->file('MovieImage')->getClientOriginalName();
        $request->file('MovieImage')->storeAs('/public'.'/'.$filename);

        $movie->update([
            'MovieName' => $request->MovieName,
            'MovieDuration' => $request->MovieDuration,
            'MovieImage' => $filename,
            'MovieDirector' => $request->MovieDirector
        ]);

        return redirect('/home');
    }

    function deleteMovie($id) {
        $movie = Movie::find($id);
        Storage::delete('/public'.'/'.$movie->MovieImage);
        Movie::destroy($movie->id);
        return redirect('/home');
    }
}

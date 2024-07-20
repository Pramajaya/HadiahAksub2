<?php

namespace App\Http\Controllers;

use App\Http\Resources\MovieResource;
use Illuminate\Http\Request;
use App\Models\Movie;
use Illuminate\Support\Facades\Storage;

class ApiController extends Controller
{
    function getMovie() {
        $movies = Movie::all();
        return MovieResource::collection(Movie::paginate());
    }

    function storePostMovie(Request $request) {
        $request->validate([
            'MovieName' => 'required',
            'MovieDuration' => 'required',
            'MovieImage' => ['required'],
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
            'GenreId' => 1
        ]);

        return 'Movie berhasil dibuat!';
    }

    function updatePostMovie($id) {
        $movie = Movie::find($id);

        $request->validate([
            'MovieName' => 'required',
            'MovieDuration' => 'required',
            'MovieImage' => ['required'],
            'MovieDirector' => 'required',
            'GenreName' => 'required'
        ]);

        Storage::delete('/public'.'/'.$movie->MovieImage);
        $now = now()->format('Y-m-d_H.i.s');
        $filename = $now.'_'.$request->file('MovieImage')->getClientOriginalName();
        $request->file('MovieImage')->storeAs('/public'.'/'.$filename);

        $movie->update([
            'MovieName' => $request->MovieName,
            'MovieDuration' => $request->MovieDuration,
            'MovieImage' => $filename,
            'MovieDirector' => $request->MovieDirector,
            'GenreId' => 1
        ]);

        return 'Movie berhasil di update!';
    }

    function deletePostMovie($id) {
        $movie = Movie::find($id);
        Storage::delete('/public'.'/'.$movie->MovieImage);
        Movie::destroy($movie->id);
        return 'Movie berhasil di hapus!';
    }
}

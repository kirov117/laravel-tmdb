<?php

namespace App\Http\Controllers;

use Redirect;
use Request;
use Response;
use TMDB;

use App\Movie;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = Movie::with('genres')
            ->orderBy('created_at', 'desc')
            ->orderBy('original_title', 'asc')
            ->paginate(15);

        return view('home', compact('movies'));
    }

    /**
     * Show the details for a given movie
     *
     * @param  integer $id
     * @return \Illuminate\Http\Response
     */
    public function movieDetails($id)
    {
        $movie = Movie::with('genres')->find($id);

        if (!$movie) {
            abort(404);
        }

        $movieDetails = TMDB::getMovieDetails($movie->tmdb_id);

        return view('movieDetails', compact('movie') + ['details' => $movieDetails]);
    }

}

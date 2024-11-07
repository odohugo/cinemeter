<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (!$request->session()->get('user-id')) {
            return redirect()->route('index');
        }

        $url = 'https://api.themoviedb.org/3/search/movie?query=';
        $apiKey = env("API_KEY");
        $title = $request->input('title');
        $page = $request->input('page');
        $movies = null;

        if ($title) {
            $movies = Http::withHeaders(['Authorization' => 'Bearer ' . $apiKey])
                ->get($url, ['query' => $title, 'page' => $page])
                ->json();
            usort($movies['results'], function ($a, $b) {
                return $b['popularity'] <=> $a['popularity'];
            });
        };

        return view('movies.index', ['movies' => $movies]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (!Session::get('user-id')) {
            return redirect()->route('index');
        }

        $url = 'https://api.themoviedb.org/3/movie/' . $id;
        $creditsUrl = 'https://api.themoviedb.org/3/movie/' . $id . '/credits';
        $apiKey = env("API_KEY");

        $movie = Http::withHeaders(['Authorization' => 'Bearer ' . $apiKey])
            ->get($url)->json();
        $movieCredits = Http::withHeaders(['Authorization' => 'Bearer ' . $apiKey])
            ->get($creditsUrl)->json();

        foreach ($movieCredits['crew'] as $crew) {
            if ($crew['job'] == 'Director') {
                $movie['director'] = $crew;
            }
        }
        $reviews = Review::where('movie_id', $id)->paginate();
        foreach ($reviews as $review) {
            $review->movie = $movie;
        }

        return view('movies.show', ['movie' => $movie, 'reviews' => $reviews]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

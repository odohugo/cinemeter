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
        $apiKey = env("API_KEY");

        $movie = Http::withHeaders(['Authorization' => 'Bearer ' . $apiKey])
            ->get($url)->json();

        $reviews = Review::where('movie_id', $id)->paginate();

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

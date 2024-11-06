<?php

namespace App\Http\Controllers;

use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        if (!session()->get('user-id')) {
            return redirect()->route('index');
        }

        $data = $request->validate([
            'text' => 'required|min:15',
            'rating' => 'required|min:0|max:5|integer',
            'movie_id' => 'required|integer',
            'movie_title' => 'required|string'
        ]);

        $userId = session()->get('user-id');
        $user = User::findOrFail($userId);
        $user->reviews()->create($data);


        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        $apikey = env("API_KEY");
        $url = 'https://api.themoviedb.org/3/movie/' . $review->movie_id;
        $movie = http::withheaders(['authorization' => 'bearer ' . $apikey])
            ->get($url)->json();
        $review->movie = $movie;

        return view('reviews.show', ['review' => $review]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        if (!session()->get('user-id')) {
            return redirect()->route('index');
        }

        $data = $request->validate([
            'text' => 'required|min:1',
            'rating' => 'required|min:0|max:5|integer',
        ]);

        $review->text = $data['text'];
        $review->rating = $data['rating'];
        $review->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        $user = $review->user;
        $review->delete();
        return redirect()->route('users.show', ['user' => $user])
            ->with('success', 'Review deleted successfully!');
    }

    public function storeComment(Request $request, Review $review)
    {
        $user = User::findOrFail(session()->get('user-id'));

        if (!$user) {
            return redirect()->route('index');
        }

        $data = $request->validate([
            'text' => 'required|min:1',
        ]);

        $comments = json_decode($review->comments);
        $comments[] = [...['id' => $user->id, 'name' => $user->name, 'text' => $data['text'], 'timestamp' => date('H:i d-m-y')]];
        $review->comments = json_encode($comments);
        $review->save();

        return redirect()->back();
    }

    public function destroyComment(Review $review)
    {
        //
    }
}

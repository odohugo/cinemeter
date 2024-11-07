<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ListsController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;


Route::get('/welcome', function (Request $request) {
    return view('welcome');
})->name('welcome');

Route::get('/', function (Request $request) {
    if (!$request->session()->get('user-id')) {
        return redirect()->route('welcome');
    };

    $reviews = [];
    $apikey = env("API_KEY");

    $reviews = review::latest()->take(5)->get();

    foreach ($reviews as $review) {
        $url = 'https://api.themoviedb.org/3/movie/' . $review->movie_id;
        $movie = http::withheaders(['authorization' => 'bearer ' . $apikey])
            ->get($url)->json();
        $review->movie = $movie;
    }

    $nowPlaying = http::withheaders(['authorization' => 'bearer ' . $apikey])
        ->get('https://api.themoviedb.org/3/movie/now_playing')->json();
    $nowPlaying = array_slice($nowPlaying['results'], 0, 5);

    return view('index', ['reviews' => $reviews, 'nowPlaying' => $nowPlaying]);
})->name('index');

Route::get('/signup', function () {
    return view('auth.signup');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/profile', function () {

    $userId = Session::get('user-id');

    if (!$userId) return redirect()->route('index');

    $user = User::findOrFail($userId);

    return redirect()->route('users.show', ['user' => $user]);
})->name('users.profile');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::put('/follow/{targetUser}', [ListsController::class, 'follow'])->name('lists.follow');
Route::put('/unfollow/{targetUser}', [ListsController::class, 'unfollow'])->name('lists.unfollow');

Route::resource('users', UserController::class);
Route::resource('movies', MovieController::class);
Route::resource('reviews', ReviewController::class);

Route::get('users/{targetUser}/following', [UserController::class, 'following'])->name('users.following');
Route::get('users/{targetUser}/followers', [UserController::class, 'followers'])->name('users.followers');
Route::get('users/{targetUser}/reviews', [UserController::class, 'reviews'])->name('users.reviews');

Route::post('reviews/{review}/storeComment', [ReviewController::class, 'storeComment'])->name('reviews.store-comment');
Route::post('reviews/{review}/destroyComment/{commentIndex}', [ReviewController::class, 'destroyComment'])->name('reviews.destroy-comment');

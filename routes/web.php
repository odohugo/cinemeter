<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/', function (Request $request) {
    $reviews = [];
    if ($request->session()->get('user-id')) {
        $reviews = Review::latest()->take(5)->get();
    };
    return view('welcome', ['reviews' => $reviews]);
})->name('index');

Route::get('/signup', function () {
    return view('auth.signup');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::resource('users', UserController::class);
Route::resource('movies', MovieController::class);
Route::resource('reviews', ReviewController::class);

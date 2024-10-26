@extends('layouts.app')

@section('content')
    @if(!Session::get('user-id'))
        <div class="mt-5">
            <h1 class="text-xl text-slate-800 text-center">Cinemeter</h1>
        </div>
        <div class="flex justify-center mt-12">
            <div class="flex justify-around w-80">
                <a class="btn" href="{{ route('login') }}">Login</a>
                <a class="btn" href="{{ route('users.create') }}">Sign Up</a>
            </div>
        </div>

    @else
        <div class="flex flex-col items-center">
            <div class="mt-10">
                <h1 class="text-2xl font-bold">Welcome {{Session::get('user-name')}}</h1>
            </div>
            <div class="flex flex-col mt-10 gap-5">
                <p>Recent reviews in Cinemeter:</p>
                @forelse($reviews as $review)
                    <div class="flex gap-5 bg-slate-300 px-4 py-2 shadow-sm rounded-md justify-between">
                        <a href="{{ route('movies.show', ['movie' => $review->movie_id]) }}"
                            class="italic hover:text-cyan-700">{{ $review->movie_title }}</a>
                        <p>{{ $review->text }}</p>
                        <p>{{ $review->user->name }}</p>
                        <p class="">{{ $review->rating }}★</p>
                    </div>
                @empty
                @endforelse
            </div>
        </div>

    @endif
@endsection

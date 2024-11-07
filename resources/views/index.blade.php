@extends('layouts.app')

@section('content')
    <div class="flex flex-col w-full">
        <div class="mt-20">
            <h1 class="text-6xl lg:text-3xl font-bold text-center text-stone-800">Welcome {{Session::get('user-name')}}</h1>
        </div>
        <div class="flex flex-col gap-4 mt-14">
            <p class="serif-font text-4xl lg:text-base">In theaters now:</p>
            <div class="flex gap-2 justify-between">
            @foreach($nowPlaying as $movie)
                    <div class="flex flex-col items-center w-52 gap-5">
                        <a href="{{ route('movies.show', $movie['id']) }}">
                            <img src={{'https://image.tmdb.org/t/p/w500' . $movie['poster_path']}}
                                 class="ring-1 ring-stone-400 hover:ring-orange-600 hover:ring-2 transition-transform ease-out hover:scale-105 rounded-sm shadow-lg shadow-stone-400"/>
                        </a>
                    </div>
            @endforeach
            </div>
        </div>
        <div class="flex flex-col mt-20 gap-4">
            <p class="serif-font text-4xl lg:text-base">Recent reviews in Cinemeter:</p>
            @forelse($reviews as $review)
                <x-simple-review :review="$review"/>
            @empty
            @endforelse
        </div>
    </div>
@endsection

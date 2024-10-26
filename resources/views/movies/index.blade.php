@extends('layouts.app')

@section('content')

    <div class="mt-10 w-1/2">
        <form method="GET" action="{{ route('movies.index') }}">
            <label for="title">Search for a movie</label>
            <div class="flex gap-4 items-center mt-2">
                <input type="text" id="title" name="title" value="{{ request('title') }}" class="input w-full h-8"/>
                <button type="submit" class="btn">Search</button>
                <a href="{{ route('movies.index') }}" class="btn">Clear</a>
            </div>
        </form>

        @if ($movies)
            <div class="mt-10">
                <ul class="flex flex-col gap-3">
                        @forelse($movies['results'] as $movie)
                            @php
                                $posterUrl = 'https://image.tmdb.org/t/p/w92' . $movie['poster_path'];
                            @endphp
                            <li>
                                <a href="{{ route('movies.show', $movie["id"]) }}">
                                    <div class="movie-search-result">
                                        <div class="flex items-center gap-2">
                                            <p class="font-bold">{{ $movie['title'] }}</p>
                                            <p class="text-sm">{{ $movie['release_date'] }}</p>
                                        </div>
                                        <img src={{$posterUrl}} class="h-full rounded-md ring-2 ring-slate-600"/>
                                    </div>
                                </a>
                            </li>
                        @empty
                            <li>No movies found.</li>
                        @endforelse
                </ul>
                <nav class="flex justify-between mt-8 mb-8">
                    @if($movies['page'] != "1")
                        <a class="btn">back</a>
                    @else
                        <div></div>
                    @endif
                    <div class="btn">Page {{$movies['page']}}</div>
                    <a class="btn" href="{{ route('movies.index', ['title' => request('title'), 'page' => $movies['page']+1]) }}">next</a>
                </nav>

            </div>
        @endif
    </div>

@endsection

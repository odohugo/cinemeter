@extends('layouts.app')

@section('script')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection

@section('content')

    <div class="mt-10 py-8 px-20 flex flex-col items-center">

        <div class="flex w-full h-full lg:h-96 gap-10 justify-between">
            <div class="flex flex-col">
                <div class="flex items-baseline gap-2">
                    <h1 class="text-6xl lg:text-xl font-bold">{{ $movie['title'] }}</h1>
                    <p class="text-4xl lg:text-base">{{ substr($movie['release_date'], 0, 4) }}</p>
                </div>
                <p class="text-3xl lg:text-sm">{{ $movie['runtime'] . "'" }}</p>
                <p class="text-3xl lg:text-sm">{{ $movie['director']['name'] }}</p>
                <p class="text-4xl lg:text-base mt-4 serif-font">{{ $movie['overview'] }}</p>
            </div>
            <img src={{'https://image.tmdb.org/t/p/w500' . $movie['poster_path']}}
                class="h-96 lg:h-full ring-2 ring-slate-600"/>
        </div>
        <div class="mt-10 w-full" x-data="{open: false}">
            <button class="btn text-4xl lg:text-base" @click="open = ! open" x-show="!open">Write a review</button>
            <button class="btn text-4xl lg:text-base" @click="open = ! open" x-show="open">Cancel</button>
            <div x-show="open" class="mt-3">
                <form method="POST" action="{{ route('reviews.store') }}"
                    class="flex flex-col">
                    @csrf
                    @php
                        $rating = 0;
                    @endphp
                    <div class="mt-6 mb-6">
                        <input type="hidden" name="movie_id" value="{{$movie['id']}}"/>
                        <input type="hidden" name="movie_title" value="{{$movie['title']}}"/>
                        <p class="text-3xl lg:text-sm">Select a rating:</p>
                        @livewire('select-rating', ['rating' => $rating])
                        @error('rating')
                            <p class="text-3xl lg:text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <label for="text" class="text-3xl lg:text-sm">Write your review here:</label>
                    <textarea id="text" name="text" class="mt-2 rounded-md h-40 lg:h-20 py-1 px-2 ring-1 ring-stone-400 text-3xl lg:text-base" required minlength=5></textarea>
                    @error('text')
                        <p class="text-4xl lg:text-xs text-red-500">{{ $message }}</p>
                    @enderror
                    <div class="mt-2">
                        <button class="btn text-4xl lg:text-base">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="w-full mt-20">
            <p class="mb-4 text-3xl lg:text-base">Reviews for <span class="italic">{{ $movie['title'] }}:</span></p>
            <div class="flex flex-col gap-8 lg:gap-4">
                @forelse($reviews as $review)
                    <x-small-review :review="$review" />
                @empty
                    <p class="text-2xl lg:text-base">There are no reviews yet.</p>
                @endforelse
            </div>
        </div>

    </div>

@endsection

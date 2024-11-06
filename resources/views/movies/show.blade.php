@extends('layouts.app')

@section('script')
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
@endsection

@section('content')

    <div class="mt-10 py-8 px-20 flex flex-col items-center">

        <div class="flex w-full h-96 gap-10 justify-between">
            <div class="flex flex-col">
                <div class="flex items-baseline gap-2">
                    <h1 class="text-xl font-bold">{{ $movie['title'] }}</h1>
                    <p>{{ substr($movie['release_date'], 0, 4) }}</p>
                </div>
                <p class="text-sm">{{ $movie['runtime'] . "'" }}</p>
                <p class="text-sm">{{ $movie['director']['name'] }}</p>
                <p class="text-sm mt-4">{{ $movie['overview'] }}</p>
            </div>
            <img src={{'https://image.tmdb.org/t/p/w500' . $movie['poster_path']}}
                class="h-full ring-2 ring-slate-600"/>
        </div>
        <div class="mt-10 w-full" x-data="{open: false}">
            <button class="btn" @click="open = ! open" x-show="!open">Write a review</button>
            <button class="btn" @click="open = ! open" x-show="open">Cancel</button>
            <div x-show="open" class="mt-3">
                <form method="POST" action="{{ route('reviews.store') }}"
                    class="flex flex-col">
                    @csrf
                    <div>
                        <input type="hidden" name="movie_id" value="{{$movie['id']}}"/>
                        <input type="hidden" name="movie_title" value="{{$movie['title']}}"/>
                        <select name='rating' id='rating' class="px-2 py-1 rounded-md ring-1 ring-stone-400" required>
                            @for ($i = 0; $i <= 5; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        @error('rating')
                            <p class="text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <textarea id="text" name="text" class="mt-2 rounded-md h-20 py-1 px-2 ring-1 ring-stone-400" required minlength=15></textarea>
                    @error('text')
                        <p class="text-xs text-red-500">{{ $message }}</p>
                    @enderror
                    <div class="mt-2">
                        <button class="btn">Submit</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="w-full mt-20">
            <p class="mb-4">Reviews for <span class="italic">{{ $movie['title'] }}:</span></p>
            <div class="flex flex-col gap-4">
                @forelse($reviews as $review)
                    <x-small-review :review="$review" />
                @empty
                    <p>There are no reviews yet.</p>
                @endforelse
            </div>
        </div>

    </div>

@endsection

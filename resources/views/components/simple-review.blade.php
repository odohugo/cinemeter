<div class="flex gap-5 bg-white ring-1 ring-stone-300 px-6 py-4 rounded-md justify-between">
    <img src={{'https://image.tmdb.org/t/p/w185' . $review->movie['poster_path']}}
         class="h-32 ring-1 ring-stone-400 rounded-sm"/>
    <div class="w-full flex flex-col justify-between">
        <div>
        <div class="flex items-baseline gap-3">
            <a href="{{ route('movies.show', ['movie' => $review->movie_id]) }}"
                class="font-bold text-stone-800 text-lg hover:text-orange-600">{{ $review->movie_title }}</a>
            <p class="text-stone-800">{{ substr($review->movie['release_date'], 0, 4) }}</p>
        </div>
            <x-star-rating :rating="$review->rating"/>
        </div>
        <div class="flex flex-col gap-2">
            <p class="serif-font">{{ $review->text }}</p>
            <a href="{{ route('users.show', ['user' => $review->user]) }}" class="text-sm font-bold hover:text-orange-600">{{ $review->user->name }}</a>
        </div>
    </div>
</div>

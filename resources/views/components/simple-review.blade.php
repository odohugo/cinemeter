<a href="{{ route('reviews.show', ['review'=>$review]) }}">
    <div class="flex gap-5 bg-white ring-1 ring-stone-300 px-6 py-4 rounded-md justify-between hover:ring-orange-600">
        <img src={{'https://image.tmdb.org/t/p/w185' . $review->movie['poster_path']}}
             class="h-20 ring-1 ring-stone-400 rounded-sm"/>
        <div class="w-full flex flex-col justify-between">
            <div>
                <div class="flex items-baseline gap-3">
                    <p class="text-stone-800 font-bold">{{ $review->movie_title }}</p>
                    <p class="text-stone-800 text-sm">{{ substr($review->movie['release_date'], 0, 4) }}</p>
                </div>
                <x-star-rating :rating="$review->rating"/>
            </div>
            <div class="flex items-baseline justify-between gap-2">
                <p class="serif-font">{{ Str::limit($review->text) }}</p>
                <p class="text-sm font-bold">{{ $review->user->name }}</p>
            </div>
        </div>
    </div>
</a>

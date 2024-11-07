<a href="{{ route('reviews.show', ['review'=>$review]) }}">
    <div class="flex gap-10 lg:gap-5 bg-white ring-1 ring-stone-300 px-6 py-4 rounded-md items-center justify-between hover:ring-orange-600 shadow-md">
        <img src={{'https://image.tmdb.org/t/p/w185' . $review->movie['poster_path']}}
             class="h-40 lg:h-20 self-start ring-1 ring-stone-400 rounded-sm"/>
        <div class="w-full flex flex-col justify-between">
            <div>
                <div class="flex items-baseline gap-3">
                    <p class="text-stone-800 text-4xl lg:text-base font-bold">{{ $review->movie_title }}</p>
                    <p class="text-stone-800 text-3xl lg:text-sm">{{ substr($review->movie['release_date'], 0, 4) }}</p>
                </div>
                <x-star-rating :rating="$review->rating"/>
            </div>
            <div class="flex items-end justify-between gap-2 py-2">
                <p class="serif-font text-4xl lg:text-base">{{ Str::limit($review->text) }}</p>
                <p class="text-2xl lg:text-sm font-bold">{{ $review->user->name }}</p>
            </div>
        </div>
    </div>
</a>

<div class="flex flex-col gap-2 bg-slate-300 px-6 py-4 shadow-sm rounded-md justify-between items-baseline">
    <div class="flex w-full justify-between">
        <a href="{{ route('movies.show', ['movie' => $review->movie_id]) }}"
            class="font-bold hover:text-cyan-700">{{ $review->movie_title }}</a>
        <x-star-rating :rating="$review->rating" />
    </div>
    <div class="flex flex-col">
        <p class="italic text-sm">{{ $review->text }}</p>
    </div>
</div>

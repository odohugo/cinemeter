<a href="{{ route('reviews.show', ['review'=>$review]) }}">
    <div class="flex gap-5 bg-white ring-1 ring-stone-300 px-6 py-4 rounded-md justify-between hover:ring-orange-600">
        <div class="w-full flex flex-col gap-1">
            <div class="ml-[-3px] text-xs">
                <x-star-rating :rating="$review->rating"/>
            </div>
            <div class="flex items-baseline justify-between gap-2">
                <p class="serif-font">{{ Str::limit($review->text) }}</p>
                <p class="text-sm font-bold">{{ $review->user->name }}</p>
            </div>
        </div>
    </div>
</a>

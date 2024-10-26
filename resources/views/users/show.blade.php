@extends('layouts.app')

@section('content')

    <div class="flex flex-col w-1/2 mt-20">
        <h1 class="text-2xl">
            PROFILE OF {{ $user->name }}
        </h1>
        <h3 class="mt-5">Reviews:</h3>
        <div class="flex flex-col gap-5 mt-5">
            @forelse($user->reviews as $review)
                <x-simple-review :review="$review" />
            @empty
            @endforelse
        </div>
    </div>

@endsection

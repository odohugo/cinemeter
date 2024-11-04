@extends('layouts.app')

@section('content')

    <div class="flex flex-col w-full mt-20">
        <div class="flex flex-col items-center">
            <a href="{{ route('users.show', ['user' => $targetUser]) }}" class="text-2xl font-bold text-stone-800 hover:text-orange-600 w-fit">{{ $targetUser->name }}</a>
            <div class="flex gap-5 mt-2 text-sm serif-font">
                <a href="{{ route('users.following', ['targetUser' => $targetUser]) }}" class="hover:text-orange-600">Following: {{ count($targetUser->following) }}</a>
                <a href="{{ route('users.followers', ['targetUser' => $targetUser]) }}" class="hover:text-orange-600">Followers: {{ count($targetUser->followers) }}</a>
                <p class="underline">Reviews: {{ count($targetUser->reviews) }}</p>
            </div>
        </div>

        <div class="flex flex-col gap-2 mt-10">
            @forelse($reviews as $review)
                <x-simple-review :review="$review" />
            @empty
                <p>{{$targetUser->name}} has not made any reviews.</p>
            @endforelse
        </div>

    </div>

@endsection

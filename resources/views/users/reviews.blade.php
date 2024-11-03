@extends('layouts.app')

@section('content')

    <div class="flex flex-col w-1/2 mt-20">
        <a href="{{ route('users.show', ['user' => $targetUser]) }}" class="text-2xl hover:text-emerald-800">{{ $targetUser->name }}</a>
        <div class="flex gap-5 mt-2">
            <a href="{{ route('users.following', ['targetUser' => $targetUser]) }}" class="hover:text-emerald-800">Following: {{ count($targetUser->following) }}</a>
            <a href="{{ route('users.followers', ['targetUser' => $targetUser]) }}" class="hover:text-emerald-800">Followers: {{ count($targetUser->followers) }}</a>
            <a href="{{ route('users.reviews', ['targetUser' => $targetUser]) }}" class="hover:text-emerald-800">Reviews: {{ count($targetUser->reviews) }}</a>
        </div>

        <div class="flex flex-col gap-2 mt-10">
            @forelse($targetUser->reviews as $review)
                <x-simple-review :review="$review" />
            @empty
                <p>{{$targetUser->name}} has not made any reviews.</p>
            @endforelse
        </div>

    </div>

@endsection

@extends('layouts.app')

@section('content')

    <div class="flex flex-col w-full mt-20">
        <div class="flex flex-col items-center">
            <a href="{{ route('users.show', ['user' => $targetUser]) }}" class="text-2xl font-bold text-stone-800 hover:text-orange-600 w-fit">{{ $targetUser->name }}</a>
            <div class="flex gap-5 mt-2 text-sm serif-font">
                <a href="{{ route('users.following', ['targetUser' => $targetUser]) }}" class="hover:text-orange-600 w-fit">Following: {{ count($targetUser->following) }}</a>
                <p class="underline">Followers: {{ count($targetUser->followers) }}</p>
                <a href="{{ route('users.reviews', ['targetUser' => $targetUser]) }}" class="hover:text-orange-600 w-fit">Reviews: {{ count($targetUser->reviews) }}</a>
            </div>
        </div>

        <div class="flex flex-col items-center mt-10 serif-font">
            <div class="flex flex-col gap-2 w-1/2">
                <div class="flex flex-col w-full gap-2 px-4 py-2 bg-white ring-1 ring-stone-300 rounded-md divide-y">
                @forelse($targetUser->followers as $follower)
                    <div class="flex items-center gap-20 px-4 py-4">
                        <div>
                            <a href="{{ route('users.show', ['user' => $follower]) }}"
                               class="font-bold hover:text-orange-600 w-fit"
                                >{{$follower->name}}</a>
                            <p class="text-xs">{{count($follower->followers)}} followers, following {{count($follower->following)}}</p>
                        </div>
                        <div>
                            <p class="text-xs">{{count($follower->reviews)}} reviews</p>
                        </div>
                    </div>
                @empty
                    <p>{{$targetUser->name}} is not following anyone</p>
                @endforelse
                </div>
            </div>
        </div>

    </div>

@endsection

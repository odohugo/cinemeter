@extends('layouts.app')

@section('content')

    <div class="flex flex-col w-full px-10 mt-20">
        <div class="flex flex-col items-center">
            <p class="text-2xl font-bold text-stone-800">{{ $targetUser->name }}</p>
            <div class="flex gap-5 mt-2 text-sm serif-font">
                <a href="{{ route('users.following', ['targetUser' => $targetUser]) }}" class="hover:text-orange-600 w-fit">Following: {{ count($targetUser->following) }}</a>
                <a href="{{ route('users.followers', ['targetUser' => $targetUser]) }}" class="hover:text-orange-600 w-fit">Followers: {{ count($targetUser->followers) }}</a>
                <a href="{{ route('users.reviews', ['targetUser' => $targetUser]) }}" class="hover:text-orange-600 w-fit">Reviews: {{ count($targetUser->reviews) }}</a>
            </div>
        </div>

        @if($authUser->id == $targetUser->id)
        @elseif($authUser->following()->where('user_id', $targetUser->id)->exists())
            <div class="mt-2">
                <form action="{{ route('lists.unfollow', ['targetUser' => $targetUser]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn">Unfollow User</button>
                </form>
            </div>
        @else
            <div class="mt-2">
                <form action="{{ route('lists.follow', ['targetUser' => $targetUser]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <button type="submit" class="btn">Follow User</button>
                </form>
            </div>
        @endif

        <div class="mt-20">
            Recent Activity
        </div>
    </div>

@endsection

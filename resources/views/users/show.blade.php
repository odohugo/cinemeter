@extends('layouts.app')

@section('content')

    <div class="flex flex-col w-1/2 mt-20">
        <a href="{{ route('users.show', ['user' => $targetUser]) }}" class="text-2xl hover:text-emerald-800">{{ $targetUser->name }}</a>
        <div class="flex gap-5 mt-2">
            <a href="{{ route('users.following', ['targetUser' => $targetUser]) }}" class="hover:text-emerald-800">Following: {{ count($targetUser->following) }}</a>
            <a href="{{ route('users.followers', ['targetUser' => $targetUser]) }}" class="hover:text-emerald-800">Followers: {{ count($targetUser->followers) }}</a>
            <a href="{{ route('users.reviews', ['targetUser' => $targetUser]) }}" class="hover:text-emerald-800">Reviews: {{ count($targetUser->reviews) }}</a>
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
    </div>

@endsection

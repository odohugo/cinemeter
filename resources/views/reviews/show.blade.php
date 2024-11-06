@extends('layouts.app')

@section('content')

    @php
        $userId = Session::get('user-id');
    @endphp
    <div class="w-full mt-10 py-8 px-20">
        <div class="flex flex-col bg-white px-10 py-8 rounded-md">
            <div class="flex gap-5 justify-between">
                <img src={{'https://image.tmdb.org/t/p/w500' . $review->movie['poster_path']}}
                     class="h-80 ring-1 ring-stone-400 rounded-sm"/>
                <div class="w-full flex flex-col justify-between">
                    <div>
                        <div class="flex items-baseline gap-3">
                            <a href="{{ route('movies.show', ['movie' => $review->movie_id]) }}" class="text-stone-800 font-bold text-lg hover:text-orange-600">{{ $review->movie_title }}</a>
                            <p class="text-stone-800">{{ substr($review->movie['release_date'], 0, 4) }}</p>
                        </div>
                    </div>
                    <div class="flex flex-col flex-1 items-baseline justify-between gap-2">
                        <div class="flex w-full h-full px-4 py-2 mt-4 items-center bg-stone-200 rounded-md">
                            <p class="serif-font">{{ $review->text }}</p>
                        </div>
                        <div class="flex flex-col w-full justify-between">
                            <div class="relative">
                                <svg version="1.2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 400 400" width="40" height="40" class="absolute top-[-15px] left-[-2px]">
                                    <style>.s0 { fill: #e7e5e4 } </style>
                                    <path id="Layer 1" class="s0" d="m392-2h-371v180c0 0-5.6 80.4 54 140 59.6 59.6 44.5 44.5 44.5 44.5 0 0 16.8 19.2 25.5 10.5 8.7-8.7 4-12.7 4-28 0-15.3-17.8-60.2 51-129 68.8-68.8 192-218 192-218z"/>
                                </svg>
                            </div>
                            <div>
                                <div class="flex w-full items-end justify-between">
                                    <a href="{{ route('users.show', ['user'=>$review->user]) }}" class="font-bold hover:text-orange-600">{{ $review->user->name }}</a>
                                    <div class="flex flex-col gap-1">
                                        <x-star-rating :rating="$review->rating"/>
                                            @livewire('likes-counter', ['review' => $review, 'userId' => $userId])
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if($userId === $review->user->id)
                <div class="mt-10 w-full" x-data="{open: false, modal: false}">
                    <div class="flex justify-end gap-4 mt-4 h-8">
                        <button class="btn" @click="open = ! open" x-show="!open">Edit review</button>
                        <button class="btn top-1" @click="open = ! open" x-show="open">Cancel</button>
                        <button @click="modal = ! modal" @click.outside="modal = false" class="btn">Delete review</button>
                        <form action="{{ route('reviews.destroy', ['review'=>$review]) }}" method="POST" class="relative">
                            @csrf
                            @method('DELETE')
                                <div x-show="modal" class="absolute bg-white px-4 py-2 rounded-md top-10 left-[-150px] ring-1 ring-stone-300">
                                    <p class="text-center">Are you sure?</p>
                                    <div class="flex gap-2 mt-2">
                                    <button type="submit" @click="modal = ! modal" class="btn">Yes</button>
                                    <button type="submit" @click="modal = ! modal" class="btn">Cancel</button>
                                    </div>
                                </div>
                        </form>
                    </div>
                    <div x-show="open" class="mt-3">
                        <form method="POST" action="{{ route('reviews.update', ['review' => $review]) }}"
                            class="flex flex-col">
                            @csrf
                            @method('PUT')
                            <div>
                                <select name='rating' id='rating' class="px-2 py-1 rounded-md" value="{{$review->rating}}" required>
                                    @for ($i = 0; $i <= 5; $i++)
                                        <option value="{{ $i }}" {{$review->rating == $i ? 'selected' : '' }}>{{ $i }}</option>
                                    @endfor
                                </select>
                                @error('rating')
                                    <p class="text-xs text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                            <textarea id="text" name="text" class="mt-2 rounded-md h-20 py-1 px-2 ring-1 ring-stone-400" required minlength=15>{{ $review->text }}</textarea>
                            @error('text')
                                <p class="text-xs text-red-500">{{ $message }}</p>
                            @enderror
                            <div class="mt-2">
                                <button class="btn">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            @else
                <div class="mt-10 w-full" x-data="{open: false}">
                    <div class="flex justify-end gap-4 mt-4 h-8">
                        <button class="btn" @click="open = ! open" x-show="!open">Write a comment</button>
                    </div>
                    <div x-show="open" class="mt-3">
                        <form method="POST" action="{{ route('reviews.store-comment', ['review' => $review]) }}"
                            class="flex flex-col">
                            @csrf
                            <textarea id="text" name="text" class="mt-2 rounded-md h-20 py-1 px-2 ring-1 ring-stone-400" required minlength=1></textarea>
                            @error('text')
                                <p class="text-xs text-red-500">{{ $message }}</p>
                            @enderror
                            <div class="flex gap-2 mt-2">
                                <button class="btn">Submit</button>
                                <button class="btn" @click="open = ! open" x-show="open">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
            <div class="flex flex-col gap-4 mt-10">
                @php
                    $comments = array_reverse(json_decode($review->comments));
                @endphp
                @forelse($comments as $comment)
                    <div class="flex bg-stone-200 px-4 py-2 rounded-md">
                        <div class="flex flex-col flex-1">
                            <p class="font-bold">{{ $comment->name }}</p>
                            <p class="serif-font mt-1">{{ $comment->text }}</p>
                        </div>
                        <div class="flex flex-col items-end justify-end">
                            <p class="text-stone-800 text-xs">{{ substr($comment->timestamp, 0, 5) }}</p>
                            <p class="text-stone-800 text-xs">{{ substr($comment->timestamp, 5) }}</p>
                        </div>
                    </div>
                @empty
                    There are no comments yet.
                @endforelse
            </div>
        </div>
    </div>

@endsection

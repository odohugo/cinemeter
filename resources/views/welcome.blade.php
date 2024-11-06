@extends('layouts.app')

@section('content')
    @if(!Session::get('user-id'))
        <div class="flex flex-col w-full py-10 mt-20">
            <div class="flex flex-col items-center gap-10">
                <p>Please log in or create an account to proceed.</p>
                <div class="flex gap-10">
                    <a class="btn" href="{{ route('login') }}">Login</a>
                    <a class="btn" href="{{ route('users.create') }}">Sign Up</a>
                </div>
            </div>
        </div>

    @else
        <div class="flex flex-col w-full">
            <div class="mt-20">
                <h1 class="text-2xl text-center text-stone-800">Welcome {{Session::get('user-name')}}</h1>
            </div>
            <div class="flex flex-col mt-10 gap-5">
                <p class="serif-font">Recent reviews in Cinemeter:</p>
                @forelse($reviews as $review)
                    <x-simple-review :review="$review"/>
                @empty
                @endforelse
            </div>
        </div>

    @endif
@endsection

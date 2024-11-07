@extends('layouts.app')

@section('content')
    <div class="flex flex-col w-full py-10 mt-20">
        <div class="flex flex-col items-center gap-10">
            <p>Please log in or create an account to proceed.</p>
            <div class="flex gap-10">
                <a class="btn" href="{{ route('login') }}">Login</a>
                <a class="btn" href="{{ route('users.create') }}">Sign Up</a>
            </div>
        </div>
    </div>
@endsection

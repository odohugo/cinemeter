@extends('layouts.app')

@section('content')

    <div class="py-10 w-80">

        <h1 class="mb-5 text-xl">Create an account</h1>

        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <div class="flex flex-col gap-3">
                <div class="flex flex-col gap-1">
                    <label for="email" class="text-sm">Email</label>
                    <input type="text" id="email" name="email" class="input" required></input>
                    @error('email')
                        <p class="text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex flex-col gap-1">
                    <label for="password" class="text-sm">Password</label>
                    <input type="password" id="password" name="password" class="input" required></input>
                    @error('password')
                        <p class="text-xs text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex justify-between">
                    <a href="/" class="btn">Cancel</a>
                    <button type="submit" class="btn">Log In</button>
                </div>
            </div>
        </form>

    </div>

@endsection

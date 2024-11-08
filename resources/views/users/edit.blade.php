@extends('layouts.app')

@section('content')

    <div class="flex flex-col w-full px-10 mt-20">
        <div class="flex flex-col items-center">
            <p class="text-6xl lg:text-2xl font-bold text-stone-800">{{ $user->name }} account options:</p>
        </div>

        <div x-data="{modal: false}" class="relative mt-20 flex flex-col items-center">
            <button @click="modal = ! modal" @click.outside="modal = false" class="btn">Delete account</button>
            <form action="{{ route('users.destroy', ['user' => $user]) }}" method="POST">
                @csrf
                @method('DELETE')
                <div x-show="modal" class="absolute bg-white px-8 py-6 rounded-md top-0 left-36 ring-1 ring-stone-300">
                    <p class="text-center">Are you sure?</p>
                    <div class="flex gap-6 mt-4">
                    <button @click.prevent="modal = ! modal" class="btn">Cancel</button>
                    <button type="submit" @click="modal = ! modal" class="btn">Yes</button>
                    </div>
                </div>
            </form>
        </div>

    </div>

@endsection

@extends('layouts.app')

@section('content')

    <div class="mt-10 w-full px-16">
        <form method="GET" action="{{ route('users.index') }}">
            <label for="name" class="text-4xl lg:text-lg">Search for a user</label>
            <div class="flex gap-4 items-center mt-2">
                <input type="text" id="name" name="name" value="{{ request('name') }}" class="input w-full"/>
                <button type="submit" class="btn text-3xl lg:text-base font-bold h-16 lg:h-7">Search</button>
                <a href="{{ route('users.index') }}" class="btn text-3xl lg:text-base font-bold h-16 lg:h-7">Clear</a>
            </div>
        </form>

        @if ($users)
            <div class="mt-10 text-4xl lg:text-base">
                <ul>
                        @forelse($users as $user)
                            <li>
                                <a href="{{ route('users.show', ['user' => $user]) }}">
                                    <div class="w-full px-8 py-6 lg:px-4 lg:py-4 bg-white ring-1 ring-stone-300 hover:ring-orange-600 rounded-lg lg:rounded-md shadow-md">
                                    {{ $user->name }}
                                    </div>
                                </a>
                            </li>
                        @empty
                            <li>No users found.</li>
                        @endforelse
                </ul>
            </div>

            @if ($users->count())
                <nav class="mt-4">
                    {{ $users->links() }}
                </nav>
            @endif
        @endif
    </div>

@endsection

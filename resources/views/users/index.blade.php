@extends('layouts.app')

@section('content')

    <div class="mt-10 w-full px-16">
        <form method="GET" action="{{ route('users.index') }}">
            <label for="name" class="text-lg">Search for a user</label>
            <div class="flex gap-4 items-center mt-2">
                <input type="text" id="name" name="name" value="{{ request('name') }}" class="input w-full h-8"/>
                <button type="submit" class="btn">Search</button>
                <a href="{{ route('users.index') }}" class="btn">Clear</a>
            </div>
        </form>

        @if ($users)
            <div class="mt-5">
                <ul>
                        @forelse($users as $user)
                            <li>
                                <a href="{{ route('users.show', ['user' => $user]) }}">{{ $user->name }}</a>
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

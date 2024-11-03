<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <title>Cinemeter</title>
        @yield('script')
        @vite('resources/css/app.css')
    </head>
    <body class="h-screen bg-slate-100">
        @if (Session::get('user-id'))
            <div class="flex items-center justify-between gap-4 w-full h-12 px-4 bg-slate-700 shadow-sm">
                <div class="flex gap-10 items-baseline">
                    <a href="{{ route('index') }}" class="text-lg font-bold text-amber-300">Cinemeter</a>
                    <a href="{{ route('users.profile') }}" class="text-sm text-cyan-300">Profile</a>
                    <a href="{{ route('movies.index') }}" class="text-sm text-cyan-300">Movies</a>
                    <a href="{{ route('users.index') }}" class="text-sm text-cyan-300">Users</a>
                </div>
                <a href="{{ route('logout') }}" class="btn">Log Out</a>
            </div>
        @endif
        <div class="container mx-auto flex justify-center">
        @yield('content')
        </div>
    </body>
</html>

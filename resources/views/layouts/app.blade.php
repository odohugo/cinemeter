<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <title>Cinemeter</title>
        @yield('script')
        @vite('resources/css/app.css')
        <style>
        @import url('https://fonts.googleapis.com/css2?family=Alfa+Slab+One&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Noto+Serif:ital,wght@0,100..900;1,100..900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap');
        </style>
    </head>
    <body class="relative min-h-screen bg-stone-100 sans-font divide-y divide-stone-300">
            <div class="flex items-center justify-center gap-4 w-full h-20">
                <div class="w-full px-6 lg:px-0 lg:w-3/5 h-12 flex justify-between items-center">
                    <div class="flex gap-10 items-baseline">
                        <a href="{{ route('index') }}" class="text-2xl font-bold text-orange-600 display-font">Cinemeter</a>
                        @if (Session::get('user-id'))
                        <a href="{{ route('users.profile') }}" class="text-sm text-stone-800 font-bold hover:text-orange-600">Profile</a>
                        <a href="{{ route('movies.index') }}" class="text-sm text-stone-800 font-bold hover:text-orange-600">Movies</a>
                        <a href="{{ route('users.index') }}" class="text-sm text-stone-800 font-bold hover:text-orange-600">Users</a>
                        @endif
                    </div>
                    @if (Session::get('user-id'))
                        <a href="{{ route('logout') }}" class="text-sm btn mt-[3px]">Log Out</a>
                    @endif
                </div>
            </div>
        <div class="mx-auto flex w-full px-6 lg:px-0 lg:w-3/5 h-full pb-10">
            @yield('content')
        </div>
        <div class="absolute bottom-0 w-full text-xs text-center pt-2 h-8 mt-10 text-stone-400">
            <p>Built with Laravel by <a href="https://github.com/odohugo" target="_blank" class="text-orange-700">github.com/odohugo</a></p>
        </div>
    </body>
</html>

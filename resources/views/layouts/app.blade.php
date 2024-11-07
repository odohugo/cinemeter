<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <title>Cinemeter</title>
        @vite('resources/css/app.css')
        <script src="//unpkg.com/alpinejs" defer></script>
        <style>
        @import url('https://fonts.googleapis.com/css2?family=Alfa+Slab+One&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Alfa+Slab+One&family=Noto+Serif:ital,wght@0,100..900;1,100..900&family=Rubik:ital,wght@0,300..900;1,300..900&display=swap');
        @livewireStyles
        </style>
    </head>
    <body class="relative min-h-screen bg-gradient-to-br from-stone-50 to-stone-200 sans-font divide-y divide-stone-300">
            <div class="flex items-center justify-center gap-4 w-full h-40 xl:h-20">
                <div class="w-full px-6 lg:px-0 lg:w-3/5 h-12 flex justify-between items-center">
                    <div class="flex gap-16 xl:gap-10 items-baseline">
                        <a href="{{ route('index') }}" class="text-4xl lg:text-2xl font-bold text-orange-600 display-font">Cinemeter</a>
                        @if (Session::get('user-id'))
                        <a href="{{ route('users.profile') }}" class="text-3xl lg:text-sm text-stone-800 font-bold hover:text-orange-600">Profile</a>
                        <a href="{{ route('movies.index') }}" class="text-3xl lg:text-sm text-stone-800 font-bold hover:text-orange-600">Movies</a>
                        <a href="{{ route('users.index') }}" class="text-3xl lg:text-sm text-stone-800 font-bold hover:text-orange-600">Users</a>
                        @endif
                    </div>
                    @if (Session::get('user-id'))
                        <a href="{{ route('logout') }}" class="text-3xl lg:text-sm btn mt-[3px]">Log Out</a>
                    @endif
                </div>
            </div>


        <div class="mx-auto w-full px-6 lg:px-0 lg:w-3/5 h-full pb-20">
            <div x-data="{ flash: true }">
                @if (session()->has('success'))
                <div x-show="flash"
                    class="relative mb-10 mt-2 rounded border border-green-400 bg-green-100 px-4 py-3 text-sm text-green-700"
                    role="alert">
                    <span class="absolute top-1 right-1 cursor-pointer" @click="flash = false">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                        <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
                        </svg>
                    </span>
                    <div>{{ session('success') }}</div>
                </div>
                @endif
            </div>
            @yield('content')
        </div>
        <div class="absolute bottom-0 w-full text-xs text-center pt-2 h-8 mt-10 text-stone-400">
            <p>Built with Laravel by <a href="https://github.com/odohugo" target="_blank" class="text-orange-700">github.com/odohugo</a></p>
        </div>
    </body>
</html>

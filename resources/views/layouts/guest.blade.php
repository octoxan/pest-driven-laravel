<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1">
    <meta name="csrf-token"
          content="{{ csrf_token() }}">

    @include('partials.favicon')

    <title>{{ $pageTitle }}</title>

    @stack('social-meta')

    <!-- Fonts -->

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    <div class="bg-white">
        <div class="relative overflow-hidden">
            <header class="relative">
                <div class="py-6 bg-indigo-500">
                    <nav class="max-w-7xl sm:px-6 relative flex items-center justify-between px-4 mx-auto"
                         aria-label="Global">
                        <div class="flex items-center">
                            <div class="flex items-center justify-between w-auto w-full">
                                <a href="{{ route('pages.home') }}">
                                    <span class="sr-only">LaravelCasts</span>
                                    <img class="sm:h-10 w-auto h-8"
                                         src="{{ asset('images/tv_logo.png') }}"
                                         alt="An illustrated TV as logo for LaraCasts">
                                </a>
                            </div>
                            <div class="flex ml-4 space-x-8">
                                <a href="{{ route('pages.home') }}"
                                   class="text-2xl font-medium text-white">Laravel<span
                                          class="font-bold">Casts</span></a>
                            </div>
                        </div>
                        <div class="flex items-center space-x-6">

                            @guest()
                                <a class="hover:text-gray-300 text-base font-medium text-white"
                                   href="{{ route('login') }}">Login</a>
                            @else
                                <a href="{{ route('pages.dashboard') }}"
                                   class="hover:bg-gray-700 inline-flex items-center px-4 py-2 text-base font-medium text-white bg-gray-600 border border-transparent rounded-md">Dashboard</a>
                            @endguest
                        </div>
                    </nav>
                </div>
            </header>
            {{ $slot }}

            @include('partials.footer')

        </div>
    </div>

    <!-- Scripts -->
    @stack('scripts')

</body>

</html>

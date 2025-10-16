<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Untitled')</title>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    @vite('resources/css/app.css')

    @yield('styles')

</head>

<body class="bg-[#D8F3DC] overflow-x-hidden">
    {{-- @auth
        @include('sidebar', ['user' => Auth::user()])
    @endauth
    <!-- Navbar --> --}}
    @include('partials.landing.navbar')

    <!-- Main content -->
    <div class="container max-w-6xl px-6 mx-auto">
        @yield('content')
    </div>

    <!-- Footer -->
    @include('partials.landing.footer')

    <!-- Include JS files -->
    <!-- Include additional JS if needed -->
    @yield('scripts')
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}

</body>

</html>

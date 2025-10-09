<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />

        <!-- Tom Select CSS -->
        <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="flex min-h-screen bg-[#D8F3DC]">
            
            {{-- Sidebar Ikon --}}
            @include('layouts.sidebar')

            {{-- Wrapper untuk Konten Utama --}}
            <div class="flex-1 flex flex-col">
                
                {{-- Navbar di bagian atas --}}
                @include('layouts.navigation')

                {{-- Konten Utama --}}
                <main class="flex-1 p-10 text-gray-800">
                    <!-- Page Heading -->
                    @if (isset($header))
                        <header>
                            <h1 class="text-3xl font-bold text-[#081C15]">{{ $header }}</h1>
                        </header>
                    @endif

                    <!-- Page Content -->
                    <div class="mt-8">
                        {{ $slot }}
                    </div>
                </main>
            </div>
        </div>

        <!-- Tom Select JS -->
        <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
        @stack('scripts')
    </body>
</html>
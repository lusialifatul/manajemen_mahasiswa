<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="flex flex-col items-center justify-center min-h-screen bg-[#D8F3DC]">
            
            <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-2xl shadow-lg">
                <div class="text-center">
                    <h1 class="text-4xl font-bold text-[#081C15]">🎓 E-Akademik</h1>
                    <p class="mt-2 text-gray-600">Sistem Informasi Manajemen Mahasiswa</p>
                </div>

                <div class="flex flex-col space-y-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="w-full px-4 py-3 text-center text-white bg-[#081C15] rounded-lg hover:bg-[#40916C] transition-colors duration-300 font-semibold">
                                Masuk ke Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="w-full px-4 py-3 text-center text-white bg-[#081C15] rounded-lg hover:bg-[#40916C] transition-colors duration-300 font-semibold">
                                Login
                            </a>

                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="w-full px-4 py-3 text-center text-[#081C15] bg-transparent border border-[#081C15] rounded-lg hover:bg-[#B7E4C7] transition-colors duration-300 font-semibold">
                                    Register
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>

            <footer class="mt-8 text-center text-sm text-gray-500">
                Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
            </footer>
        </div>
    </body>
</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SIMA</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
</head>

<body>
    <nav class="fixed top-0 left-0 w-full bg-white border-b border-emerald-200 backdrop-blur-md z-50">
        <div class="max-w-screen-xl mx-auto flex items-center justify-between p-3">
            <a href="{{ url('/') }}" class="flex items-center space-x-3">
                <img style="width:90px;height:40px" src="{{ asset('images/logo.svg') }}" alt="Icon">
            </a>

            <ul class="hidden md:flex space-x-8">
                <li>
                    <a href="{{ url('/') }}" class="text-[#081C15] hover:text-[#40916C] font-medium">Home</a>
                </li>
                <li>
                    <a href="{{ url('about') }}" class="text-[#081C15] hover:text-[#40916C] font-medium">About</a>
                </li>
                <li>
                    <a href="{{ url('contact') }}" class="text-[#081C15] hover:text-[#40916C] font-medium">Contact</a>
                </li>
            </ul>

            <div class="flex items-center space-x-3">
                <button class="bg-[#40916C] text-white py-1 px-4 rounded hover:bg-[#2D6A4F] transition">
                    Login
                </button>
                <button class="bg-[#40916C] text-white py-1 px-4 rounded hover:bg-[#2D6A4F] transition">
                    Register
                </button>
            </div>
        </div>
    </nav>

    <section class="text-[#081C15] body-font bg-[#D8F3DC]">
        <div class="flex items-center justify-center flex-col w-screen">
            <img class="w-full h-screen object-cover object-center" alt="hero" src="{{ asset('images/i2.jpg') }}">
        </div>

        <div class="max-w-4xl mx-auto text-center px-5 py-10">
            <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-[#40916C]">Welcome To SIMA</h1>
            <p class="text-gray-600 mb-2 leading-relaxed">
                Platform berbasis web yang dirancang untuk membantu pengelolaan data dan aktivitas mahasiswa secara
                terintegrasi.
            </p>
        </div>

        <div class="max-w-4xl mx-auto p-4">
            <div class="h-full bg-white p-8 rounded shadow-lg">
                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="block w-5 h-5 text-gray-400 mb-4"
                    viewBox="0 0 975.036 975.036">
                    <path d="M925.036 57.197h-304c-27.6 0-50 22.4-50 50v304c0
        27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4
        191.2-27.6 37.8-69.399 69.1-125.3 93.8-25.7 11.3-36.8
        41.7-24.8 67.101l36 76c11.6 24.399 40.3 35.1
        65.1 24.399 66.2-28.6 122.101-64.8 167.7-108.8
        55.601-53.7 93.7-114.3 114.3-181.9
        20.601-67.6 30.9-159.8 30.9-276.8v-239c0-27.599-22.401-50-50-50zM106.036
        913.497c65.4-28.5 121-64.699 166.9-108.6 56.1-53.7
        94.4-114.1 115-181.2 20.6-67.1 30.899-159.6
        30.899-277.5v-239c0-27.6-22.399-50-50-50h-304c-27.6
        0-50 22.4-50 50v304c0 27.601 22.4 50
        50 50h145.5c-1.9 79.601-20.4 143.3-55.4
        191.2-27.6 37.8-69.4 69.1-125.3 93.8-25.7
        11.3-36.8 41.7-24.8 67.101l35.9
        75.8c11.601 24.399 40.501 35.2 65.301
        24.399z"></path>
                </svg>

                <p class="leading-relaxed mb-6 text-gray-700">
                    Synth chartreuse iPhone lomo cray raw denim brunch everyday carry neutra before they sold out fixie
                    90's microdosing. Tacos pinterest fanny pack venmo, post-ironic heirloom try-hard pabst authentic
                    iceland.
                </p>

                <a class="inline-flex items-center">
                    <img alt="testimonial" src="https://dummyimage.com/106x106"
                        class="w-12 h-12 rounded-full flex-shrink-0 object-cover object-center">
                    <span class="flex-grow flex flex-col pl-4">
                        <span class="title-font font-medium text-[#081C15]">Holden Caulfield</span>
                        <span class="text-gray-500 text-sm">UI DEVELOPER</span>
                    </span>
                </a>
            </div>
        </div>
    </section>

    <footer class="bg-white text-gray-600 body-font">
        <div
            class="container px-5 py-12 mx-auto flex md:items-center lg:items-start md:flex-row md:flex-nowrap flex-wrap flex-col">
            <div class="w-64 flex-shrink-0 md:mx-0 mx-auto text-center md:text-left">
                <a class="flex title-font font-medium items-center md:justify-start justify-center text-[#40916C]">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2"
                        class="w-10 h-10 text-white p-2 bg-[#40916C] rounded-full" viewBox="0 0 24 24">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"></path>
                    </svg>
                    <span class="ml-3 text-xl">SIMA</span>
                </a>
                <p class="mt-2 text-sm text-gray-500">Air plant banjo lyft occupy retro adaptogen indego</p>
            </div>
            <div class="flex-grow flex flex-wrap md:pl-20 -mb-10 md:mt-0 mt-10 md:text-left text-center">
                <div class="lg:w-1/4 md:w-1/2 w-full px-4">
                    <h2 class="title-font font-medium text-[#40916C] tracking-widest text-sm mb-3">CATEGORIES</h2>
                    <nav class="list-none mb-10">
                        <li>
                            <a class="text-gray-600 hover:text-[#40916C]">First Link</a>
                        </li>
                        <li>
                            <a class="text-gray-600 hover:text-[#40916C]">Second Link</a>
                        </li>
                        <li>
                            <a class="text-gray-600 hover:text-[#40916C]">Third Link</a>
                        </li>
                        <li>
                            <a class="text-gray-600 hover:text-[#40916C]">Fourth Link</a>
                        </li>
                    </nav>
                </div>
                <div class="lg:w-1/4 md:w-1/2 w-full px-4">
                    <h2 class="title-font font-medium text-[#40916C] tracking-widest text-sm mb-3">CATEGORIES</h2>
                    <nav class="list-none mb-10">
                        <li>
                            <a class="text-gray-600 hover:text-[#40916C]">First Link</a>
                        </li>
                        <li>
                            <a class="text-gray-600 hover:text-[#40916C]">Second Link</a>
                        </li>
                        <li>
                            <a class="text-gray-600 hover:text-[#40916C]">Third Link</a>
                        </li>
                        <li>
                            <a class="text-gray-600 hover:text-[#40916C]">Fourth Link</a>
                        </li>
                    </nav>
                </div>
                <div class="lg:w-1/4 md:w-1/2 w-full px-4">
                    <h2 class="title-font font-medium text-[#40916C] tracking-widest text-sm mb-3">CATEGORIES</h2>
                    <nav class="list-none mb-10">
                        <li>
                            <a class="text-gray-600 hover:text-[#40916C]">First Link</a>
                        </li>
                        <li>
                            <a class="text-gray-600 hover:text-[#40916C]">Second Link</a>
                        </li>
                        <li>
                            <a class="text-gray-600 hover:text-[#40916C]">Third Link</a>
                        </li>
                        <li>
                            <a class="text-gray-600 hover:text-[#40916C]">Fourth Link</a>
                        </li>
                    </nav>
                </div>
                <div class="lg:w-1/4 md:w-1/2 w-full px-4">
                    <h2 class="title-font font-medium text-[#40916C] tracking-widest text-sm mb-3">CATEGORIES</h2>
                    <nav class="list-none mb-10">
                        <li>
                            <a class="text-gray-600 hover:text-[#40916C]">First Link</a>
                        </li>
                        <li>
                            <a class="text-gray-600 hover:text-[#40916C]">Second Link</a>
                        </li>
                        <li>
                            <a class="text-gray-600 hover:text-[#40916C]">Third Link</a>
                        </li>
                        <li>
                            <a class="text-gray-600 hover:text-[#40916C]">Fourth Link</a>
                        </li>
                    </nav>
                </div>
            </div>
        </div>
        <div class="bg-gray-500">
            <div class="container mx-auto py-4 px-5 flex flex-wrap flex-col sm:flex-row">
                <p class="text-white text-sm text-center sm:text-left">© 2025 SIMA</p>
                <span class="inline-flex sm:ml-auto sm:mt-0 mt-2 justify-center sm:justify-start">
                    <a class="text-white">
                        <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            class="w-5 h-5" viewBox="0 0 24 24">
                            <path d="M18 2h-3a5 5 0 00-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 011-1h3z"></path>
                        </svg>
                    </a>
                    <a class="ml-3 text-white">
                        <svg fill="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            class="w-5 h-5" viewBox="0 0 24 24">
                            <path
                                d="M23 3a10.9 10.9 0 01-3.14 1.53 4.48 4.48 0 00-7.86 3v1A10.66 10.66 0 013 4s-4 9 5 13a11.64 11.64 0 01-7 2c9 5 20 0 20-11.5a4.5 4.5 0 00-.08-.83A7.72 7.72 0 0023 3z">
                            </path>
                        </svg>
                    </a>
                    <a class="ml-3 text-white">
                        <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                            stroke-width="2" class="w-5 h-5" viewBox="0 0 24 24">
                            <rect width="20" height="20" x="2" y="2" rx="5" ry="5"></rect>
                            <path d="M16 11.37A4 4 0 1112.63 8 4 4 0 0116 11.37zm1.5-4.87h.01"></path>
                        </svg>
                    </a>
                    <a class="ml-3 text-white">
                        <svg fill="currentColor" stroke="currentColor" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="0" class="w-5 h-5" viewBox="0 0 24 24">
                            <path stroke="none"
                                d="M16 8a6 6 0 016 6v7h-4v-7a2 2 0 00-2-2 2 2 0 00-2 2v7h-4v-7a6 6 0 016-6zM2 9h4v12H2z">
                            </path>
                            <circle cx="4" cy="4" r="2" stroke="none"></circle>
                        </svg>
                    </a>
                </span>
            </div>
        </div>
    </footer>

</body>

</html>

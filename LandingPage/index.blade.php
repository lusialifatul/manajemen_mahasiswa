@extends('layouts.homelayouts')

@section('title', 'SIMA')

@section('content')
    <main>
        <section class="text-[#081C15] body-font bg-[#D8F3DC]">
            <div class="flex items-center justify-center flex-col w-screen">
                <img class="w-full h-screen object-cover object-center" alt="hero"
                    src="https://images.unsplash.com/photo-1627556704283-452301a45fd0?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D">
            </div>

            <div class="max-w-4xl mx-auto text-center px-5 py-10">
                <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-[#40916C]">Welcome To SIMA</h1>
                <p class="text-gray-600 mb-2 leading-relaxed">
                    Platform berbasis web yang dirancang untuk membantu pengelolaan data dan aktivitas mahasiswa secara
                    terintegrasi.
                </p>
            </div>

            <div class="max-w-4xl mx-auto p-4">
                <div class="bg-white p-8 rounded shadow-lg">
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
                        Education is the most powerful weapon which you can use to change the world. A timeless reminder
                        from Nelson Mandela that learning isn’t just about books or classrooms it’s about empowering minds,
                        shaping futures, and building a world where knowledge becomes the foundation of progress and
                        equality.
                    </p>

                    <a class="inline-flex items-center">
                        <img alt="testimonial"
                            src="https://upload.wikimedia.org/wikipedia/commons/thumb/0/02/Nelson_Mandela_1994.jpg/500px-Nelson_Mandela_1994.jpg"
                            class="w-12 h-12 rounded-full flex-shrink-0 object-cover object-center">
                        <span class="flex-grow flex flex-col pl-4">
                            <span class="title-font font-medium text-[#081C15]">Nelson Mandela</span>
                            <span class="text-gray-500 text-sm">President of South Africa</span>
                        </span>
                    </a>
                </div>
            </div>
        </section>
    </main>

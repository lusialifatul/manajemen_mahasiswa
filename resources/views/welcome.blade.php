@extends('layouts.landing')

@section('title', 'SIMA')

@section('content')
    <main>
        <section class="text-[#081C15] body-font">
            <div class="relative w-screen left-[50%] right-[50%] -ml-[50vw] -mr-[50vw] h-screen">
                <img class="absolute inset-0 w-full h-full object-cover" alt="hero"
                    src="https://images.unsplash.com/photo-1627556704283-452301a45fd0?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D">
            </div>

            <div class="max-w-4xl mx-auto text-center px-5 py-10">
                <h1 class="title-font sm:text-4xl text-3xl mb-4 font-medium text-[#40916C]">Welcome To SIMA</h1>
                <p class="text-gray-600 mb-2 leading-relaxed">
                    Platform berbasis web yang dirancang untuk membantu pengelolaan data dan aktivitas mahasiswa secara
                    terintegrasi.
                </p>
            </div>
        </section>

        <section class="text-[#081C15] body-font bg-[#D8F3DC]">
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

        <section class="text-gray-700 body-font">
            <div class="container mx-auto px-5 py-24">
                <h1 class="sm:text-3xl text-2xl font-medium text-center text-[#40916C] mb-16">
                    Our Story
                </h1>

                <div class="flex flex-col space-y-16">
                    <div class="flex flex-col md:flex-row items-center md:items-start md:space-x-8">
                        <div class="md:w-1/2 mb-6 md:mb-0">
                            <img src="https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8Mnx8bWFuYWdlbWVudHxlbnwwfHwwfHx8MA%3D%3D&auto=format&fit=crop&q=60&w=600"
                                alt="Macintosh" class="rounded-2xl shadow-lg w-full h-full object-cover" />
                        </div>
                        <div class="md:w-1/2 text-gray-800">
                            <time class="block italic text-gray-500 mb-2">2 Oktober 2025</time>
                            <h2 class="text-2xl font-medium mb-4 text-[#40916C]">Latar Belakang</h2>
                            <p class="text-gray-600 leading-relaxed">
                                Proyek website manajemen mahasiswa ini dibuat sebagai portofolio kolaboratif antara dua
                                orang dengan latar belakang software engineering dan statistika. Tujuan utamanya adalah
                                mengembangkan sistem yang mampu mengelola data mahasiswa, mulai dari pencatatan hingga
                                visualisasi data akademik.
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row items-center md:items-start md:space-x-8">
                        <div class="md:w-1/2 mb-6 md:mb-0">
                            <img src="https://images.unsplash.com/photo-1573867639040-6dd25fa5f597?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=1170"
                                alt="iMac" class="rounded-2xl shadow-lg w-full h-full object-cover" />
                        </div>
                        <div class="md:w-1/2 text-gray-800">
                            <time class="block italic text-gray-500 mb-2">1998</time>
                            <h2 class="text-2xl font-medium mb-4 text-[#40916C]">iMac</h2>
                            <p class="text-gray-600 leading-relaxed">
                                iMac is a family of all-in-one Mac desktop computers designed and built by Apple Inc.
                                It has been the primary part of Apple's consumer desktop offerings since its debut in
                                August 1998, and has evolved through seven distinct forms.
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row items-center md:items-start md:space-x-8">
                        <div class="md:w-1/2 mb-6 md:mb-0">
                            <img src="https://plus.unsplash.com/premium_photo-1678565869434-c81195861939?ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&q=80&w=1170"
                                alt="iPod" class="rounded-2xl shadow-lg w-full h-full object-cover" />
                        </div>
                        <div class="md:w-1/2 text-gray-800">
                            <time class="block italic text-gray-500 mb-2">2001</time>
                            <h2 class="text-2xl font-medium mb-4 text-[#40916C]">iPod</h2>
                            <p class="text-gray-600 leading-relaxed">
                                The iPod is a discontinued series of portable media players and multi-purpose mobile
                                devices designed and marketed by Apple Inc. The first version was released on October
                                23, 2001. Over 450 million iPods were sold before Apple discontinued the product line
                                in 2022.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="text-gray-600 body-font relative">
            <div class="container px-5 py-24 mx-auto">
                <div class="flex flex-col text-center w-full mb-12">
                    <h1 class="sm:text-3xl text-2xl font-medium title-font mb-4 text-[#40916C]">Contact Us</h1>
                    <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Silakan hubungi kami untuk pertanyaan, saran, atau
                        kerja sama terkait pengembangan website. Tim kami akan dengan senang hati membantu secepat mungkin.
                    </p>
                </div>
                <div class="lg:w-1/2 md:w-2/3 mx-auto">
                    @if(session('success'))
                        <div class="p-4 mb-4 text-sm text-green-700 bg-green-100 rounded-lg" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{ route('contact.store') }}" method="POST">
                        @csrf
                        <div class="flex flex-wrap -m-2">
                            <div class="p-2 w-1/2">
                                <div class="relative">
                                    <label for="name" class="leading-7 text-sm text-gray-600">Name</label>
                                    <input type="text" id="name" name="name"
                                        class="w-full bg-white rounded border border-gray-500 focus:border-[#40916C] focus:ring-2 focus:ring-[#2D6A4F] text-base outline-none text-gray-700 py-1 px-3">
                                </div>
                            </div>
                            <div class="p-2 w-1/2">
                                <div class="relative">
                                    <label for="email" class="leading-7 text-sm text-gray-600">Email</label>
                                    <input type="email" id="email" name="email"
                                        class="w-full bg-white rounded border border-gray-500 focus:border-[#40916C] focus:ring-2 focus:ring-[#2D6A4F] text-base outline-none text-gray-700 py-1 px-3">
                                </div>
                            </div>
                            <div class="p-2 w-full">
                                <div class="relative">
                                    <label for="message" class="leading-7 text-sm text-gray-600">Message</label>
                                    <textarea id="message" name="message"
                                        class="w-full bg-white rounded border border-gray-500 focus:border-[#40916C] focus:ring-2 focus:ring-[#2D6A4F] h-32 text-base outline-none text-gray-700 py-1 px-3"></textarea>
                                </div>
                            </div>
                            <div class="p-2 w-full">
                                <button type="submit"
                                    class="flex mx-auto text-white bg-[#40916C] border-0 py-2 px-8 focus:outline-none hover:bg-[#2D6A4F] rounded text-lg">
                                    Kirim
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </section>

        
    </main>
@endsection
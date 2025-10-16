@extends('layouts.homelayouts')

@section('title', 'About | SIMA')

@section('content')
    <main>
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

    </main>
@endsection

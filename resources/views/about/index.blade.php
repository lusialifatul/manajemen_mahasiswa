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
                            <img src="https://images.unsplash.com/photo-1598257006626-48b0c252070d?auto=format&fit=crop&w=800&q=80"
                                alt="Macintosh" class="rounded-2xl shadow-lg w-full h-full object-cover" />
                        </div>
                        <div class="md:w-1/2 text-gray-800">
                            <time class="block italic text-gray-500 mb-2">1984</time>
                            <h2 class="text-2xl font-medium mb-4 text-[#40916C]">First Macintosh Computer</h2>
                            <p class="text-gray-600 leading-relaxed">
                                The Apple Macintosh—later rebranded as the Macintosh 128K—is the original Apple
                                Macintosh personal computer. It played a pivotal role in establishing desktop
                                publishing as a general office function. The motherboard, a 9-inch CRT monitor,
                                and a floppy drive were housed in a beige case with integrated carrying handle;
                                it came with a keyboard and single-button mouse.
                            </p>
                        </div>
                    </div>

                    <div class="flex flex-col md:flex-row items-center md:items-start md:space-x-8">
                        <div class="md:w-1/2 mb-6 md:mb-0">
                            <img src="https://images.unsplash.com/photo-1517336714731-489689fd1ca8?auto=format&fit=crop&w=800&q=80"
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
                            <img src="https://images.unsplash.com/photo-1598257006626-48b0c252070d?auto=format&fit=crop&w=800&q=80"
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

<x-app-layout>
    {{-- Page Header --}}
    <x-slot name="header">
        Dashboard
    </x-slot>

    {{-- Welcome Banner --}}
    <div class="p-6 bg-white shadow-md rounded-lg mb-8">
        <h2 class="text-2xl font-bold text-gray-800">Selamat Datang, {{ $mahasiswa->nama_lengkap }}!</h2>
        <p class="text-gray-600">Semoga harimu menyenangkan dan penuh semangat untuk belajar.</p>
    </div>

    {{-- Main Grid Layout --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- Left Column (Main Content) --}}
        <div class="lg:col-span-2 space-y-8">

            {{-- Widget: Jadwal Kuliah Hari Ini --}}
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="font-bold text-xl mb-4 text-gray-800">Jadwal Kuliah Hari Ini</h3>
                <div class="space-y-4">
                    @forelse ($jadwalHariIni as $jadwal)
                        <div class="flex items-center p-4 border rounded-md bg-gray-50">
                            <div class="mr-4 text-center">
                                <p class="text-lg font-bold text-green-700">{{ \Carbon\Carbon::parse($jadwal->jam_mulai)->format('H:i') }}</p>
                                <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($jadwal->jam_selesai)->format('H:i') }}</p>
                            </div>
                            <div class="flex-grow">
                                <p class="font-semibold text-gray-700">{{ $jadwal->mataKuliah->nama_matakuliah }}</p>
                                <p class="text-sm text-gray-500">{{ $jadwal->ruangan }} - {{ $jadwal->dosen->name }}</p>
                            </div>
                            <i class="fa-solid fa-chevron-right text-gray-400"></i>
                        </div>
                    @empty
                        <div class="text-center py-4 text-gray-500">
                            <i class="fa-solid fa-mug-saucer fa-2x mb-2"></i>
                            <p>Tidak ada jadwal kuliah hari ini. Selamat beristirahat!</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Widget: Tugas Mendatang (Disembunyikan karena data belum ada) --}}
            {{--
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="font-bold text-xl mb-4 text-gray-800">Tugas & Ujian Mendatang</h3>
                <ul class="space-y-3">
                    <li class="flex justify-between items-center p-3 bg-yellow-50 rounded-md">
                        <div>
                            <p class="font-semibold text-gray-800">Proyek Akhir Pemrograman Web</p>
                            <p class="text-sm text-gray-500">Deadline: <span class="font-medium text-red-600">25 Oktober 2025</span></p>
                        </div>
                        <span class="text-sm font-bold text-yellow-800 bg-yellow-200 px-2 py-1 rounded">TUGAS</span>
                    </li>
                </ul>
            </div>
            --}}

        </div>

        {{-- Right Column (Side Content) --}}
        <div class="space-y-8">

            {{-- Widget: Ringkasan Akademik --}}
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="font-bold text-xl mb-4 text-gray-800">Ringkasan Akademik</h3>
                <div class="space-y-4">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">IPK</span>
                        <span class="font-bold text-2xl text-green-700">{{ number_format($mahasiswa->ipk, 2) }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Total SKS</span>
                        {{-- Logika SKS perlu di-refine jika ada data historis --}}
                        <span class="font-bold text-lg text-gray-800">{{ $totalSks }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Semester</span>
                        <span class="font-bold text-lg text-gray-800">{{ $mahasiswa->semester_aktif }}</span>
                    </div>
                    @if($mahasiswa->dosenPembimbing)
                    <div>
                        <span class="text-gray-600 d-block">Dosen Pembimbing</span>
                        <p class="font-bold text-lg text-gray-800">{{ $mahasiswa->dosenPembimbing->name }}</p>
                    </div>
                    @endif
                </div>
            </div>

            {{-- Widget: Aksi Cepat --}}
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="font-bold text-xl mb-4 text-gray-800">Aksi Cepat</h3>
                <div class="grid grid-cols-2 gap-4">
                    <a href="{{ route('krs.index') }}" class="text-center p-4 bg-green-100 hover:bg-green-200 rounded-lg transition">
                        <i class="fa-solid fa-file-pen fa-2x text-green-700"></i>
                        <p class="mt-2 font-semibold text-sm text-green-800">Isi KRS</p>
                    </a>
                    <a href="{{ route('khs.index') }}" class="text-center p-4 bg-blue-100 hover:bg-blue-200 rounded-lg transition">
                        <i class="fa-solid fa-rectangle-list fa-2x text-blue-700"></i>
                        <p class="mt-2 font-semibold text-sm text-blue-800">Lihat KHS</p>
                    </a>
                    <a href="{{ route('jadwal.index') }}" class="text-center p-4 bg-purple-100 hover:bg-purple-200 rounded-lg transition">
                        <i class="fa-solid fa-calendar-days fa-2x text-purple-700"></i>
                        <p class="mt-2 font-semibold text-sm text-purple-800">Jadwal</p>
                    </a>
                    <a href="{{ route('reports.transkrip') }}" class="text-center p-4 bg-red-100 hover:bg-red-200 rounded-lg transition">
                        <i class="fa-solid fa-graduation-cap fa-2x text-red-700"></i>
                        <p class="mt-2 font-semibold text-sm text-red-800">Transkrip</p>
                    </a>
                </div>
            </div>

            {{-- Widget: Pengumuman (Data statis, bisa dikembangkan) --}}
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="font-bold text-xl mb-4 text-gray-800">Pengumuman</h3>
                <ul class="space-y-3">
                    <li class="text-sm text-gray-700 hover:bg-gray-50 p-2 rounded"><a href="#"><span class="font-bold text-gray-900">[Akademik]</span> Perubahan Jadwal UAS Semester Ganjil</a></li>
                    <li class="text-sm text-gray-700 hover:bg-gray-50 p-2 rounded"><a href="#"><span class="font-bold text-gray-900">[Dosen]</span> Materi Tambahan Basis Data</a></li>
                </ul>
            </div>

        </div>

    </div>

</x-app-layout>

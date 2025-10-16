<x-app-layout>
    <x-slot name="header">
        Dashboard Dosen
    </x-slot>

    {{-- Welcome Banner --}}
    <div class="p-6 bg-white shadow-md rounded-lg mb-8">
        <h2 class="text-2xl font-bold text-gray-800">Selamat Datang, {{ $dosen->name }}!</h2>
        <p class="text-gray-600">Semoga hari Anda produktif dalam mengajar dan membimbing.</p>
    </div>

    {{-- Main Grid Layout --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- Left Column (Main Content) --}}
        <div class="lg:col-span-2 space-y-8">

            {{-- Widget: Jadwal Mengajar Hari Ini --}}
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="font-bold text-xl mb-4 text-gray-800">Jadwal Mengajar Hari Ini</h3>
                <div class="space-y-4">
                    @forelse ($jadwalHariIni as $jadwal)
                        <div class="flex items-center p-4 border rounded-md bg-gray-50">
                            <div class="mr-4 text-center">
                                <p class="text-lg font-bold text-green-700">{{ \Carbon\Carbon::parse($jadwal->waktu_mulai)->format('H:i') }}</p>
                                <p class="text-sm text-gray-500">{{ \Carbon\Carbon::parse($jadwal->waktu_selesai)->format('H:i') }}</p>
                            </div>
                            <div class="flex-grow">
                                <p class="font-semibold text-gray-700">{{ $jadwal->mataKuliah->nama_matakuliah }}</p>
                                <p class="text-sm text-gray-500">{{ $jadwal->ruangan }} - Kelas: {{ $jadwal->krsDetails->first()->krs->mahasiswa->first()->nim ?? 'N/A' }}</p>
                            </div>
                            <i class="fa-solid fa-chevron-right text-gray-400"></i>
                        </div>
                    @empty
                        <div class="text-center py-4 text-gray-500">
                            <i class="fa-solid fa-mug-saucer fa-2x mb-2"></i>
                            <p>Tidak ada jadwal mengajar hari ini.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            {{-- Widget: Permintaan Persetujuan KRS --}}
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="font-bold text-xl mb-4 text-gray-800">Permintaan Persetujuan KRS</h3>
                <ul class="space-y-3">
                    @forelse ($krsMenungguPersetujuan as $krs)
                        <li class="flex justify-between items-center p-3 bg-yellow-50 rounded-md">
                            <div>
                                <p class="font-semibold text-gray-800">KRS Mahasiswa: {{ $krs->mahasiswa->nama_lengkap }}</p>
                                <p class="text-sm text-gray-500">Semester: {{ $krs->semester }} ({{ $krs->tahun_akademik }})</p>
                            </div>
                            <a href="{{ route('krs.review.show', $krs->id) }}" class="text-sm font-bold text-yellow-800 bg-yellow-200 px-2 py-1 rounded hover:bg-yellow-300">Review</a>
                        </li>
                    @empty
                        <li class="text-center py-4 text-gray-500">
                            <p>Tidak ada permintaan KRS yang menunggu persetujuan.</p>
                        </li>
                    @endforelse
                </ul>
            </div>

        </div>

        {{-- Right Column (Side Content) --}}
        <div class="space-y-8">

            {{-- Widget: Daftar Mata Kuliah Diampu --}}
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="font-bold text-xl mb-4 text-gray-800">Mata Kuliah Diampu</h3>
                <ul class="space-y-3">
                    @forelse ($mataKuliahDiampu as $jadwal)
                        <li class="text-sm text-gray-700 hover:bg-gray-50 p-2 rounded">
                            <span class="font-bold text-gray-900">{{ $jadwal->mataKuliah->nama_matakuliah }}</span>
                            <p class="text-xs text-gray-500">Semester {{ $jadwal->semester }} ({{ $jadwal->tahun_akademik }})</p>
                        </li>
                    @empty
                        <li class="text-center py-4 text-gray-500">
                            <p>Tidak ada mata kuliah yang diampu.</p>
                        </li>
                    @endforelse
                </ul>
            </div>

            {{-- Widget: Mahasiswa Bimbingan Akademik --}}
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="font-bold text-xl mb-4 text-gray-800">Mahasiswa Bimbingan</h3>
                <ul class="space-y-3">
                    @forelse ($mahasiswaBimbingan as $mhs)
                        <li class="text-sm text-gray-700 hover:bg-gray-50 p-2 rounded">
                            <span class="font-bold text-gray-900">{{ $mhs->nama_lengkap }}</span>
                            <p class="text-xs text-gray-500">NIM: {{ $mhs->nim }}</p>
                        </li>
                    @empty
                        <li class="text-center py-4 text-gray-500">
                            <p>Tidak ada mahasiswa bimbingan.</p>
                        </li>
                    @endforelse
                </ul>
            </div>

            {{-- Widget: Pengumuman Terbaru --}}
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="font-bold text-xl mb-4 text-gray-800">Pengumuman Terbaru</h3>
                <ul class="space-y-3">
                    @forelse ($pengumumanTerbaru as $pengumuman)
                        <li class="text-sm text-gray-700 hover:bg-gray-50 p-2 rounded">
                            <a href="#" class="font-bold text-gray-900">{{ $pengumuman->judul }}</a>
                            <p class="text-xs text-gray-500">{{ \Carbon\Carbon::parse($pengumuman->created_at)->diffForHumans() }}</p>
                        </li>
                    @empty
                        <li class="text-center py-4 text-gray-500">
                            <p>Tidak ada pengumuman terbaru.</p>
                        </li>
                    @endforelse
                </ul>
            </div>

        </div>

    </div>

</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mata Kuliah yang Diampu') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    @if(Auth::user()->role === 'admin')
                        <div class="mb-6 pb-6 border-b border-gray-200">
                            <form action="{{ route('matakuliah.my_courses') }}" method="GET">
                                <label for="dosen_id" class="block text-sm font-medium text-gray-700">Pilih Dosen untuk Melihat Mata Kuliah yang Diampu:</label>
                                <select name="dosen_id" id="dosen_id" class="mt-1 block w-full md:w-1/2 pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-[#40916C] focus:border-[#40916C] sm:text-sm rounded-md" onchange="this.form.submit()">
                                    <option value="">-- Pilih seorang dosen --</option>
                                    @foreach($dosens as $dosen)
                                        <option value="{{ $dosen->id }}" {{ (string)$selectedDosenId === (string)$dosen->id ? 'selected' : '' }}>
                                            {{ $dosen->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    @endif

                    @if($groupedCourses->isEmpty())
                        <div class="text-center py-8">
                            @if(Auth::user()->role === 'admin')
                                @if($selectedDosenId)
                                    <p class="text-gray-500">Dosen yang dipilih tidak memiliki jadwal mengajar.</p>
                                @else
                                    <p class="text-gray-500">Silakan pilih seorang dosen dari daftar di atas.</p>
                                @endif
                            @else
                                <p class="text-gray-500">Anda tidak memiliki jadwal mengajar mata kuliah saat ini.</p>
                            @endif
                        </div>
                    @else
                        <div class="space-y-6">
                            @foreach($groupedCourses as $group)
                                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow duration-200">
                                    <div class="flex justify-between items-start">
                                        <div>
                                            <h3 class="text-lg font-bold text-[#40916C]">{{ $group->mataKuliah->nama_mk }}</h3>
                                            <p class="text-sm text-gray-600">{{ $group->mataKuliah->kode_mk }} | {{ $group->mataKuliah->sks }} SKS</p>
                                        </div>
                                        <div class="text-right flex-shrink-0 ml-4">
                                            <span class="text-sm font-semibold bg-gray-200 text-gray-800 px-2 py-1 rounded-md">
                                                Total {{ $group->totalMahasiswa }} Mahasiswa
                                            </span>
                                        </div>
                                    </div>
                                    <div class="mt-4">
                                        <h4 class="font-semibold text-gray-700">Jadwal Mengajar:</h4>
                                        <ul class="list-disc list-inside mt-2 space-y-1 text-sm text-gray-600">
                                            @foreach($group->jadwals as $jadwal)
                                                <li>
                                                    {{ $jadwal->hari }}, Pukul {{ $jadwal->waktu_mulai }} - {{ $jadwal->waktu_selesai }}
                                                    <span class="font-medium"> (T.A. {{ $jadwal->tahun_akademik }}, Semester {{ $jadwal->semester }})</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
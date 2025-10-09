<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Jadwal Kuliah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('jadwal.update', $jadwal->id) }}">
                        @csrf
                        @method('PATCH')

                        <!-- Mata Kuliah -->
                        <div class="mb-4">
                            <label for="mata_kuliah_id" class="block text-sm font-medium text-gray-700">Mata Kuliah</label>
                            <select id="mata_kuliah_id" name="mata_kuliah_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" required>
                                <option value="">Pilih Mata Kuliah</option>
                                @foreach($mataKuliahs as $mk)
                                    <option value="{{ $mk->id }}" {{ old('mata_kuliah_id', $jadwal->mata_kuliah_id) == $mk->id ? 'selected' : '' }}>{{ $mk->nama_mata_kuliah }}</option>
                                @endforeach
                            </select>
                            @error('mata_kuliah_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Dosen -->
                        <div class="mb-4">
                            <label for="dosen_id" class="block text-sm font-medium text-gray-700">Dosen Pengampu</label>
                            <select id="dosen_id" name="dosen_id" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" required>
                                <option value="">Pilih Dosen</option>
                                @foreach($dosens as $dosen)
                                    <option value="{{ $dosen->id }}" {{ old('dosen_id', $jadwal->dosen_id) == $dosen->id ? 'selected' : '' }}>{{ $dosen->name }}</option>
                                @endforeach
                            </select>
                            @error('dosen_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Hari -->
                        <div class="mb-4">
                            <label for="hari" class="block text-sm font-medium text-gray-700">Hari</label>
                            <select id="hari" name="hari" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" required>
                                <option value="">Pilih Hari</option>
                                @foreach(['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'] as $day)
                                    <option value="{{ $day }}" {{ old('hari', $jadwal->hari) == $day ? 'selected' : '' }}>{{ $day }}</option>
                                @endforeach
                            </select>
                            @error('hari')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Waktu Mulai -->
                        <div class="mb-4">
                            <label for="waktu_mulai" class="block text-sm font-medium text-gray-700">Waktu Mulai</label>
                            <input type="time" id="waktu_mulai" name="waktu_mulai" value="{{ old('waktu_mulai', $jadwal->waktu_mulai) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            @error('waktu_mulai')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Waktu Selesai -->
                        <div class="mb-4">
                            <label for="waktu_selesai" class="block text-sm font-medium text-gray-700">Waktu Selesai</label>
                            <input type="time" id="waktu_selesai" name="waktu_selesai" value="{{ old('waktu_selesai', $jadwal->waktu_selesai) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            @error('waktu_selesai')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Ruangan -->
                        <div class="mb-4">
                            <label for="ruangan" class="block text-sm font-medium text-gray-700">Ruangan</label>
                            <input type="text" id="ruangan" name="ruangan" value="{{ old('ruangan', $jadwal->ruangan) }}" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                            @error('ruangan')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Semester -->
                        <div class="mb-4">
                            <label for="semester" class="block text-sm font-medium text-gray-700">Semester</label>
                            <select id="semester" name="semester" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" required>
                                <option value="">Pilih Semester</option>
                                <option value="Ganjil" {{ old('semester', $jadwal->semester) == 'Ganjil' ? 'selected' : '' }}>Ganjil</option>
                                <option value="Genap" {{ old('semester', $jadwal->semester) == 'Genap' ? 'selected' : '' }}>Genap</option>
                            </select>
                            @error('semester')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tahun Akademik -->
                        <div class="mb-4">
                            <label for="tahun_akademik" class="block text-sm font-medium text-gray-700">Tahun Akademik</label>
                            <select id="tahun_akademik" name="tahun_akademik" class="mt-1 block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm rounded-md" required>
                                <option value="">Pilih Tahun Akademik</option>
                                @php
                                    $currentYear = date('Y');
                                    for ($i = $currentYear; $i >= $currentYear - 5; $i--) {
                                        $yearRange = $i . '/' . ($i + 1);
                                        echo "<option value=\"{$yearRange}\" " . (old('tahun_akademik', $jadwal->tahun_akademik) == $yearRange ? 'selected' : '') . ">{$yearRange}</option>";
                                    }
                                @endphp
                            </select>
                            @error('tahun_akademik')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:border-indigo-900 focus:ring ring-indigo-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Perbarui Jadwal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

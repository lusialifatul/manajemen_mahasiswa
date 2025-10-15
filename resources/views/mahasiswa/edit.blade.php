<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Data Mahasiswa
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('mahasiswa.update', $mahasiswa) }}">
                        @csrf
                        @method('PUT')

                        <!-- Nama Lengkap -->
                        <div>
                            <x-input-label for="nama_lengkap" :value="__('Nama Lengkap')" />
                            <x-text-input id="nama_lengkap" class="block mt-1 w-full" type="text" name="nama_lengkap" :value="old('nama_lengkap', $mahasiswa->nama_lengkap)" required autofocus />
                            <x-input-error :messages="$errors->get('nama_lengkap')" class="mt-2" />
                        </div>

                        <!-- NIM -->
                        <div class="mt-4">
                            <x-input-label for="nim" :value="__('NIM')" />
                            <x-text-input id="nim" class="block mt-1 w-full" type="text" name="nim" :value="old('nim', $mahasiswa->nim)" required />
                            <x-input-error :messages="$errors->get('nim')" class="mt-2" />
                        </div>

                        <!-- Semester Aktif -->
                        <div class="mt-4">
                            <x-input-label for="semester_aktif" :value="__('Semester Aktif')" />
                            <x-text-input id="semester_aktif" class="block mt-1 w-full" type="number" name="semester_aktif" :value="old('semester_aktif', $mahasiswa->semester_aktif)" required />
                            <x-input-error :messages="$errors->get('semester_aktif')" class="mt-2" />
                        </div>

                        <!-- IPK -->
                        <div class="mt-4">
                            <x-input-label for="ipk" :value="__('IPK')" />
                            <x-text-input id="ipk" class="block mt-1 w-full" type="text" name="ipk" :value="old('ipk', $mahasiswa->ipk)" required />
                            <x-input-error :messages="$errors->get('ipk')" class="mt-2" />
                        </div>

                        <!-- Dosen Pembimbing -->
                        <div class="mt-4">
                            <x-input-label for="dosen_pembimbing_id" :value="__('Dosen Pembimbing')" />
                            <select name="dosen_pembimbing_id" id="dosen_pembimbing_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">-- Pilih Dosen --</option>
                                @foreach ($dosens as $dosen)
                                    <option value="{{ $dosen->id }}" {{ old('dosen_pembimbing_id', $mahasiswa->dosen_pembimbing_id) == $dosen->id ? 'selected' : '' }}>
                                        {{ $dosen->name }}
                                    </option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('dosen_pembimbing_id')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('mahasiswa.index') }}" class="text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Batal
                            </a>
                            <x-primary-button class="ms-4">
                                {{ __('Simpan Perubahan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

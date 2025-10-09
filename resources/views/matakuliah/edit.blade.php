<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Mata Kuliah') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form action="{{ route('matakuliah.update', $matakuliah->id) }}" method="POST">
                        @csrf
                        @method('PATCH')

                        {{-- Kode MK --}}
                        <div class="mb-4">
                            <x-input-label for="kode_mk" :value="__('Kode Mata Kuliah')" />
                            <x-text-input id="kode_mk" class="block mt-1 w-full" type="text" name="kode_mk" :value="old('kode_mk', $matakuliah->kode_mk)" required autofocus />
                            <x-input-error :messages="$errors->get('kode_mk')" class="mt-2" />
                        </div>

                        {{-- Nama MK --}}
                        <div class="mb-4">
                            <x-input-label for="nama_mk" :value="__('Nama Mata Kuliah')" />
                            <x-text-input id="nama_mk" class="block mt-1 w-full" type="text" name="nama_mk" :value="old('nama_mk', $matakuliah->nama_mk)" required />
                            <x-input-error :messages="$errors->get('nama_mk')" class="mt-2" />
                        </div>

                        {{-- SKS --}}
                        <div class="mb-4">
                            <x-input-label for="sks" :value="__('SKS')" />
                            <x-text-input id="sks" class="block mt-1 w-full" type="number" name="sks" :value="old('sks', $matakuliah->sks)" required />
                            <x-input-error :messages="$errors->get('sks')" class="mt-2" />
                        </div>

                        {{-- Semester --}}
                        <div class="mb-4">
                            <x-input-label for="semester" :value="__('Semester')" />
                            <x-text-input id="semester" class="block mt-1 w-full" type="number" name="semester" :value="old('semester', $matakuliah->semester)" required />
                            <x-input-error :messages="$errors->get('semester')" class="mt-2" />
                        </div>

                        {{-- Jenis --}}
                        <div class="mb-4">
                            <x-input-label for="jenis" :value="__('Jenis')" />
                            <select name="jenis" id="jenis" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="Wajib" @selected(old('jenis', $matakuliah->jenis) == 'Wajib')>Wajib</option>
                                <option value="Pilihan" @selected(old('jenis', $matakuliah->jenis) == 'Pilihan')>Pilihan</option>
                                <option value="Wajib Umum" @selected(old('jenis', $matakuliah->jenis) == 'Wajib Umum')>Wajib Umum</option>
                            </select>
                            <x-input-error :messages="$errors->get('jenis')" class="mt-2" />
                        </div>

                        {{-- Deskripsi --}}
                        <div class="mb-4">
                            <x-input-label for="deskripsi" :value="__('Deskripsi (Opsional)')" />
                            <textarea name="deskripsi" id="deskripsi" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">{{ old('deskripsi', $matakuliah->deskripsi) }}</textarea>
                            <x-input-error :messages="$errors->get('deskripsi')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('matakuliah.index') }}" class="text-sm text-gray-600 hover:text-gray-900 mr-4">
                                Batal
                            </a>
                            <x-primary-button>
                                {{ __('Update') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

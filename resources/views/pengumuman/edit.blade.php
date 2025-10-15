<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Edit Pengumuman
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form method="POST" action="{{ route('pengumuman.update', $pengumuman->id) }}">
                        @csrf
                        @method('patch')

                        <!-- Judul Pengumuman -->
                        <div>
                            <x-input-label for="judul" :value="__('Judul Pengumuman')" />
                            <x-text-input id="judul" class="block mt-1 w-full" type="text" name="judul" :value="old('judul', $pengumuman->judul)" required autofocus />
                            <x-input-error :messages="$errors->get('judul')" class="mt-2" />
                        </div>

                        <!-- Isi Pengumuman -->
                        <div class="mt-4">
                            <x-input-label for="isi" :value="__('Isi Pengumuman')" />
                            <textarea id="isi" name="isi" rows="5" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>{{ old('isi', $pengumuman->isi) }}</textarea>
                            <x-input-error :messages="$errors->get('isi')" class="mt-2" />
                        </div>

                        <!-- Target Audiens -->
                        <div class="mt-4">
                            <x-input-label for="target_role" :value="__('Target Audiens')" />
                            <select id="target_role" name="target_role" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="semua" {{ old('target_role', $pengumuman->target_role) == 'semua' ? 'selected' : '' }}>Semua (Dosen & Mahasiswa)</option>
                                <option value="dosen" {{ old('target_role', $pengumuman->target_role) == 'dosen' ? 'selected' : '' }}>Dosen</option>
                                <option value="mahasiswa" {{ old('target_role', $pengumuman->target_role) == 'mahasiswa' ? 'selected' : '' }}>Mahasiswa</option>
                            </select>
                            <x-input-error :messages="$errors->get('target_role')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <a href="{{ route('pengumuman.index') }}" class="text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Batal
                            </a>
                            <x-primary-button class="ms-4">
                                {{ __('Perbarui Pengumuman') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

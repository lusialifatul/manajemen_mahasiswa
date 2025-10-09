<x-app-layout>
    <x-slot name="header">
        Tambah User Baru
    </x-slot>

    <div class="bg-white p-8 rounded-lg shadow-md max-w-2xl mx-auto">

        <form method="POST" action="{{ route('users.store') }}" class="space-y-6">
            @csrf

            <!-- Name -->
            <div>
                <label for="name" class="text-sm font-medium text-gray-700">Nama Lengkap</label>
                <input id="name" type="text" name="name" :value="old('name')" required autofocus autocomplete="name"
                       class="block w-full px-4 py-3 mt-1 text-gray-800 bg-gray-50 border border-gray-300 rounded-lg focus:ring-[#40916C] focus:border-[#40916C]" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- Email Address -->
            <div>
                <label for="email" class="text-sm font-medium text-gray-700">Email</label>
                <input id="email" type="email" name="email" :value="old('email')" required autocomplete="username"
                       class="block w-full px-4 py-3 mt-1 text-gray-800 bg-gray-50 border border-gray-300 rounded-lg focus:ring-[#40916C] focus:border-[#40916C]" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Role -->
            <div>
                <label for="role" class="text-sm font-medium text-gray-700">Peran (Role)</label>
                <select id="role" name="role" class="block w-full px-4 py-3 mt-1 text-gray-800 bg-gray-50 border border-gray-300 rounded-lg focus:ring-[#40916C] focus:border-[#40916C]">
                    <option value="mahasiswa">Mahasiswa</option>
                    <option value="dosen">Dosen</option>
                    <option value="admin">Admin</option>
                </select>
                <x-input-error :messages="$errors->get('role')" class="mt-2" />
            </div>

            <!-- Password -->
            <div>
                <label for="password" class="text-sm font-medium text-gray-700">Password</label>
                <input id="password" type="password" name="password" required autocomplete="new-password"
                       class="block w-full px-4 py-3 mt-1 text-gray-800 bg-gray-50 border border-gray-300 rounded-lg focus:ring-[#40916C] focus:border-[#40916C]" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Confirm Password -->
            <div>
                <label for="password_confirmation" class="text-sm font-medium text-gray-700">Konfirmasi Password</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                       class="block w-full px-4 py-3 mt-1 text-gray-800 bg-gray-50 border border-gray-300 rounded-lg focus:ring-[#40916C] focus:border-[#40916C]" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ route('users.index') }}" class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-200 rounded-lg hover:bg-gray-300">Batal</a>
                <button type="submit" class="px-4 py-2 text-sm font-medium text-white bg-[#081C15] rounded-lg hover:bg-[#40916C]">
                    Simpan User
                </button>
            </div>
        </form>
    </div>
</x-app-layout>

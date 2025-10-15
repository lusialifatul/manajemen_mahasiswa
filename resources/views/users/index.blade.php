<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Manajemen User
        </h2>
    </x-slot>

    <div class="bg-white p-8 rounded-lg shadow-md max-w-6xl mx-auto">

        <div class="flex justify-end mb-6">
            <a href="{{ route('users.create') }}"
               class="px-5 py-2 text-sm font-semibold text-white bg-[#40916C] rounded-lg hover:bg-[#2D6A4F] transition-colors duration-200">
                + Tambah User
            </a>
        </div>

        {{-- Notifikasi Sukses atau Error --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-lg shadow-md overflow-hidden">
                <thead class="bg-[#40916C] text-white">
                    <tr>
                        <th class="py-3 px-6 uppercase font-semibold text-sm text-left">Nama</th>
                        <th class="py-3 px-6 uppercase font-semibold text-sm text-left">Email</th>
                        <th class="py-3 px-6 uppercase font-semibold text-sm text-left">Peran (Role)</th>
                        <th class="py-3 px-6 uppercase font-semibold text-sm text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach ($users as $user)
                        <tr class="border-b hover:bg-[#d8f3dc] transition-colors duration-150">
                            <td class="py-3 px-6">{{ $user->name }}</td>
                            <td class="py-3 px-6">{{ $user->email }}</td>
                            <td class="py-3 px-6">
                                <form action="{{ route('users.updateRole', $user) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="role" onchange="this.form.submit()" class="rounded-md border border-[#40916C] shadow-sm focus:border-[#40916C] focus:ring focus:ring-[#40916C]/50 focus:ring-opacity-50 text-sm px-2 py-1">
                                        <option value="admin" @selected($user->role == 'admin')>Admin</option>
                                        <option value="dosen" @selected($user->role == 'dosen')>Dosen</option>
                                        <option value="mahasiswa" @selected($user->role == 'mahasiswa')>Mahasiswa</option>
                                    </select>
                                </form>
                            </td>
                            <td class="py-3 px-6">
                                <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                        class="text-[#40916C] hover:text-[#2D6A4F] focus:outline-none" 
                                        title="Hapus User">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2" >
                                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                                        </svg>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    @if($users->isEmpty())
                        <tr>
                            <td colspan="4" class="py-4 px-6 text-center text-gray-500">Tidak ada user untuk ditampilkan.</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        Manajemen User
    </x-slot>

    <div class="bg-white p-8 rounded-lg shadow-md">

        <div class="flex justify-end mb-4">
            <a href="{{ route('users.create') }}" class="px-4 py-2 text-sm font-medium text-white bg-[#081C15] rounded-lg hover:bg-[#40916C]">
                + Tambah User
            </a>
        </div>

        {{-- Notifikasi Sukses atau Error --}}
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead class="bg-[#081C15] text-white">
                    <tr>
                        <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Nama</th>
                        <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Email</th>
                        <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Peran (Role)</th>
                        <th class="py-3 px-4 uppercase font-semibold text-sm text-left">Aksi</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach ($users as $user)
                        <tr class="border-b">
                            <td class="py-3 px-4">{{ $user->name }}</td>
                            <td class="py-3 px-4">{{ $user->email }}</td>
                            <td class="py-3 px-4">
                                {{-- Form untuk ganti peran --}}
                                <form action="{{ route('users.updateRole', $user) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="role" onchange="this.form.submit()" class="rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 text-sm">
                                        <option value="admin" @selected($user->role == 'admin')>Admin</option>
                                        <option value="dosen" @selected($user->role == 'dosen')>Dosen</option>
                                        <option value="mahasiswa" @selected($user->role == 'mahasiswa')>Mahasiswa</option>
                                    </select>
                                </form>
                            </td>
                            <td class="py-3 px-4 flex items-center space-x-2">
                                {{-- Form untuk hapus user --}}
                                <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus user ini?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-700">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>

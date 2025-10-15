<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Manajemen Pengumuman
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-md" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="flex justify-end mb-6">
                        <a href="{{ route('pengumuman.create') }}"
                            class="inline-flex items-center px-4 py-2 bg-[#40916C] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#2D6A4F] focus:outline-none focus:ring-2 focus:ring-[#40916C] focus:ring-offset-2 transition ease-in-out duration-150">
                            Buat Pengumuman Baru
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 rounded-lg shadow-md overflow-hidden">
                            <thead class="bg-[#40916C] text-white">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Judul</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Target</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Dibuat Oleh</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Tanggal Dibuat</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($pengumumans as $pengumuman)
                                    <tr class="hover:bg-[#d8f3dc] transition-colors duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $pengumuman->judul }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ ucfirst($pengumuman->target_role) }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $pengumuman->creator->name ?? 'N/A' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $pengumuman->created_at->format('d M Y H:i') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                            <a href="{{ route('pengumuman.edit', $pengumuman->id) }}"
                                               class="text-[#40916C] hover:text-[#2D6A4F] p-2 rounded-md hover:bg-[#d8f3dc]"
                                               title="Edit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <form action="{{ route('pengumuman.destroy', $pengumuman->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                        class="text-red-600 hover:text-red-900 p-2 rounded-md hover:bg-red-100"
                                                        onclick="return confirm('Apakah Anda yakin ingin menghapus pengumuman ini?')"
                                                        title="Hapus">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                            Tidak ada pengumuman yang tersedia.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $pengumumans->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

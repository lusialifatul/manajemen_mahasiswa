<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Daftar Notifikasi Anda
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
                        <form method="POST" action="{{ route('notifications.markAllAsRead') }}">
                            @csrf
                            <button type="submit"
                                    class="inline-flex items-center px-4 py-2 bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest hover:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition ease-in-out duration-150">
                                Tandai Semua Sudah Dibaca
                            </button>
                        </form>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 rounded-lg shadow-md overflow-hidden">
                            <thead class="bg-[#40916C] text-white">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Judul Pengumuman</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Dibuat Oleh</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Tanggal Dibuat</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($notifications as $notification)
                                    <tr class="hover:bg-[#d8f3dc] transition-colors duration-150 {{ $notification->pivot->read_at ? 'text-gray-500' : 'font-semibold' }}">
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $notification->judul }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $notification->creator->name ?? 'N/A' }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $notification->created_at->format('d M Y H:i') }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            @if ($notification->pivot->read_at)
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">Sudah Dibaca</span>
                                            @else
                                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-yellow-100 text-yellow-800">Belum Dibaca</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                            @if (!$notification->pivot->read_at)
                                                <form action="{{ route('notifications.markAsRead', $notification->id) }}" method="POST" class="inline-block">
                                                    @csrf
                                                    <button type="submit"
                                                            class="text-[#40916C] hover:text-[#2D6A4F] p-2 rounded-md hover:bg-[#d8f3dc]"
                                                            title="Tandai Sudah Dibaca">
                                                        <i class="fas fa-check-circle"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                            Tidak ada notifikasi.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $notifications->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

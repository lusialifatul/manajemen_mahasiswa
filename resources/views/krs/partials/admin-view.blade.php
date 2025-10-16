<div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <h3 class="text-lg font-semibold text-[#40916C] mb-4">Daftar Semua KRS Mahasiswa</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-[#40916C] text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Nama Mahasiswa</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">NIM</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Periode</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Total SKS</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($allKrs as $krs)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $krs->mahasiswa->user->name ?? 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $krs->mahasiswa->nim ?? 'N/A' }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $krs->semester }} {{ $krs->tahun_akademik }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $krs->total_sks }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($krs->status == 'approved') bg-green-100 text-green-800 
                                    @elseif($krs->status == 'submitted') bg-blue-100 text-blue-800
                                    @elseif($krs->status == 'rejected') bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst($krs->status) }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('krs.review.show', $krs->id) }}" class="text-[#40916C] hover:text-[#2D6A4F] font-semibold">Lihat Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                Belum ada data KRS yang tersedia.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            {{ $allKrs->links() }}
        </div>
    </div>
</div>

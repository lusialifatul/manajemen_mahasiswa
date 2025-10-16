<div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
    <div class="p-6 text-gray-900">
        <h3 class="text-lg font-semibold text-[#40916C] mb-4">Daftar Mata Kuliah yang Disetujui</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200 rounded-lg overflow-hidden">
                <thead class="bg-[#40916C] text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Mata Kuliah</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Semester</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">SKS</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Jadwal</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Dosen</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($existingKrs->jadwals as $jadwal)
                        @if($jadwal->mataKuliah && $jadwal->dosen)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $jadwal->mataKuliah->kode_mk }} - {{ $jadwal->mataKuliah->nama_mk }}</td>
                                <td class="px-6 py-4">{{ $jadwal->mataKuliah->semester }}</td>
                                <td class="px-6 py-4">{{ $jadwal->mataKuliah->sks }}</td>
                                <td class="px-6 py-4">{{ $jadwal->hari }}, {{ date('H:i', strtotime($jadwal->waktu_mulai)) }} - {{ date('H:i', strtotime($jadwal->waktu_selesai)) }}</td>
                                <td class="px-6 py-4">{{ $jadwal->dosen->name }}</td>
                            </tr>
                        @endif
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4">Tidak ada mata kuliah yang ditemukan dalam KRS ini.</td>
                        </tr>
                    @endforelse
                </tbody>
                <tfoot class="bg-gray-50">
                    <tr>
                        <td colspan="2" class="px-6 py-3 text-right font-semibold">Total SKS Disetujui:</td>
                        <td colspan="3" class="px-6 py-3 font-bold text-[#40916C]">{{ $existingKrs->total_sks }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>

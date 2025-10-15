<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Pengajuan KRS
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Informasi Mahasiswa -->
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Informasi Mahasiswa</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p><strong>Nama:</strong> {{ $krs->mahasiswa->user->name ?? 'N/A' }}</p>
                            <p><strong>NIM:</strong> {{ $krs->mahasiswa->nim ?? 'N/A' }}</p>
                            <p><strong>IPK:</strong> <span class="font-semibold">{{ number_format($krs->mahasiswa->ipk ?? 0, 2) }}</span></p>
                        </div>
                        <div>
                            <p><strong>Tahun Akademik:</strong> {{ $krs->tahun_akademik }}</p>
                            <p><strong>Semester:</strong> {{ $krs->semester }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Daftar Mata Kuliah -->
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Mata Kuliah Diajukan (Total: {{ $krs->total_sks }} SKS)</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 rounded-lg shadow-md overflow-hidden">
                            <thead class="bg-[#40916C] text-white">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Kode MK</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Nama Mata Kuliah</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">SKS</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Jadwal</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Dosen Pengampu</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach ($krs->jadwals as $jadwal)
                                    <tr class="hover:bg-[#d8f3dc] transition-colors duration-150">
                                        <td class="px-6 py-4">{{ $jadwal->mataKuliah->kode_mk }}</td>
                                        <td class="px-6 py-4">{{ $jadwal->mataKuliah->nama_mk }}</td>
                                        <td class="px-6 py-4">{{ $jadwal->mataKuliah->sks }}</td>
                                        <td class="px-6 py-4">{{ $jadwal->hari }}, {{ date('H:i', strtotime($jadwal->waktu_mulai)) }} - {{ date('H:i', strtotime($jadwal->waktu_selesai)) }}</td>
                                        <td class="px-6 py-4">{{ $jadwal->dosen->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Aksi Persetujuan / Penolakan -->
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold mb-4">Tindakan</h3>

                    {{-- Form Penolakan --}}
                    <form action="{{ route('krs.review.reject', $krs) }}" method="POST">
                        @csrf
                        <div>
                            <x-input-label for="catatan_revisi" value="Catatan Revisi (Wajib jika menolak)" />
                            <textarea id="catatan_revisi" name="catatan_revisi" rows="3" 
                                class="mt-1 block w-full border border-gray-300 focus:border-[#40916C] focus:ring focus:ring-[#40916C]/50 rounded-md shadow-sm"
                                placeholder="Masukkan alasan penolakan">{{ old('catatan_revisi') }}</textarea>
                            <x-input-error :messages="$errors->get('catatan_revisi')" class="mt-2" />
                        </div>

                        <div class="mt-4">
                            <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition ease-in-out duration-150">
                                Tolak KRS
                            </button>
                        </div>
                    </form>

                    {{-- Form Persetujuan --}}
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <form action="{{ route('krs.review.approve', $krs) }}" method="POST">
                            @csrf
                            <button type="submit"
                                onclick="return confirm('Apakah Anda yakin ingin menyetujui KRS ini?')"
                                class="inline-flex items-center px-4 py-2 bg-[#40916C] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#2D6A4F] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#40916C] transition ease-in-out duration-150">
                                Setujui KRS
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
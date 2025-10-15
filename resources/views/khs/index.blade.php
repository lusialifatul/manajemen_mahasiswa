<x-app-layout>
    <x-slot name="header">
        Kartu Hasil Studi (KHS)
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <!-- Student Info -->
                    <div class="mb-6 p-4 border border-gray-200 rounded-lg bg-gray-50">
                        <h3 class="text-lg font-semibold text-gray-800 mb-2">Data Mahasiswa</h3>
                        <div class="grid grid-cols-2 gap-x-4 gap-y-2 text-sm">
                            <div class="font-semibold">Nama</div>
                            <div>: {{ Auth::user()->name }}</div>
                            <div class="font-semibold">NIM</div>
                            <div>: {{ $mahasiswa->nim ?? 'N/A' }}</div>
                            <div class="font-semibold">Semester Aktif</div>
                            <div>: {{ $mahasiswa->semester_aktif ?? 'N/A' }}</div>
                            <div class="font-semibold">Dosen Pembimbing</div>
                            <div>: {{ $mahasiswa->dosenPembimbing->name ?? 'N/A' }}</div>
                        </div>
                    </div>

                    <!-- Semester Selection Form -->
                    <div class="mb-6 flex justify-between items-end">
                        <form action="{{ route('khs.index') }}" method="GET" class="flex items-end gap-4">
                            <div>
                                <label for="krs_id" class="block text-sm font-medium text-gray-700">Pilih Semester:</label>
                                <select id="krs_id" name="krs_id" class="mt-1 block w-full md:w-80 pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-[#40916C] focus:border-[#40916C] sm:text-sm rounded-md" onchange="this.form.submit()">
                                    @forelse($krsHistory as $krs)
                                        <option value="{{ $krs->id }}" {{ $selectedKrs && $selectedKrs->id == $krs->id ? 'selected' : '' }}>
                                            Semester {{ $krs->semester }} - {{ $krs->tahun_akademik }}
                                        </option>
                                    @empty
                                        <option>Belum ada data KRS</option>
                                    @endforelse
                                </select>
                            </div>
                        </form>
                        <button onclick="window.print();" class="inline-flex items-center px-4 py-2 bg-gray-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-gray-500 disabled:opacity-25 transition ease-in-out duration-150">
                            <i class="fas fa-print mr-2"></i> Cetak KHS
                        </button>
                    </div>

                    @if($selectedKrs)
                        <!-- Grades Table -->
                        <div class="overflow-x-auto rounded-lg shadow">
                            <table class="min-w-full divide-y divide-gray-300 font-sans text-sm">
                                <thead class="bg-[#40916C]">
                                    <tr>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-semibold text-white uppercase tracking-wider">No</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Kode MK</th>
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold text-white uppercase tracking-wider">Nama Mata Kuliah</th>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-semibold text-white uppercase tracking-wider">SKS</th>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-semibold text-white uppercase tracking-wider">Nilai</th>
                                        <th scope="col" class="px-6 py-3 text-center text-xs font-semibold text-white uppercase tracking-wider">Bobot</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($khsDetails as $index => $detail)
                                        <tr class="{{ $index % 2 == 0 ? 'bg-gray-50' : 'bg-white' }}">
                                            <td class="px-6 py-4 text-center">{{ $index + 1 }}</td>
                                            <td class="px-6 py-4">{{ $detail->kode_mk }}</td>
                                            <td class="px-6 py-4">{{ $detail->nama_mk }}</td>
                                            <td class="px-6 py-4 text-center">{{ $detail->sks }}</td>
                                            <td class="px-6 py-4 text-center font-semibold">{{ $detail->nilai ?? '-' }}</td>
                                            <td class="px-6 py-4 text-center">{{ number_format($detail->bobot, 2) }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="px-6 py-4 text-center text-gray-500">Tidak ada data nilai untuk semester ini.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- GPA Summary -->
                        <div class="mt-6 grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="bg-green-50 border border-green-200 rounded-lg p-4">
                                <h4 class="text-md font-semibold text-gray-800">Ringkasan Semester</h4>
                                <div class="mt-2 grid grid-cols-2 gap-x-4 text-sm">
                                    <div class="font-semibold">Total SKS Semester</div>
                                    <div class="text-right">{{ $totalSksSemester }}</div>
                                    <div class="font-semibold">IP Semester (IPS)</div>
                                    <div class="text-right font-bold text-lg text-green-700">{{ number_format($ipSemester, 2) }}</div>
                                </div>
                            </div>
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                <h4 class="text-md font-semibold text-gray-800">Ringkasan Kumulatif</h4>
                                <div class="mt-2 grid grid-cols-2 gap-x-4 text-sm">
                                    <div class="font-semibold">Total SKS Kumulatif</div>
                                    <div class="text-right">{{ $totalSksKumulatif }}</div>
                                    <div class="font-semibold">IP Kumulatif (IPK)</div>
                                    <div class="text-right font-bold text-lg text-blue-700">{{ number_format($ipk, 2) }}</div>
                                </div>
                            </div>
                        </div>

                    @else
                        <div class="text-center py-8">
                            <p class="text-gray-500">Anda belum memiliki data Kartu Hasil Studi.</p>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>

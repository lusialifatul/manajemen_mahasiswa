<form id="krs-form" method="POST" action="{{ route('krs.store') }}">
    @csrf
    <input type="hidden" name="jadwal_ids" id="jadwal_ids_input">

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Daftar Mata Kuliah Tersedia -->
        <div class="lg:col-span-2">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold text-[#40916C] mb-4">Daftar Mata Kuliah Tersedia</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 rounded-lg overflow-hidden">
                            <thead class="bg-[#40916C] text-white">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Pilih</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Mata Kuliah</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Semester</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">SKS</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Jadwal</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Dosen</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($jadwals as $jadwal)
                                    @if($jadwal->mataKuliah && $jadwal->dosen)
                                        <tr class="hover:bg-[#d8f3dc] transition-colors duration-150" id="row-{{ $jadwal->id }}">
                                            <td class="px-6 py-4">
                                                <input type="checkbox" class="form-checkbox h-5 w-5 text-[#40916C]"
                                                       data-id="{{ $jadwal->id }}"
                                                       data-sks="{{ $jadwal->mataKuliah->sks }}"
                                                       data-title="{{ $jadwal->mataKuliah->nama_mk }}"
                                                       onchange="toggleCourse(this)">
                                            </td>
                                            <td class="px-6 py-4">{{ $jadwal->mataKuliah->kode_mk }} - {{ $jadwal->mataKuliah->nama_mk }}</td>
                                            <td class="px-6 py-4">{{ $jadwal->mataKuliah->semester }}</td>
                                            <td class="px-6 py-4">{{ $jadwal->mataKuliah->sks }}</td>
                                            <td class="px-6 py-4">{{ $jadwal->hari }}, {{ date('H:i', strtotime($jadwal->waktu_mulai)) }} - {{ date('H:i', strtotime($jadwal->waktu_selesai)) }}</td>
                                            <td class="px-6 py-4">{{ $jadwal->dosen->name }}</td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Keranjang KRS -->
        <div class="lg:col-span-1">
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold text-[#40916C] mb-4">KRS Dipilih</h3>
                    <div id="krs-cart">
                        <p class="text-gray-500">Belum ada mata kuliah yang dipilih.</p>
                    </div>

                    <div class="mt-4 pt-4 border-t">
                        <h4 class="font-semibold text-sm text-gray-700">Total SKS: <span id="total-sks" class="text-[#40916C] font-bold">0</span> / 24</h4>
                    </div>

                    <div class="mt-6">
                        <button type="submit" class="w-full inline-flex items-center justify-center px-4 py-2 bg-[#40916C] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#2D6A4F] focus:outline-none focus:ring-2 focus:ring-[#40916C] focus:ring-offset-2 transition ease-in-out duration-150">
                            Ajukan KRS
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

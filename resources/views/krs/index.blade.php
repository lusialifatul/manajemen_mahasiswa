<x-app-layout>
    <x-slot name="header">
        Kartu Rencana Studi (KRS)
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Student Info Header -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-medium">Informasi Mahasiswa</h3>
                    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p><strong>Nama:</strong> {{ Auth::user()->name }} ({{ Auth::user()->role }})</p>
                            @if(Auth::user()->mahasiswa)
                            <p><strong>NIM:</strong> {{ Auth::user()->mahasiswa->nim }}</p>
                            @endif
                        </div>
                        <div>
                            <p><strong>IPK:</strong> <span class="font-semibold text-green-600">3.80</span></p> <!-- Placeholder -->
                            <p><strong>Maksimal SKS:</strong> <span class="font-semibold text-blue-600">24</span></p> <!-- Placeholder -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Available Courses -->
                <div class="lg:col-span-2">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <h3 class="text-lg font-medium mb-4">Daftar Mata Kuliah Tersedia</h3>
                            <div class="overflow-x-auto">
                                <table class="min-w-full divide-y divide-gray-200" id="jadwal-table">
                                    <thead class="bg-gray-50">
                                        <tr>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pilih</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Kuliah</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">SKS</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jadwal</th>
                                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dosen</th>
                                        </tr>
                                    </thead>
                                    <tbody class="bg-white divide-y divide-gray-200">
                                        @foreach($jadwals as $jadwal)
                                            @if($jadwal->mataKuliah && $jadwal->dosen) {{-- Defensive check --}}
                                            <tr id="row-{{ $jadwal->id }}">
                                                <td class="px-6 py-4 whitespace-nowrap">
                                                    <input type="checkbox" class="form-checkbox h-5 w-5 text-indigo-600" 
                                                           data-id="{{ $jadwal->id }}" 
                                                           data-sks="{{ $jadwal->mataKuliah->sks }}"
                                                           data-title="{{ $jadwal->mataKuliah->nama_mk }}"
                                                           onchange="toggleCourse(this)">
                                                </td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->mataKuliah->kode_mk }} - {{ $jadwal->mataKuliah->nama_mk }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->mataKuliah->sks }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->hari }}, {{ date('H:i', strtotime($jadwal->waktu_mulai)) }} - {{ date('H:i', strtotime($jadwal->waktu_selesai)) }}</td>
                                                <td class="px-6 py-4 whitespace-nowrap">{{ $jadwal->dosen->name }}</td>
                                            </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Selected Courses (KRS Cart) -->
                <div class="lg:col-span-1">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <div class="p-6 text-gray-900">
                            <h3 class="text-lg font-medium mb-4">KRS Dipilih</h3>
                            <div id="krs-cart">
                                <p class="text-gray-500">Belum ada mata kuliah yang dipilih.</p>
                            </div>
                            <div class="mt-4 pt-4 border-t">
                                <h4 class="font-semibold">Total SKS: <span id="total-sks">0</span> / 24</h4>
                            </div>
                            <div class="mt-6">
                                <button class="w-full inline-flex items-center justify-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">Ajukan KRS</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@push('scripts')
<script>
    let selectedCourses = [];
    let totalSks = 0;
    const maxSks = 24; // Placeholder

    function toggleCourse(checkbox) {
        const id = checkbox.dataset.id;
        const sks = parseInt(checkbox.dataset.sks);
        const title = checkbox.dataset.title;

        if (checkbox.checked) {
            if (totalSks + sks > maxSks) {
                alert('Total SKS tidak boleh melebihi batas maksimal (' + maxSks + ' SKS).');
                checkbox.checked = false;
                return;
            }
            selectedCourses.push({ id, title, sks });
            totalSks += sks;
        } else {
            selectedCourses = selectedCourses.filter(course => course.id !== id);
            totalSks -= sks;
        }

        updateKrsCart();
    }

    function updateKrsCart() {
        const cartDiv = document.getElementById('krs-cart');
        const totalSksSpan = document.getElementById('total-sks');

        if (selectedCourses.length === 0) {
            cartDiv.innerHTML = '<p class="text-gray-500">Belum ada mata kuliah yang dipilih.</p>';
        } else {
            let cartHtml = '<ul class="divide-y divide-gray-200">';
            selectedCourses.forEach(course => {
                cartHtml += `<li class="py-2 flex justify-between items-center">
                                <span>${course.title} (${course.sks} SKS)</span>
                                <button class="text-red-500 hover:text-red-700" onclick="removeCourse('${course.id}')">X</button>
                             </li>`;
            });
            cartHtml += '</ul>';
            cartDiv.innerHTML = cartHtml;
        }

        totalSksSpan.textContent = totalSks;
    }

    function removeCourse(id) {
        const checkbox = document.querySelector(`input[data-id="${id}"]`);
        if (checkbox) {
            checkbox.checked = false;
            toggleCourse(checkbox);
        }
    }
</script>
@endpush

</x-app-layout>

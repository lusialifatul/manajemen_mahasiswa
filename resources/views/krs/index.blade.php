<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kartu Rencana Studi (KRS)
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Session Messages -->
            @if (session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6" role="alert">
                    <p>{{ session('success') }}</p>
                </div>
            @endif
            @if (session('error'))
                <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            @if($existingKrs && ($existingKrs->status == 'submitted' || $existingKrs->status == 'approved'))
                <div class="bg-white overflow-hidden shadow-md sm:rounded-lg mb-6">
                    <div class="p-6 text-gray-900">
                        <h3 class="text-lg font-semibold text-[#40916C]">Status KRS Anda</h3>
                        @if($existingKrs->status == 'submitted')
                            <div class="mt-4 bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4">
                                <p class="font-bold">Menunggu Persetujuan</p>
                                <p>KRS Anda telah diajukan pada {{ $existingKrs->created_at->format('d F Y') }} dan sedang menunggu persetujuan dari dosen pembimbing.</p>
                            </div>
                        @elseif($existingKrs->status == 'approved')
                            <div class="mt-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4">
                                <p class="font-bold">Disetujui</p>
                                <p>KRS Anda telah disetujui oleh dosen pembimbing pada {{ $existingKrs->updated_at->format('d F Y, H:i') }}.</p>
                            </div>
                        @endif
                    </div>
                </div>
            @else
                <!-- Form Pengisian KRS (ditampilkan jika belum ada KRS atau ditolak) -->
                <form id="krs-form" method="POST" action="{{ route('krs.store') }}">
                    @csrf
                    <input type="hidden" name="jadwal_ids" id="jadwal_ids_input">

                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <!-- Konten form disini -->
                    </div>
                </form>
            @endif

            <!-- Informasi Mahasiswa -->
            <div class="bg-white overflow-hidden shadow-md sm:rounded-lg mb-6">
                <div class="p-6 text-gray-900">
                    <h3 class="text-lg font-semibold text-[#40916C]">Informasi Mahasiswa</h3>
                    <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <p><strong>Nama:</strong> {{ Auth::user()->name }} ({{ Auth::user()->role }})</p>
                            @if(Auth::user()->mahasiswa)
                            <p><strong>NIM:</strong> {{ Auth::user()->mahasiswa->nim }}</p>
                            <p><strong>Dosen Pembimbing:</strong> 
                                @if($mahasiswa && $mahasiswa->dosenPembimbing)
                                    <span class="font-semibold">{{ $mahasiswa->dosenPembimbing->name }}</span>
                                @else
                                    <span class="text-red-500">Belum diatur</span>
                                @endif
                            </p>
                            @endif
                        </div>
                        <div>
                            @if($mahasiswa)
                            <p><strong>Semester:</strong> {{ $mahasiswa->semester_aktif ?? '-' }}</p>
                            <p><strong>IPK:</strong> <span class="font-semibold text-green-600">{{ number_format($mahasiswa->ipk ?? 0, 2) }}</span></p>
                            <p><strong>Maksimal SKS:</strong> <span class="font-semibold text-[#40916C]">24</span></p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

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
                                                                                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">SKS</th>                                                <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Jadwal</th>
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
                                                                                                            <td class="px-6 py-4">{{ $jadwal->mataKuliah->sks }}</td>                                                        <td class="px-6 py-4">{{ $jadwal->hari }}, {{ date('H:i', strtotime($jadwal->waktu_mulai)) }} - {{ date('H:i', strtotime($jadwal->waktu_selesai)) }}</td>
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
        </div>
    </div>

@push('scripts')
<script>
    let selectedCourses = [];
    let totalSks = 0;
    const maxSks = 24;

    document.getElementById('krs-form').addEventListener('submit', function(e) {
        const ids = selectedCourses.map(course => course.id);
        document.getElementById('jadwal_ids_input').value = JSON.stringify(ids);
    });

    function toggleCourse(checkbox) {
        const id = checkbox.dataset.id;
        const sks = parseInt(checkbox.dataset.sks);
        const title = checkbox.dataset.title;

        if (checkbox.checked) {
            if (totalSks + sks > maxSks) {
                alert('Total SKS tidak boleh melebihi ' + maxSks + ' SKS.');
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
                                <span class="text-sm text-gray-800">${course.title} <span class="text-gray-500">(${course.sks} SKS)</span></span>
                                <button class="text-red-500 hover:text-red-700 text-sm" onclick="removeCourse('${course.id}')">X</button>
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

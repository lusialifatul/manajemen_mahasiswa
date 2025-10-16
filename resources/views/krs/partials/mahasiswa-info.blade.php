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
            <div >
                @if($mahasiswa)
                <p><strong>Semester:</strong> {{ $mahasiswa->semester_aktif ?? '-' }}</p>
                <p><strong>IPK:</strong> <span class="font-semibold text-green-600">{{ number_format($mahasiswa->ipk ?? 0, 2) }}</span></p>
                <p><strong>Maksimal SKS:</strong> <span class="font-semibold text-[#40916C]">24</span></p> {{-- TODO: Make this dynamic --}}
                @endif
            </div>
        </div>
    </div>
</div>

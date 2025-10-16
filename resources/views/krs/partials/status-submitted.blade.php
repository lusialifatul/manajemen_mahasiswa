<div class="bg-white overflow-hidden shadow-md sm:rounded-lg mb-6">
    <div class="p-6 text-gray-900">
        <h3 class="text-lg font-semibold text-[#40916C]">Status KRS Anda</h3>
        <div class="mt-4 bg-blue-100 border-l-4 border-blue-500 text-blue-700 p-4">
            <p class="font-bold">Menunggu Persetujuan</p>
            <p>KRS Anda telah diajukan pada {{ $existingKrs->created_at->format('d F Y') }} dan sedang menunggu persetujuan dari dosen pembimbing.</p>
        </div>
    </div>
</div>

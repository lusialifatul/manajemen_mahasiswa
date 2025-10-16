<div class="bg-white overflow-hidden shadow-md sm:rounded-lg mb-6">
    <div class="p-6 text-gray-900">
        <h3 class="text-lg font-semibold text-[#40916C]">Status KRS Anda</h3>
        <div class="mt-4 bg-green-100 border-l-4 border-green-500 text-green-700 p-4">
            <p class="font-bold">Disetujui</p>
            <p>KRS Anda telah disetujui oleh dosen pembimbing pada {{ $existingKrs->updated_at->format('d F Y, H:i') }}.</p>
        </div>
    </div>
</div>

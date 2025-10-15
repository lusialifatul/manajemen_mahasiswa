<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pilih Laporan Anda
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if (session('error'))
                <div class="mb-4 p-4 bg-red-100 border border-red-400 text-red-700 rounded-md" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <form id="reportForm" method="GET" action="">
                        <div class="mb-4">
                            <x-input-label for="report_type" :value="__('Jenis Laporan')" />
                            <select id="report_type" name="report_type" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">-- Pilih Jenis Laporan --</option>
                                <option value="krs">KRS (Kartu Rencana Studi)</option>
                                <option value="khs">KHS (Kartu Hasil Studi)</option>
                                <option value="transkrip">Transkrip Nilai</option>
                            </select>
                            <x-input-error :messages="$errors->get('report_type')" class="mt-2" />
                        </div>

                        <div id="semester_selection" class="mb-4 hidden">
                            <x-input-label for="krs_id" :value="__('Pilih Semester (untuk KRS/KHS)')" />
                            <select id="krs_id" name="krs_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">-- Pilih Riwayat Semester --</option>
                                @forelse ($krsHistory as $krs)
                                    <option value="{{ $krs->id }}">
                                        Semester {{ $krs->semester }} - {{ $krs->tahun_akademik }}
                                    </option>
                                @empty
                                    <option value="" disabled>Tidak ada riwayat KHS yang disetujui</option>
                                @endforelse
                            </select>
                            <x-input-error :messages="$errors->get('krs_id')" class="mt-2" />
                        </div>

                        <div class="flex items-center justify-end mt-6">
                            <x-primary-button type="submit">
                                {{ __('Generate Laporan') }}
                            </x-primary-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const reportTypeSelect = document.getElementById('report_type');
            const semesterSelectionDiv = document.getElementById('semester_selection');
            const reportForm = document.getElementById('reportForm');

            function updateFormAction() {
                const reportType = reportTypeSelect.value;
                let actionUrl = '';

                if (reportType === 'krs') {
                    actionUrl = `{{ route('reports.krs') }}`;
                } else if (reportType === 'khs') {
                    actionUrl = `{{ route('reports.khs') }}`;
                } else if (reportType === 'transkrip') {
                    actionUrl = `{{ route('reports.transkrip') }}`;
                }
                reportForm.action = actionUrl;
            }

            reportTypeSelect.addEventListener('change', function () {
                if (this.value === 'krs' || this.value === 'khs') {
                    semesterSelectionDiv.classList.remove('hidden');
                    document.getElementById('krs_id').setAttribute('required', 'required');
                } else {
                    semesterSelectionDiv.classList.add('hidden');
                    document.getElementById('krs_id').removeAttribute('required');
                }
                updateFormAction();
            });

            // Initial call to set correct form action and semester visibility
            updateFormAction();
            reportTypeSelect.dispatchEvent(new Event('change'));
        });
    </script>
</x-app-layout>

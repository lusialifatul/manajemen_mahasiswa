<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Pilih Laporan Mahasiswa
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
                            <x-input-label for="mahasiswa_id" :value="__('Pilih Mahasiswa')" />
                            <select id="mahasiswa_id" name="mahasiswa_id" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm" required>
                                <option value="">-- Pilih Mahasiswa --</option>
                                @foreach ($mahasiswas as $mhs)
                                    <option value="{{ $mhs->id }}">{{ $mhs->nama_lengkap }} ({{ $mhs->nim }})</option>
                                @endforeach
                            </select>
                            <x-input-error :messages="$errors->get('mahasiswa_id')" class="mt-2" />
                        </div>

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
                            <x-input-label for="semester" :value="__('Pilih Semester (untuk KRS/KHS)')" />
                            <select id="semester" name="semester" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">-- Pilih Semester --</option>
                                @for ($i = 1; $i <= 14; $i++)
                                    <option value="{{ $i }}">Semester {{ $i }}</option>
                                @endfor
                            </select>
                            <x-input-error :messages="$errors->get('semester')" class="mt-2" />
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
            const mahasiswaSelect = document.getElementById('mahasiswa_id');

            function updateFormAction() {
                const mahasiswaId = mahasiswaSelect.value;
                const reportType = reportTypeSelect.value;
                let actionUrl = '';

                if (mahasiswaId && reportType) {
                    if (reportType === 'krs') {
                        actionUrl = `{{ url('reports/krs') }}/${mahasiswaId}`;
                    } else if (reportType === 'khs') {
                        actionUrl = `{{ url('reports/khs') }}/${mahasiswaId}`;
                    } else if (reportType === 'transkrip') {
                        actionUrl = `{{ url('reports/transkrip') }}/${mahasiswaId}`;
                    }
                }
                reportForm.action = actionUrl;
            }

            reportTypeSelect.addEventListener('change', function () {
                if (this.value === 'krs' || this.value === 'khs') {
                    semesterSelectionDiv.classList.remove('hidden');
                    document.getElementById('semester').setAttribute('required', 'required');
                } else {
                    semesterSelectionDiv.classList.add('hidden');
                    document.getElementById('semester').removeAttribute('required');
                }
                updateFormAction();
            });

            mahasiswaSelect.addEventListener('change', updateFormAction);

            // Initial call to set correct form action and semester visibility
            updateFormAction();
            reportTypeSelect.dispatchEvent(new Event('change'));
        });
    </script>
</x-app-layout>

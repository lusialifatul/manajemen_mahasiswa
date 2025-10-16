<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kartu Rencana Studi (KRS)
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <!-- Session Messages -->
            @include('partials.session-messages')

            {{-- Admin View --}}
            @if(Auth::user()->hasRole('admin'))
                @include('krs.partials.admin-view')

            {{-- Mahasiswa View --}}
            @else
                @include('krs.partials.mahasiswa-info')

                @if($existingKrs)
                    {{-- Status: Submitted --}}
                    @if($existingKrs->status == 'submitted')
                        @include('krs.partials.status-submitted')

                    {{-- Status: Approved --}}
                    @elseif($existingKrs->status == 'approved')
                        @include('krs.partials.status-approved')
                        @include('krs.partials.approved-krs-table')

                    {{-- Status: Rejected --}}
                    @elseif($existingKrs->status == 'rejected')
                        @include('krs.partials.status-rejected')
                        @include('krs.partials.krs-form')
                    @endif
                @else
                    {{-- No KRS exists, show form --}}
                    @include('krs.partials.krs-form')
                @endif
            @endif
        </div>
    </div>

    @push('scripts')
    <script>
        let selectedCourses = [];
        let totalSks = 0;
        const maxSks = 24; // TODO: Make this dynamic based on IPK

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('krs-form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    const ids = selectedCourses.map(course => course.id);
                    document.getElementById('jadwal_ids_input').value = JSON.stringify(ids);
                });
            }
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

            if (!cartDiv) return; // Exit if cart element doesn't exist

            if (selectedCourses.length === 0) {
                cartDiv.innerHTML = '<p class="text-gray-500">Belum ada mata kuliah yang dipilih.</p>';
            } else {
                let cartHtml = '<ul class="divide-y divide-gray-200">';
                selectedCourses.forEach(course => {
                    cartHtml += `<li class="py-2 flex justify-between items-center">
                                    <span class="text-sm text-gray-800">${course.title} <span class="text-gray-500">(${course.sks} SKS)</span></span>
                                    <button type="button" class="text-red-500 hover:text-red-700 text-sm" onclick="removeCourse('${course.id}')">X</button>
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

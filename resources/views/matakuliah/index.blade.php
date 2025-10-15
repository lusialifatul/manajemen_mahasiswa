<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Daftar Mata Kuliah
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    {{-- Session Message --}}
                    @if (session('success'))
                        <div class="mb-4 p-4 bg-green-100 border border-green-400 text-green-700 rounded-md" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="flex flex-col sm:flex-row justify-between items-center mb-6 space-y-4 sm:space-y-0 sm:space-x-4">
                        <form action="{{ route('matakuliah.index') }}" method="GET" class="flex flex-wrap items-center space-x-2">
                            <x-text-input type="text" name="search" placeholder="Cari Kode/Nama MK..." value="{{ request('search') }}" class="w-64" />

                            {{-- Filter Semester --}}
                            <select name="semester" class="block w-auto border border-[#40916C] rounded-md shadow-sm focus:border-[#40916C] focus:ring focus:ring-[#40916C]/50 focus:ring-opacity-50">
                                <option value="">Semua Semester</option>
                                @for ($i = 1; $i <= 8; $i++)
                                    <option value="{{ $i }}" @selected(request('semester') == $i)>Semester {{ $i }}</option>
                                @endfor
                            </select>

                            {{-- Filter Jenis --}}
                            <select name="jenis" class="block w-auto border border-[#40916C] rounded-md shadow-sm focus:border-[#40916C] focus:ring focus:ring-[#40916C]/50 focus:ring-opacity-50">
                                <option value="">Semua Jenis</option>
                                <option value="Wajib" @selected(request('jenis') == 'Wajib')>Wajib</option>
                                <option value="Pilihan" @selected(request('jenis') == 'Pilihan')>Pilihan</option>
                                <option value="Wajib Umum" @selected(request('jenis') == 'Wajib Umum')>Wajib Umum</option>
                            </select>

                            <button type="submit" class="inline-flex items-center px-4 py-2 bg-[#40916C] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#40916C] disabled:opacity-25 transition ease-in-out duration-150">
                                Filter
                            </button>

                            @if(request('search') || request('semester') || request('jenis'))
                                <a href="{{ route('matakuliah.index') }}" class="text-[#40916C] hover:text-[#2D6A4F] text-sm underline">
                                    Reset
                                </a>
                            @endif
                        </form>

                        <a href="{{ route('matakuliah.create') }}"
                           class="inline-flex items-center px-4 py-2 bg-[#40916C] border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-[#2D6A4F] focus:outline-none focus:ring-2 focus:ring-[#40916C] focus:ring-offset-2 transition ease-in-out duration-150">
                            Tambah Mata Kuliah
                        </a>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 rounded-lg shadow-md overflow-hidden">
                            <thead class="bg-[#40916C] text-white">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">No</th>
                                    @php
                                        $sortableColumns = [
                                            'kode_mk' => 'Kode MK',
                                            'nama_mk' => 'Nama Mata Kuliah',
                                            'sks' => 'SKS',
                                            'semester' => 'Semester',
                                        ];
                                    @endphp
                                    @foreach ($sortableColumns as $column => $label)
                                        <th scope="col" class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider cursor-pointer select-none">
                                            <a href="{{ route('matakuliah.index', array_merge(request()->query(), ['sort_by' => $column, 'sort_direction' => ($sortBy === $column && $sortDirection === 'asc') ? 'desc' : 'asc'])) }}" class="flex items-center space-x-1 hover:underline">
                                                <span>{{ $label }}</span>
                                                @if ($sortBy === $column)
                                                    <i class="fas fa-arrow-{{ $sortDirection === 'asc' ? 'up' : 'down' }} ml-1"></i>
                                                @endif
                                            </a>
                                        </th>
                                    @endforeach
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($matakuliahs as $matakuliah)
                                    <tr class="hover:bg-[#d8f3dc] transition-colors duration-150">
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration + $matakuliahs->firstItem() - 1 }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $matakuliah->kode_mk }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $matakuliah->nama_mk }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $matakuliah->sks }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $matakuliah->semester }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium space-x-2">
                                            <a href="{{ route('matakuliah.edit', $matakuliah->id) }}" 
                                               class="text-[#40916C] hover:text-[#2D6A4F] p-2 rounded-md hover:bg-[#d8f3dc]" 
                                               title="Edit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <form action="{{ route('matakuliah.destroy', $matakuliah->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" 
                                                        class="text-red-600 hover:text-red-900 p-2 rounded-md hover:bg-red-100" 
                                                        onclick="return confirm('Apakah Anda yakin?')" 
                                                        title="Hapus">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                                            Data mata kuliah tidak ditemukan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $matakuliahs->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
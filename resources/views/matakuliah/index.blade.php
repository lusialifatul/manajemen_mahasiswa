<x-app-layout>
    <x-slot name="header">
        Daftar Mata Kuliah
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

                    <div class="flex justify-between items-center mb-4">
                        <form action="{{ route('matakuliah.index') }}" method="GET" class="flex items-center space-x-2">
                            <x-text-input type="text" name="search" placeholder="Cari Kode/Nama MK..." value="{{ request('search') }}" class="w-64" />

                            {{-- Filter Semester --}}
                            <select name="semester" class="block w-auto border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">Semua Semester</option>
                                @for ($i = 1; $i <= 8; $i++)
                                    <option value="{{ $i }}" @selected(request('semester') == $i)>Semester {{ $i }}</option>
                                @endfor
                            </select>

                            {{-- Filter Jenis --}}
                            <select name="jenis" class="block w-auto border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                                <option value="">Semua Jenis</option>
                                <option value="Wajib" @selected(request('jenis') == 'Wajib')>Wajib</option>
                                <option value="Pilihan" @selected(request('jenis') == 'Pilihan')>Pilihan</option>
                                <option value="Wajib Umum" @selected(request('jenis') == 'Wajib Umum')>Wajib Umum</option>
                            </select>

                            <x-primary-button type="submit">Filter</x-primary-button>
                            @if(request('search') || request('semester') || request('jenis'))
                                <a href="{{ route('matakuliah.index') }}" class="text-sm text-gray-600 hover:text-gray-900">Reset</a>
                            @endif
                        </form>
                        <a href="{{ route('matakuliah.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Tambah Mata Kuliah
                        </a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                                                            <thead class="bg-gray-50">
                                                                <tr>
                                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                                                    @php
                                                                        $sortableColumns = [
                                                                            'kode_mk' => 'Kode MK',
                                                                            'nama_mk' => 'Nama Mata Kuliah',
                                                                            'sks' => 'SKS',
                                                                            'semester' => 'Semester',
                                                                        ];
                                                                    @endphp
                                                                    @foreach ($sortableColumns as $column => $label)
                                                                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider cursor-pointer">
                                                                            <a href="{{ route('matakuliah.index', array_merge(request()->query(), ['sort_by' => $column, 'sort_direction' => ($sortBy === $column && $sortDirection === 'asc') ? 'desc' : 'asc'])) }}" class="flex items-center">
                                                                                {{ $label }}
                                                                                @if ($sortBy === $column)
                                                                                    <i class="fas fa-{{ $sortDirection === 'asc' ? 'arrow-up' : 'arrow-down' }} ml-1"></i>
                                                                                @endif
                                                                            </a>
                                                                        </th>
                                                                    @endforeach
                                                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                                                </tr>
                                                            </thead>                            <tbody class="bg-white divide-y divide-gray-200">
                                @forelse ($matakuliahs as $matakuliah)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $loop->iteration + $matakuliahs->firstItem() - 1 }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $matakuliah->kode_mk }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $matakuliah->nama_mk }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $matakuliah->sks }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $matakuliah->semester }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                            <a href="{{ route('matakuliah.edit', $matakuliah->id) }}" class="text-indigo-600 hover:text-indigo-900 p-2 rounded-md hover:bg-gray-100" title="Edit">
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <form action="{{ route('matakuliah.destroy', $matakuliah->id) }}" method="POST" class="inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 p-2 rounded-md hover:bg-gray-100" onclick="return confirm('Apakah Anda yakin?')" title="Hapus">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="px-6 py-4 whitespace-nowrap text-center text-gray-500">
                                            Data mata kuliah tidak ditemukan.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    <div class="mt-4">
                        {{ $matakuliahs->appends(request()->query())->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

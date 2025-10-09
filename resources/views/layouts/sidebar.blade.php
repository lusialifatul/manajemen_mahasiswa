<!-- Alpine.js component -->
<aside x-data="{ isExpanded: false }" :class="isExpanded ? 'w-64' : 'w-20'" class="bg-[#081C15] flex flex-col items-center py-6 space-y-8 transition-all duration-300">
    
    <!-- Logo and Toggle Button -->
    <div class="w-full flex items-center" :class="isExpanded ? 'justify-between px-6' : 'justify-center'">
        <a href="{{ route('dashboard') }}" x-show="isExpanded">
            <h2 class="text-2xl font-bold tracking-wide text-[#B7E4C7]">E-Akademik</h2>
        </a>
        <a href="{{ route('dashboard') }}" x-show="!isExpanded">
            <div class="text-[#B7E4C7] text-3xl font-bold">E</div>
        </a>
        <button @click="isExpanded = !isExpanded" class="text-[#B7E4C7] hover:text-white">
            <i class="fas" :class="isExpanded ? 'fa-chevron-left' : 'fa-chevron-right'"></i>
        </button>
    </div>

    <!-- Menu -->
    <nav class="flex flex-col space-y-4 text-[#B7E4C7] w-full">
        @if (Auth::user()->role == 'admin')
            {{-- SIDEBAR ADMIN --}}
            <a href="#" title="Dashboard" class="flex items-center py-3 rounded-md hover:bg-[#40916C] hover:text-white transition-colors duration-300" :class="isExpanded ? 'px-6' : 'justify-center'">
                <i class="fas fa-home text-xl w-8 text-center"></i>
                <span x-show="isExpanded" class="ml-4 font-semibold">Dashboard</span>
            </a>
            <a href="{{ route('users.index') }}" title="Manajemen User" class="flex items-center py-3 rounded-md hover:bg-[#40916C] hover:text-white transition-colors duration-300" :class="isExpanded ? 'px-6' : 'justify-center'">
                <i class="fas fa-users-cog text-xl w-8 text-center"></i>
                <span x-show="isExpanded" class="ml-4 font-semibold">Manajemen User</span>
            </a>
            <a href="{{ route('matakuliah.index') }}" title="Mata Kuliah" class="flex items-center py-3 rounded-md hover:bg-[#40916C] hover:text-white transition-colors duration-300 {{ request()->routeIs('matakuliah.*') ? 'bg-[#40916C] text-white' : '' }}" :class="isExpanded ? 'px-6' : 'justify-center'">
                <i class="fas fa-book text-xl w-8 text-center"></i>
                <span x-show="isExpanded" class="ml-4 font-semibold">Mata Kuliah</span>
            </a>
            <a href="{{ route('krs.index') }}" title="KRS & Nilai" class="flex items-center py-3 rounded-md hover:bg-[#40916C] hover:text-white transition-colors duration-300 {{ request()->routeIs('krs.*') ? 'bg-[#40916C] text-white' : '' }}" :class="isExpanded ? 'px-6' : 'justify-center'">
                <i class="fas fa-graduation-cap text-xl w-8 text-center"></i>
                <span x-show="isExpanded" class="ml-4 font-semibold">Kartu Rencana Studi</span>
            </a>
            <a href="#" title="Laporan" class="flex items-center py-3 rounded-md hover:bg-[#40916C] hover:text-white transition-colors duration-300" :class="isExpanded ? 'px-6' : 'justify-center'">
                <i class="fas fa-print text-xl w-8 text-center"></i>
                <span x-show="isExpanded" class="ml-4 font-semibold">Laporan</span>
            </a>
            <a href="{{ route('jadwal.index') }}" title="Jadwal Kuliah" class="flex items-center py-3 rounded-md hover:bg-[#40916C] hover:text-white transition-colors duration-300" :class="isExpanded ? 'px-6' : 'justify-center'">
                <i class="fas fa-calendar-alt text-xl w-8 text-center"></i>
                <span x-show="isExpanded" class="ml-4 font-semibold">Jadwal Kuliah</span>
            </a>

        @elseif(Auth::user()->role == 'dosen')
            {{-- SIDEBAR DOSEN --}}
            <a href="#" title="Dashboard" class="flex items-center py-3 rounded-md hover:bg-[#40916C] hover:text-white transition-colors duration-300" :class="isExpanded ? 'px-6' : 'justify-center'">
                <i class="fas fa-home text-xl w-8 text-center"></i>
                <span x-show="isExpanded" class="ml-4 font-semibold">Dashboard</span>
            </a>
            <a href="#" title="Mata Kuliah Saya" class="flex items-center py-3 rounded-md hover:bg-[#40916C] hover:text-white transition-colors duration-300" :class="isExpanded ? 'px-6' : 'justify-center'">
                <i class="fas fa-chalkboard-teacher text-xl w-8 text-center"></i>
                <span x-show="isExpanded" class="ml-4 font-semibold">Mata Kuliah</span>
            </a>
            <a href="#" title="Input Nilai" class="flex items-center py-3 rounded-md hover:bg-[#40916C] hover:text-white transition-colors duration-300" :class="isExpanded ? 'px-6' : 'justify-center'">
                <i class="fas fa-pen-alt text-xl w-8 text-center"></i>
                <span x-show="isExpanded" class="ml-4 font-semibold">Input Nilai</span>
            </a>
            <a href="{{ route('jadwal.index') }}" title="Jadwal Kuliah" class="flex items-center py-3 rounded-md hover:bg-[#40916C] hover:text-white transition-colors duration-300" :class="isExpanded ? 'px-6' : 'justify-center'">
                <i class="fas fa-calendar-alt text-xl w-8 text-center"></i>
                <span x-show="isExpanded" class="ml-4 font-semibold">Jadwal Kuliah</span>
            </a>

        @elseif(Auth::user()->role == 'mahasiswa')
            {{-- SIDEBAR MAHASISWA --}}
            <a href="#" title="Dashboard" class="flex items-center py-3 rounded-md hover:bg-[#40916C] hover:text-white transition-colors duration-300" :class="isExpanded ? 'px-6' : 'justify-center'">
                <i class="fas fa-home text-xl w-8 text-center"></i>
                <span x-show="isExpanded" class="ml-4 font-semibold">Dashboard</span>
            </a>
            <a href="{{ route('profile.edit') }}" title="Profil Saya" class="flex items-center py-3 rounded-md hover:bg-[#40916C] hover:text-white transition-colors duration-300" :class="isExpanded ? 'px-6' : 'justify-center'">
                <i class="fas fa-user text-xl w-8 text-center"></i>
                <span x-show="isExpanded" class="ml-4 font-semibold">Profil Saya</span>
            </a>
            <a href="{{ route('krs.index') }}" title="Kartu Rencana Studi (KRS)" class="flex items-center py-3 rounded-md hover:bg-[#40916C] hover:text-white transition-colors duration-300 {{ request()->routeIs('krs.*') ? 'bg-[#40916C] text-white' : '' }}" :class="isExpanded ? 'px-6' : 'justify-center'">
                <i class="fas fa-edit text-xl w-8 text-center"></i>
                <span x-show="isExpanded" class="ml-4 font-semibold">Isi KRS</span>
            </a>
            <a href="#" title="Kartu Hasil Studi (KHS)" class="flex items-center py-3 rounded-md hover:bg-[#40916C] hover:text-white transition-colors duration-300" :class="isExpanded ? 'px-6' : 'justify-center'">
                <i class="fas fa-poll text-xl w-8 text-center"></i>
                <span x-show="isExpanded" class="ml-4 font-semibold">Lihat KHS</span>
            </a>
            <a href="{{ route('jadwal.index') }}" title="Jadwal Kuliah" class="flex items-center py-3 rounded-md hover:bg-[#40916C] hover:text-white transition-colors duration-300" :class="isExpanded ? 'px-6' : 'justify-center'">
                <i class="fas fa-calendar-alt text-xl w-8 text-center"></i>
                <span x-show="isExpanded" class="ml-4 font-semibold">Jadwal Kuliah</span>
            </a>
        @endif
    </nav>

    <!-- Logout -->
    <form method="POST" action="{{ route('logout') }}" class="mt-auto w-full">
        @csrf
        <a href="{{ route('logout') }}" 
        onclick="event.preventDefault(); this.closest('form').submit();" 
        title="Logout" 
        class="flex items-center py-3 rounded-md hover:bg-red-500 hover:text-white transition-colors duration-300" :class="isExpanded ? 'px-6' : 'justify-center'">
            <i class="fas fa-sign-out-alt text-xl w-8 text-center"></i>
            <span x-show="isExpanded" class="ml-4 font-semibold">Logout</span>
        </a>
    </form>
</aside>

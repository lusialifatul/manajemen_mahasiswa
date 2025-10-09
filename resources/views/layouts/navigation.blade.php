{{-- Tag <nav> utama untuk navigasi. Menggunakan Alpine.js (x-data) untuk mengelola state 'open' (terbuka/tertutup) pada menu mobile. --}}
<nav x-data="{ open: false }" class="bg-[#B7E4C7] border-b border-[#40916C]/30">
    {{-- Menu Navigasi Utama (untuk layar besar seperti desktop) --}}
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                {{-- Bagian untuk Link Navigasi Utama --}}
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    {{-- Saat ini kosong, bisa diisi dengan link navigasi utama jika ada. Contoh: <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')"> Dashboard </x-nav-link> --}}
                </div>
            </div>

            {{-- Dropdown Pengaturan Pengguna (hanya tampil di layar besar) --}}
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                {{-- Komponen dropdown dari folder /resources/views/components/dropdown.blade.php --}}
                <x-dropdown align="right" width="48">
                    {{-- Slot untuk "trigger" atau pemicu dropdown, yaitu tombol yang akan menampilkan dropdown saat diklik --}}
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-[#081C15] bg-transparent hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            {{-- Menampilkan nama pengguna yang sedang login --}}
                            <div>{{ Auth::user()->name }}</div>

                            {{-- Ikon panah bawah untuk dropdown --}}
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    {{-- Slot untuk "content" atau isi dari dropdown --}}
                    <x-slot name="content">
                        {{-- Link menuju halaman edit profil --}}
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>

                        {{-- Proses Otentikasi untuk Logout --}}
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf {{-- Token CSRF untuk keamanan --}}

                            {{-- Link untuk logout. Saat diklik, akan menjalankan javascript untuk submit form logout --}}
                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            {{-- Tombol "Hamburger" (untuk layar kecil seperti mobile) --}}
            <div class="-me-2 flex items-center sm:hidden">
                {{-- Tombol ini akan mengubah nilai 'open' dari false menjadi true (atau sebaliknya) saat diklik --}}
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        {{-- Ikon garis (hamburger), tampil saat menu tertutup (!open) --}}
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        {{-- Ikon silang (X), tampil saat menu terbuka (open) --}}
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    {{-- Menu Navigasi Responsif (tampil di layar kecil saat tombol hamburger diklik) --}}
    {{-- :class="{'block': open, 'hidden': ! open}" akan mengubah display menjadi 'block' jika 'open' adalah true, dan 'hidden' jika false --}}
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            {{-- Link navigasi responsif, contohnya ke dashboard --}}
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        {{-- Opsi Pengaturan Responsif (di dalam menu mobile) --}}
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                {{-- Menampilkan nama dan email pengguna --}}
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                {{-- Link menuju halaman edit profil untuk versi mobile --}}
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                {{-- Form logout untuk versi mobile --}}
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>

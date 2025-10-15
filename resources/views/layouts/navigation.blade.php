<nav x-data="{ open: false }" class="bg-[#B7E4C7] border-b border-gray-200 shadow-md">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- Left side (Logo replaced with simple Home icon) -->
            <div class="flex items-center space-x-6">
                <!-- Home Icon -->
                <a href="{{ route('dashboard') }}" class="text-[#081C15] hover:text-[#40916C]" title="Home">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        viewBox="0 0 24 24" aria-hidden="true">
                        <path d="M3 9.75L12 3l9 6.75V21a.75.75 0 01-.75.75H3.75A.75.75 0 013 21V9.75z" />
                        <path d="M9 22.5V12h6v10.5" />
                    </svg>
                </a>

                <!-- Calendar Icon -->
                <a href="{{ route('jadwal.index') }}" class="text-[#081C15] hover:text-[#40916C]" title="Jadwal Kuliah">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <rect width="18" height="18" x="3" y="4" rx="2" ry="2"/>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 2v4M8 2v4M3 10h18" />
                    </svg>
                </a>
            </div>

            <!-- Right side (Notifications & User dropdown) -->
            <div class="flex items-center space-x-6">

                <!-- Notifications Dropdown -->
                <x-dropdown align="right" width="96">
                    <x-slot name="trigger">
                        <button class="relative inline-flex items-center p-2 text-sm font-medium text-center text-[#081C15] hover:text-[#40916C] focus:outline-none">
                            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M10 2a6 6 0 00-6 6v3.586l-1.707 1.707A1 1 0 003 14h14a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"/>
                            </svg>
                            @if($unreadNotificationsCount > 0)
                                <span class="absolute inline-flex items-center justify-center w-4 h-4 text-xs font-bold text-white bg-red-600 border-2 border-white rounded-full -top-1 -end-1">{{ $unreadNotificationsCount }}</span>
                            @endif
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <div class="block px-4 py-2 text-xs text-gray-700">
                            Notifikasi
                        </div>
                        @forelse($latestUnreadNotifications as $notification)
                            <form method="POST" action="{{ route('notifications.markAsRead', $notification->id) }}">
                                @csrf
                                <x-dropdown-link href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                                    <p class="text-sm text-gray-900 font-semibold">{{ $notification->judul }}</p>
                                    <p class="text-xs text-gray-500">{{ $notification->created_at->diffForHumans() }}</p>
                                </x-dropdown-link>
                            </form>
                        @empty
                            <div class="px-4 py-2 text-sm text-gray-900">Tidak ada notifikasi baru</div>
                        @endforelse
                        <div class="border-t border-gray-200">
                            <form method="POST" action="{{ route('notifications.markAllAsRead') }}">
                                @csrf
                                <x-dropdown-link href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                                    Tandai Semua Sudah Dibaca
                                </x-dropdown-link>
                            </form>
                            <x-dropdown-link :href="route('notifications.index')">
                                Lihat Semua Pengumuman
                            </x-dropdown-link>
                        </div>
                    </x-slot>
                </x-dropdown>

                <!-- User Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-[#081C15] bg-white hover:text-[#40916C] focus:outline-none transition ease-in-out duration-150">
                            <div>{{ Auth::user()->name }}</div>
                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Profile
                        </x-dropdown-link>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                onclick="event.preventDefault(); this.closest('form').submit();">
                                Log Out
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger for mobile -->
            <div class="-me-2 flex items-center sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-[#081C15] hover:text-[#40916C] hover:bg-white focus:outline-none focus:bg-white focus:text-[#40916C] transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden bg-[#B7E4C7] border-t border-gray-200">
        <div class="pt-2 pb-3 space-y-1">
            <a href="{{ route('dashboard') }}" class="block pl-3 pr-4 py-2 text-[#081C15] hover:bg-[#40916C] hover:text-white rounded-md text-base font-medium">Home</a>
            <a href="#" class="block pl-3 pr-4 py-2 text-[#081C15] hover:bg-[#40916C] hover:text-white rounded-md text-base font-medium">Messages</a>
            <a href="{{ route('jadwal.index') }}" class="block pl-3 pr-4 py-2 text-[#081C15] hover:bg-[#40916C] hover:text-white rounded-md text-base font-medium">Jadwal Kuliah</a>
        </div>

        <div class="pt-4 pb-1 border-t border-gray-300">
            <div class="px-4">
                <div class="font-medium text-base text-[#081C15]">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-[#081C15]">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-[#081C15] hover:bg-[#40916C] hover:text-white rounded-md text-base font-medium">Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-4 py-2 text-[#081C15] hover:bg-red-500 hover:text-white rounded-md text-base font-medium">
                        Log Out
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>

<nav class="fixed top-0 left-0 w-full bg-white border-b border-emerald-200 backdrop-blur-md z-50">
    <div class="max-w-screen-xl mx-auto flex items-center justify-between p-3">
        <!-- Logo -->
        <a href="{{ url('/') }}" class="flex items-center space-x-3">
            <img style="width:90px;height:40px" src="{{ asset('images/logo.svg') }}" alt="Icon">
        </a>

        <!-- Menu Tengah -->
        <ul class="hidden md:flex space-x-8">
            <li>
                <a href="{{ url('/') }}" class="text-[#081C15] hover:text-[#40916C] font-medium">Home</a>
            </li>
            <li>
                <a href="{{ url('about') }}" class="text-[#081C15] hover:text-[#40916C] font-medium">About</a>
            </li>
            <li>
                <a href="{{ url('contact') }}" class="text-[#081C15] hover:text-[#40916C] font-medium">Contact</a>
            </li>
        </ul>

        <!-- Tombol Kanan -->
        <div class="flex items-center space-x-3">
            <button class="bg-[#40916C] text-white py-1 px-4 rounded hover:bg-[#2D6A4F] transition">
                Login
            </button>
            <button class="bg-[#40916C] text-white py-1 px-4 rounded hover:bg-[#2D6A4F] transition">
                Register
            </button>
        </div>
    </div>
</nav>


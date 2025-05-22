<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="flex min-h-screen">

    <!-- Sidebar -->
    <aside class="fixed top-0 left-0 h-screen w-64 bg-gray-800 text-white p-4 flex flex-col justify-between overflow-y-auto">
        <div>
            <div class="flex items-center gap-3 mb-2">
                <img src="/image/logotb.png" alt="Icon" class="w-8 h-8">
                <h1 class="text-2xl font-bold">SISFO SARPRAS</h1>
            </div>
            <hr class="border-t-2 border-blue-600 mb-6">

            @php
            $barangActive = request()->is('data-barang') || request()->is('kategori');
            $transaksiActive = request()->is('peminjaman') || request()->is('pengembalians');
            $laporanActive = request()->is('laporan*') || request()->is('laporan-barang');
            @endphp

            <nav class="flex flex-col space-y-2 text-white overflow-y-auto max-h-screen pr-2"
                x-data="{ openBarang: {{ $barangActive ? 'true' : 'false' }}, openTransaksi: {{ $transaksiActive ? 'true' : 'false' }} }"
                x-init="$nextTick(() => {
        const activeMenu = document.querySelector('.bg-gray-700');
        if (activeMenu) activeMenu.scrollIntoView({ behavior: 'smooth', block: 'center' });
    })">
                <script src="//unpkg.com/alpinejs" defer></script>

                <!-- Dashboard -->
                <a href="{{ route('dashboard') }}"
                    class="flex items-center px-4 py-2 rounded {{ request()->is('dashboard') ? 'bg-gray-700' : 'hover:bg-gray-700' }}">
                    <svg class="h-5 w-5 mr-2 text-blue-400" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3 9.75L12 3l9 6.75v10.5a.75.75 0 01-.75.75H3.75A.75.75 0 013 20.25V9.75z" />
                    </svg>
                    Dashboard
                </a>

                <!-- Dropdown Barang -->
                <div>
                    <button @click="openBarang = !openBarang"
                        class="flex items-center w-full px-4 py-2 rounded hover:bg-gray-700 {{ $barangActive ? 'bg-gray-700' : '' }}">
                        <svg class="h-5 w-5 mr-2 text-green-400" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0H4" />
                        </svg>
                        Barang
                        <svg class="ml-auto h-4 w-4 text-green-300" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="openBarang" class="ml-6 space-y-2" x-transition>
                        <a href="{{ route('data-barang') }}"
                            class="block px-4 py-1 rounded hover:bg-gray-700 {{ request()->is('data-barang') ? 'bg-gray-700' : '' }}">
                            <svg class="inline h-4 w-4 mr-1 text-lime-400" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 7h18M3 12h18M3 17h18" />
                            </svg>
                            Data Barang
                        </a>
                        <a href="{{ route('kategori.index') }}"
                            class="block px-4 py-1 rounded hover:bg-gray-700 {{ request()->is('kategori') ? 'bg-gray-700' : '' }}">
                            <svg class="inline h-4 w-4 mr-1 text-teal-300" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h7" />
                            </svg>
                            Kategori Barang
                        </a>
                    </div>
                </div>

                <!-- Dropdown Aktivitas -->
                <div>
                    <button @click="openTransaksi = !openTransaksi"
                        class="flex items-center w-full px-4 py-2 rounded hover:bg-gray-700 {{ $transaksiActive ? 'bg-gray-700' : '' }}">
                        <svg class="h-5 w-5 mr-2 text-orange-400" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 8v4l3 3m6 5H3a2 2 0 01-2-2V7a2 2 0 012-2h3l2-2h8l2 2h3a2 2 0 012 2v11a2 2 0 01-2 2z" />
                        </svg>
                        Aktivitas
                        <svg class="ml-auto h-4 w-4 text-orange-300" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="openTransaksi" class="ml-6 space-y-2" x-transition>
                        <a href="{{ route('peminjaman.index') }}"
                            class="block px-4 py-1 rounded hover:bg-gray-700 {{ request()->is('peminjaman') ? 'bg-gray-700' : '' }}">
                            <svg class="inline h-4 w-4 mr-1 text-yellow-400" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 17v-2a4 4 0 014-4h6m-6 0l-4 4m4-4l4-4" />
                            </svg>
                            Peminjaman
                        </a>
                        <a href="{{ route('pengembalian.index') }}"
                            class="block px-4 py-1 rounded hover:bg-gray-700 {{ request()->is('pengembalians') ? 'bg-gray-700' : '' }}">
                            <svg class="inline h-4 w-4 mr-1 text-red-300" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                            </svg>
                            Pengembalian
                        </a>
                    </div>
                </div>
                <!-- Dropdown Laporan -->
                <div x-data="{ openLaporan: {{ $laporanActive ? 'true' : 'false' }} }">
                    <button @click="openLaporan = !openLaporan"
                        class="flex items-center w-full px-4 py-2 rounded hover:bg-gray-700 {{ $laporanActive ? 'bg-gray-700' : '' }}">
                        <svg class="h-5 w-5 mr-2 text-blue-400" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M9 2h6a2 2 0 0 1 2 2v2h-2a2 2 0 0 0-2 2v2H9a2 2 0 0 0-2 2v8a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2v-2h2v2a4 4 0 0 1-4 4H9a4 4 0 0 1-4-4V9a4 4 0 0 1 4-4h2V4a2 2 0 0 1 2-2z" />
                        </svg>
                        Laporan
                        <svg class="ml-auto h-4 w-4 text-blue-300" fill="none" stroke="currentColor" stroke-width="2"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                    <div x-show="openLaporan" class="ml-6 space-y-2" x-transition>
                        <a href="{{ route('laporan.barang') }}"
                            class="block px-4 py-1 rounded hover:bg-gray-700 {{ request()->is('laporan-barang') ? 'bg-gray-700' : '' }}">
                            <svg class="inline h-4 w-4 mr-1 text-blue-300" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm0 6h18M9 14h6m-6 4h6" />
                            </svg>
                            Laporan Barang
                        </a>
                        <a href="{{ route('laporan.index') }}"
                            class="block px-4 py-1 rounded hover:bg-gray-700 {{ request()->is('laporan') ? 'bg-gray-700' : '' }}">
                            <svg class="inline h-4 w-4 mr-1 text-green-300" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01" />
                            </svg>
                            Laporan Peminjaman
                        </a>
                        <a href="{{ route('laporan.pengembalian') }}"
                            class="block px-4 py-1 rounded hover:bg-gray-700 {{ request()->is('laporan-pengembalian') ? 'bg-gray-700' : '' }}">
                            <svg class="inline h-4 w-4 mr-1 text-blue-300" fill="none" stroke="currentColor" stroke-width="2"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12l2 2l4 -4M4 6a2 2 0 0 1 2 -2h10l4 4v12a2 2 0 0 1 -2 2H6a2 2 0 0 1 -2 -2z" />
                            </svg>
                            Laporan Pengembalian
                        </a>
                    </div>
                </div>
                <a href="{{ route('penggunas.index') }}"
                    class="block px-4 py-1 rounded hover:bg-gray-700 {{ request()->is('penggunas') ? 'bg-gray-700' : '' }}">
                    <svg class="inline h-4 w-4 mr-1 text-green-300" fill="none" stroke="currentColor" stroke-width="2"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M5.121 17.804A13.937 13.937 0 0 1 4 12c0-1.657.267-3.252.757-4.757m2.364-2.364A13.937 13.937 0 0 1 12 4c1.657 0 3.252.267 4.757.757m2.364 2.364A13.937 13.937 0 0 1 20 12c0 1.657-.267 3.252-.757 4.757m-2.364 2.364A13.937 13.937 0 0 1 12 20c-1.657 0-3.252-.267-4.757-.757M15 12a3 3 0 1 1-6 0a3 3 0 0 1 6 0z" />
                    </svg>
                    Data User
                </a>

            </nav>


        </div>

        <!-- Logout -->
        <div id="userDropdownWrapper" class="relative inline-block text-left transition-all duration-200 transform">
            <!-- Tombol Nama User -->
            <button type="button" onclick="toggleDropdown()" id="userButton"
                class="inline-flex items-center px-4 py-2 bg-gray-300 text-black rounded shadow hover:bg-gray-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 10a3 3 0 100-6 3 3 0 000 6zm-7 8a7 7 0 1114 0H3z" clip-rule="evenodd" />
                </svg>
                <span>{{ Auth::user()->name }}</span>
                <svg class="ml-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <!-- Dropdown Logout -->
            <div id="dropdownMenu" class="hidden mt-2 w-40 bg-white border rounded shadow z-10">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center px-4 py-2 text-red-600 hover:bg-gray-100">
                        <svg class="h-5 w-5 mr-2 text-red-600" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7" />
                        </svg>
                        Logout
                    </button>
                </form>
            </div>
        </div>


        <script>
            function toggleDropdown() {
                const wrapper = document.getElementById("userDropdownWrapper");
                const dropdown = document.getElementById("dropdownMenu");

                dropdown.classList.toggle("hidden");
                wrapper.classList.toggle("-translate-y-3"); // naik bersama
            }

            // Klik di luar menutup dropdown dan reset posisi
            document.addEventListener("click", function(event) {
                const wrapper = document.getElementById("userDropdownWrapper");
                const dropdown = document.getElementById("dropdownMenu");
                const button = document.getElementById("userButton");

                const isClickInside = button.contains(event.target) || dropdown.contains(event.target);

                if (!isClickInside) {
                    dropdown.classList.add("hidden");
                    wrapper.classList.remove("-translate-y-1");
                }
            });
        </script>



    </aside>

    <!-- Main Content -->
    <main class="flex-1 bg-gray-100 p-6 ml-64">
        @yield('content')
    </main>
</body>

</html>
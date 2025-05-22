<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>SISFO SARPRAS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="flex">
    <!-- Sidebar -->
    <aside class="w-64 bg-gray-800 text-white min-h-screen p-4">
        <h2 class="text-xl font-bold mb-6">SISFO SARPRAS</h2>
        <nav>
            <ul>
                <li class="{{ request()->routeIs('dashboard') ? 'bg-gray-700' : '' }} p-2 rounded mb-2">
                    <a href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="{{ request()->routeIs('kategori') ? 'bg-gray-700' : '' }} p-2 rounded mb-2">
                    <a href="{{ route('kategori') }}">Kategori</a>
                </li>
                <li class="{{ request()->routeIs('peminjaman.index') ? 'bg-gray-700' : '' }} p-2 rounded mb-2">
                    <a href="{{ route('peminjaman.index') }}">Peminjaman</a>
                </li>
            </ul>
        </nav>
    </aside>


    <!-- Content -->
    <div class="flex-1 p-6">
        <!-- Top bar -->
        <div class="flex justify-end items-center mb-4">
            <div class="relative inline-block">
                <button onclick="document.getElementById('dropdown').classList.toggle('hidden')" class="bg-gray-200 px-4 py-2 rounded">
                    {{ Auth::user()->name }}
                </button>
                <div id="dropdown" class="absolute right-0 mt-2 w-48 bg-white border rounded shadow hidden">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="block px-4 py-2 hover:bg-gray-100 w-full text-left">Logout</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Page Content -->
        @yield('content')
    </div>
</body>

</html>
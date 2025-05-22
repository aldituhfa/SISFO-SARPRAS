<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Tailwind CSS (pastikan ini tersedia jika tidak pakai Vite/laravel mix) -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans text-gray-900 antialiased bg-gradient-to-r from-blue-100 to-blue-200">
    <div class="min-h-screen flex items-center justify-center px-4">
        <div class="max-w-md w-full bg-white p-8 rounded-2xl shadow-2xl">
            <div class="flex justify-center mb-6">
                <a href="/">
                    <x-application-logo class="w-16 h-16 text-blue-500" />
                </a>
            </div>
            {{ $slot }}
        </div>
    </div>
</body>
</html>

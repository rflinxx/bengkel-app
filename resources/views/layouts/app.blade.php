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

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Script Pencegah Kedip Layar (Wajib di Head) -->
        <script>
            if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        </script>
    </head>
    
    <!-- Tambahan dark:text-gray-100 agar warna teks default berubah putih saat mode gelap -->
    <body class="font-sans antialiased text-gray-900 dark:text-gray-100">
        
        <!-- Tambahan dark:bg-gray-900 agar latar belakang dasbor menjadi gelap -->
        <div class="min-h-screen bg-gray-100 dark:bg-gray-900 transition-colors duration-300">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <!-- Tambahan dark:bg-gray-800 agar kotak header judul menyesuaikan -->
                <header class="bg-white dark:bg-gray-800 shadow transition-colors duration-300">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>

            <!-- TOMBOL GANTI TEMA MELAYANG (Floating di pojok kanan bawah) -->
            <button id="theme-toggle" class="fixed bottom-6 right-6 p-4 bg-gray-800 dark:bg-gray-200 text-white dark:text-gray-800 rounded-full shadow-lg hover:scale-110 transition-transform duration-200 z-50" title="Ganti Tema">
                🌓
            </button>
        </div>

        <!-- SCRIPT UTAMA TOMBOL TEMA -->
        <script>
            const themeToggleBtn = document.getElementById('theme-toggle');
            const htmlElement = document.documentElement;

            themeToggleBtn.addEventListener('click', function() {
                htmlElement.classList.toggle('dark');
                
                // Simpan status ke memori browser
                if (htmlElement.classList.contains('dark')) {
                    localStorage.setItem('theme', 'dark');
                } else {
                    localStorage.setItem('theme', 'light');
                }
            });
        </script>
    </body>
</html>
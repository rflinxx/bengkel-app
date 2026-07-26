<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistem Informasi Bengkel</title>

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>

    <!-- Script Pencegah Kedip Layar (Wajib di Head) -->
    <script>
        if (localStorage.theme === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
    </script>
    
    <!-- CSS Animasi Garis Bengkel Berjalan -->
    <style>
        .bg-animated-stripes-light {
            background-image: repeating-linear-gradient(
                -45deg,
                rgba(0, 0, 0, 0.04),
                rgba(0, 0, 0, 0.04) 25px,
                transparent 25px,
                transparent 50px
            );
            background-size: 70.7px 70.7px;
            animation: slideStripes 3s linear infinite;
        }
        
        .dark .bg-animated-stripes-dark {
            background-image: repeating-linear-gradient(
                -45deg,
                rgba(255, 255, 255, 0.03),
                rgba(255, 255, 255, 0.03) 25px,
                transparent 25px,
                transparent 50px
            );
            background-size: 70.7px 70.7px;
            animation: slideStripes 3s linear infinite;
        }

        @keyframes slideStripes {
            0% { background-position: 0 0; }
            100% { background-position: 70.7px 70.7px; }
        }
    </style>
</head>
<body class="bg-gray-100 bg-animated-stripes-light dark:bg-gray-900 dark:bg-animated-stripes-dark text-gray-900 dark:text-gray-100 font-sans antialiased min-h-screen flex flex-col justify-between transition-colors duration-300">

    <!-- NAV BAR -->
    <nav class="w-full bg-transparent p-4 relative z-10">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Bengkel" class="h-10 w-10 object-contain rounded-lg shadow-sm bg-white/50 dark:bg-transparent p-1">
                <h1 class="text-xl font-bold text-gray-800 dark:text-white drop-shadow-sm">Garasi MotoCar</h1>
            </div>

            <div class="flex items-center gap-3">
                <button id="theme-toggle" class="p-2 bg-white/80 dark:bg-gray-800/80 text-gray-800 dark:text-white rounded-lg hover:bg-white dark:hover:bg-gray-700 shadow transition backdrop-blur-md" title="Ganti Tema">
                    🌓
                </button>
            </div>
        </div>
    </nav>

    <!-- KONTEN UTAMA (Tengah) -->
    <main class="flex-grow flex items-center justify-center p-6 text-center relative z-10">
        <!-- Kotak Utama dengan Efek Kaca Buram -->
        <div class="max-w-2xl bg-white/85 dark:bg-gray-800/90 backdrop-blur-md p-10 rounded-2xl shadow-xl border border-white/60 dark:border-gray-700 flex flex-col items-center transition-colors duration-300">
            
            <img src="{{ asset('images/logo.png') }}" alt="Logo Bengkel" class="h-28 w-28 object-contain mb-6 drop-shadow">

            <h2 class="text-3xl font-extrabold text-gray-900 dark:text-white mb-3">Selamat Datang di Garasi MotoCar</h2>
            
            <p class="text-gray-600 dark:text-gray-300 leading-relaxed mb-8">Solusi untuk memberikan layanan servis terbaik dan pengelolaan bengkel yang efisien.</p>

            <div class="flex gap-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-8 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 shadow-lg transition transform hover:-translate-y-0.5">
                            Dashboard Saya
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="px-8 py-3 border-2 border-blue-600 text-blue-600 dark:border-blue-400 dark:text-blue-300 font-semibold rounded-lg hover:bg-blue-50 dark:hover:bg-gray-800 transition shadow-sm">
                            Log in
                        </a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-8 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 shadow-lg transition transform hover:-translate-y-0.5">
                                Register
                            </a>
                        @endif
                    @endauth
                @endif
            </div>

        </div>
    </main>

    <!-- FOOTER -->
    <footer class="text-center py-4 text-sm text-gray-600 dark:text-gray-400 font-medium relative z-10">
        &copy; {{ date('Y') }} Sistem Informasi Bengkel. All rights reserved.
    </footer>

    <!-- SCRIPT UTAMA TOMBOL TEMA -->
    <script>
        const themeToggleBtn = document.getElementById('theme-toggle');
        const htmlElement = document.documentElement;

        themeToggleBtn.addEventListener('click', function() {
            htmlElement.classList.toggle('dark');
            
            if (htmlElement.classList.contains('dark')) {
                localStorage.setItem('theme', 'dark');
            } else {
                localStorage.setItem('theme', 'light');
            }
        });
    </script>
</body>
</html>
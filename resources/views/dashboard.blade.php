<x-app-layout>
    <x-slot name="header">
        <!-- Tambahan dark:text-gray-200 pada judul -->
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Bengkel') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Pembungkus Utama -->
            <div class="bg-white dark:bg-gray-900 overflow-hidden shadow-sm sm:rounded-lg p-6 space-y-4 transition-colors duration-300">
                
                <!-- Card Pelanggan -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 transition-colors duration-300">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Pelanggan</p>
                    <p class="text-3xl font-bold text-indigo-600 dark:text-indigo-400 mt-2">{{ $totalCustomer }}</p>
                </div>

                <!-- Card Kendaraan -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 transition-colors duration-300">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Kendaraan</p>
                    <p class="text-3xl font-bold text-blue-600 dark:text-blue-400 mt-2">{{ $totalVehicle }}</p>
                </div>

                <!-- Card Total Transaksi -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 transition-colors duration-300">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Total Transaksi</p>
                    <p class="text-3xl font-bold text-green-600 dark:text-green-400 mt-2">{{ $totalTransaction }}</p>
                </div>

                <!-- Card Servis Pending -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 transition-colors duration-300">
                    <p class="text-sm font-medium text-gray-500 dark:text-gray-400">Servis Pending</p>
                    <p class="text-3xl font-bold text-amber-600 dark:text-amber-400 mt-2">{{ $pendingTransaction }}</p>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
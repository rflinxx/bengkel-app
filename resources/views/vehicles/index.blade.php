<x-app-layout>
    <x-slot name="header">
        <!-- Tambahan dark:text-gray-200 pada judul halaman -->
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kelola Data Kendaraan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Notifikasi Sukses -->
            @if(session('success'))
                <!-- Tambahan warna gelap untuk notifikasi -->
                <div class="mb-4 p-4 bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-700 text-green-700 dark:text-green-300 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                
                <!-- Form Tambah Kendaraan -->
                <!-- Tambahan dark:bg-gray-800 dan dark:border-gray-700 untuk kotak form -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 h-fit transition-colors duration-300">
                    <h3 class="text-lg font-bold mb-4 text-gray-700 dark:text-gray-200">Tambah Kendaraan Baru</h3>
                    <form action="{{ route('vehicles.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300 mb-1">Pemilik (Pelanggan)</label>
                            <!-- Tambahan warna gelap untuk elemen select -->
                            <select name="customer_id" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="">-- Pilih Pelanggan --</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->nama }} ({{ $customer->no_hp }})</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300 mb-1">Plat Nomor</label>
                            <!-- Tambahan warna gelap untuk input text -->
                            <input type="text" name="plat_nomor" placeholder="Contoh: B 1234 ABC" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300 mb-1">Merk (Brand)</label>
                            <input type="text" name="merk" placeholder="Contoh: Honda, Toyota, Yamaha" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300 mb-1">Tipe / Model</label>
                            <input type="text" name="tipe" placeholder="Contoh: Vario 150, Avanza" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>

                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md shadow">
                            Simpan Kendaraan
                        </button>
                    </form>
                </div>

                <!-- Tabel Daftar Kendaraan -->
                <!-- Tambahan dark:bg-gray-800 dan dark:border-gray-700 untuk kotak tabel -->
                <div class="md:col-span-2 bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-x-auto transition-colors duration-300">
                    <h3 class="text-lg font-bold mb-4 text-gray-700 dark:text-gray-200">Daftar Kendaraan Terdaftar</h3>
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <!-- Tambahan warna gelap untuk baris judul tabel -->
                            <tr class="border-b dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">
                                <th class="p-3">#</th>
                                <th class="p-3">Plat Nomor</th>
                                <th class="p-3">Merk & Tipe</th>
                                <th class="p-3">Pemilik</th>
                                <th class="p-3">Aksi</th>
                            </tr>
                        </thead>
                        <!-- Tambahan pemisah baris tabel yang lebih gelap (dark:divide-gray-700) -->
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700 text-sm text-gray-600 dark:text-gray-300">
                            @forelse($vehicles as $vehicle)
                            <tr>
                                <td class="p-3">{{ $loop->iteration }}</td>
                                <!-- Plat nomor dibuat putih di mode gelap agar mencolok -->
                                <td class="p-3 font-bold text-gray-900 dark:text-white">{{ $vehicle->plat_nomor }}</td>
                                <td class="p-3">{{ $vehicle->merk }} - {{ $vehicle->tipe }}</td>
                                <!-- Nama pemilik dibuat sedikit lebih terang (indigo-400) di mode gelap -->
                                <td class="p-3 font-medium text-indigo-600 dark:text-indigo-400">{{ $vehicle->customer->nama ?? '-' }}</td>
                                <td class="p-3 flex space-x-2">
                                    <a href="{{ route('vehicles.edit', $vehicle->id) }}" class="text-amber-600 dark:text-amber-400 hover:text-amber-900 dark:hover:text-amber-300 font-medium">Edit</a>
                                    <form action="{{ route('vehicles.destroy', $vehicle->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data kendaraan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300 font-medium">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-4 text-center text-gray-500 dark:text-gray-400">Belum ada data kendaraan terdaftar.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
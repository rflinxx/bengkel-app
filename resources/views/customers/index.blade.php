<x-app-layout>
    <x-slot name="header">
        <!-- Tambahan dark:text-gray-200 pada judul halaman -->
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kelola Data Pelanggan') }}
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
                
                <!-- Form Tambah Pelanggan -->
                <!-- Tambahan dark:bg-gray-800 dan dark:border-gray-700 untuk kotak luar -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 h-fit transition-colors duration-300">
                    <h3 class="text-lg font-bold mb-4 text-gray-700 dark:text-gray-200">Tambah Pelanggan Baru</h3>
                    <form action="{{ route('customers.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300 mb-1">Nama Lengkap</label>
                            <!-- Tambahan dark:bg-gray-900 dan warna teks putih untuk kolom input -->
                            <input type="text" name="nama" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>
                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300 mb-1">No HP / WA</label>
                            <input type="text" name="no_hp" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>
                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300 mb-1">Alamat</label>
                            <textarea name="alamat" rows="3" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500"></textarea>
                        </div>
                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md shadow">
                            Simpan Pelanggan
                        </button>
                    </form>
                </div>

                <!-- Tabel Daftar Pelanggan -->
                <!-- Tambahan dark:bg-gray-800 dan dark:border-gray-700 untuk kotak luar tabel -->
                <div class="md:col-span-2 bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-x-auto transition-colors duration-300">
                    <h3 class="text-lg font-bold mb-4 text-gray-700 dark:text-gray-200">Daftar Pelanggan</h3>
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <!-- Tambahan warna gelap untuk baris judul tabel -->
                            <tr class="border-b dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">
                                <th class="p-3">#</th>
                                <th class="p-3">Nama</th>
                                <th class="p-3">No HP</th>
                                <th class="p-3">Alamat</th>
                                <th class="p-3">Aksi</th>
                            </tr>
                        </thead>
                        <!-- Tambahan pemisah baris tabel yang lebih gelap (dark:divide-gray-700) -->
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700 text-sm text-gray-600 dark:text-gray-300">
                            @forelse($customers as $customer)
                            <tr>
                                <td class="p-3">{{ $loop->iteration }}</td>
                                <!-- Tambahan teks putih khusus untuk nama agar lebih menonjol -->
                                <td class="p-3 font-medium text-gray-900 dark:text-white">{{ $customer->nama }}</td>
                                <td class="p-3">{{ $customer->no_hp }}</td>
                                <td class="p-3">{{ $customer->alamat ?? '-' }}</td>
                                <td class="p-3 flex space-x-2">
                                    <!-- Warna tombol aksi disesuaikan agar lebih terang di mode gelap -->
                                    <a href="{{ route('customers.edit', $customer->id) }}" class="text-amber-600 dark:text-amber-400 hover:text-amber-900 dark:hover:text-amber-300 font-medium">Edit</a>
                                    <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300 font-medium">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="p-4 text-center text-gray-500 dark:text-gray-400">Belum ada data pelanggan.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
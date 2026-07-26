<x-app-layout>
    <x-slot name="header">
        <!-- Tambahan dark:text-gray-200 -->
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kelola Transaksi Servis') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Notifikasi Sukses -->
            @if(session('success'))
                <!-- Penyesuaian warna alert sukses -->
                <div class="mb-4 p-4 bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-700 text-green-700 dark:text-green-300 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                <!-- Form Tambah Transaksi -->
                <!-- Tambahan dark:bg-gray-800 dan border gelap -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 h-fit transition-colors duration-300">
                    <h3 class="text-lg font-bold mb-4 text-gray-700 dark:text-gray-200">Catat Transaksi Baru</h3>
                    <form action="{{ route('transactions.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300 mb-1">Pelanggan</label>
                            <!-- Input dibuat gelap -->
                            <select name="customer_id" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="">-- Pilih Pelanggan --</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->id }}">{{ $customer->nama }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300 mb-1">Kendaraan</label>
                            <select name="vehicle_id" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="">-- Pilih Kendaraan --</option>
                                @foreach($vehicles as $vehicle)
                                    <option value="{{ $vehicle->id }}">{{ $vehicle->plat_nomor }} - {{ $vehicle->merk }} {{ $vehicle->tipe }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300 mb-1">Keluhan / Perbaikan</label>
                            <textarea name="keluhan" rows="3" placeholder="Contoh: Ganti oli, rem berbunyi" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required></textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300 mb-1">Total Biaya (Rp)</label>
                            <input type="number" name="biaya_total" placeholder="150000" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>

                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300 mb-1">Status Servis</label>
                            <select name="status" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                <option value="pending">Pending</option>
                                <option value="proses">Dalam Proses</option>
                                <option value="selesai">Selesai</option>
                            </select>
                        </div>

                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md shadow">
                            Simpan Transaksi
                        </button>
                    </form>
                </div>

                <!-- Tabel Daftar Transaksi -->
                <!-- Tambahan dark:bg-gray-800 dan border gelap -->
                <div class="lg:col-span-2 bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-x-auto transition-colors duration-300">
                    <h3 class="text-lg font-bold mb-4 text-gray-700 dark:text-gray-200">Riwayat Servis</h3>
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">
                                <th class="p-3">#</th>
                                <th class="p-3">Pelanggan / Plat</th>
                                <th class="p-3">Keluhan</th>
                                <th class="p-3">Biaya</th>
                                <th class="p-3">Status</th>
                                <th class="p-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700 text-sm text-gray-600 dark:text-gray-300">
                            @forelse($transactions as $transaction)
                            <tr>
                                <td class="p-3">{{ $loop->iteration }}</td>
                                <td class="p-3">
                                    <div class="font-bold text-gray-900 dark:text-white">{{ $transaction->customer->nama ?? '-' }}</div>
                                    <div class="text-xs text-gray-500 dark:text-gray-400">{{ $transaction->vehicle->plat_nomor ?? '-' }}</div>
                                </td>
                                <td class="p-3 text-gray-700 dark:text-gray-300">{{ $transaction->keluhan }}</td>
                                <td class="p-3 font-semibold text-gray-900 dark:text-white">Rp {{ number_format($transaction->biaya_total, 0, ',', '.') }}</td>
                                <td class="p-3">
                                    <!-- Penyesuaian warna badge status untuk mode gelap -->
                                    @if($transaction->status == 'pending')
                                        <span class="bg-amber-100 dark:bg-amber-900 text-amber-800 dark:text-amber-300 text-xs font-semibold px-2.5 py-0.5 rounded">Pending</span>
                                    @elseif($transaction->status == 'proses')
                                        <span class="bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-300 text-xs font-semibold px-2.5 py-0.5 rounded">Proses</span>
                                    @else
                                        <span class="bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-300 text-xs font-semibold px-2.5 py-0.5 rounded">Selesai</span>
                                    @endif
                                </td>
                                <td class="p-3 flex space-x-2">
                                    <a href="{{ route('transactions.edit', $transaction->id) }}" class="text-amber-600 dark:text-amber-400 hover:text-amber-900 dark:hover:text-amber-300 font-medium">Edit</a>
                                    <form action="{{ route('transactions.destroy', $transaction->id) }}" method="POST" onsubmit="return confirm('Hapus transaksi ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300 font-medium">Hapus</button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="p-4 text-center text-gray-500 dark:text-gray-400">Belum ada data transaksi servis.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
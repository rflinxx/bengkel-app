<x-app-layout>
    <x-slot name="header">
        <!-- Tambahan dark:text-gray-200 -->
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Kelola Data Admin / Mekanik') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Notifikasi Sukses -->
            @if(session('success'))
                <div class="mb-4 p-4 bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-700 text-green-700 dark:text-green-300 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Notifikasi Error -->
            @if(session('error'))
                <div class="mb-4 p-4 bg-red-100 dark:bg-red-900 border border-red-400 dark:border-red-700 text-red-700 dark:text-red-300 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Form Tambah User -->
                <!-- Tambahan dark:bg-gray-800 dan transisi -->
                <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 h-fit transition-colors duration-300">
                    <h3 class="text-lg font-bold mb-4 text-gray-700 dark:text-gray-200">Tambah Admin / Mekanik Baru</h3>
                    <form action="{{ route('users.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300 mb-1">Nama Lengkap</label>
                            <!-- Input menjadi gelap dengan teks terang -->
                            <input type="text" name="name" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>
                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300 mb-1">Email</label>
                            <input type="email" name="email" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>
                        <div class="mb-4">
                            <label class="block font-medium text-sm text-gray-700 dark:text-gray-300 mb-1">Password</label>
                            <input type="password" name="password" class="w-full border-gray-300 dark:border-gray-600 dark:bg-gray-900 dark:text-gray-100 rounded-md shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                        </div>
                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md shadow">
                            Simpan Admin / Mekanik
                        </button>
                    </form>
                </div>

                <!-- Tabel Daftar User -->
                <!-- Tambahan dark:bg-gray-800 dan transisi -->
                <div class="md:col-span-2 bg-white dark:bg-gray-800 p-6 rounded-lg shadow-sm border border-gray-200 dark:border-gray-700 overflow-x-auto transition-colors duration-300">
                    <h3 class="text-lg font-bold mb-4 text-gray-700 dark:text-gray-200">Daftar Admin / Mekanik</h3>
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <!-- Header tabel menjadi abu-abu gelap (gray-700) -->
                            <tr class="border-b dark:border-gray-600 bg-gray-50 dark:bg-gray-700 text-xs font-semibold text-gray-600 dark:text-gray-300 uppercase">
                                <th class="p-3">#</th>
                                <th class="p-3">Nama</th>
                                <th class="p-3">Email</th>
                                <th class="p-3">Aksi</th>
                            </tr>
                        </thead>
                        <!-- Pemisah baris disesuaikan -->
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700 text-sm text-gray-600 dark:text-gray-300">
                            @forelse($users as $user)
                            <tr>
                                <td class="p-3">{{ $loop->iteration }}</td>
                                <!-- Nama dibuat putih mencolok -->
                                <td class="p-3 font-medium text-gray-900 dark:text-white">{{ $user->name }}</td>
                                <td class="p-3">{{ $user->email }}</td>
                                <td class="p-3 flex space-x-2">
                                    <a href="{{ route('users.edit', $user->id) }}" class="text-amber-600 dark:text-amber-400 hover:text-amber-900 dark:hover:text-amber-300 font-medium">Edit</a>
                                    @if(auth()->id() !== $user->id)
                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 dark:text-red-400 hover:text-red-900 dark:hover:text-red-300 font-medium">Hapus</button>
                                    </form>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="p-4 text-center text-gray-500 dark:text-gray-400">Belum ada data user.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
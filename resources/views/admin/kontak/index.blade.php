@extends('layouts.admin')

@section('title', 'Kelola Pesan Masuk')

@section('content')
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Pesan Masuk</h1>
            <p class="text-gray-600">Kelola pesan dari pengunjung website</p>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
        <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-blue-500">
            <p class="text-sm text-gray-500">Total Pesan</p>
            <p class="text-2xl font-bold text-gray-800">{{ $stats['total'] ?? 0 }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-yellow-500">
            <p class="text-sm text-gray-500">Belum Dibaca</p>
            <p class="text-2xl font-bold text-yellow-600">{{ $stats['baru'] ?? 0 }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-green-500">
            <p class="text-sm text-gray-500">Sudah Dibalas</p>
            <p class="text-2xl font-bold text-green-600">{{ $stats['dibalas'] ?? 0 }}</p>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-gray-500">
            <p class="text-sm text-gray-500">Selesai</p>
            <p class="text-2xl font-bold text-gray-600">{{ $stats['selesai'] ?? 0 }}</p>
        </div>
    </div>

    <!-- Filter -->
    <div class="bg-white rounded-xl shadow-sm p-4 mb-6">
        <form action="" method="GET" class="flex flex-wrap gap-4 items-end">
            <div>
                <label class="block text-sm text-gray-600 mb-1">Status</label>
                <select name="status"
                    class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                    <option value="">Semua Status</option>
                    <option value="baru" {{ request('status') == 'baru' ? 'selected' : '' }}>Belum Dibaca</option>
                    <option value="dibaca" {{ request('status') == 'dibaca' ? 'selected' : '' }}>Sudah Dibaca</option>
                    <option value="dibalas" {{ request('status') == 'dibalas' ? 'selected' : '' }}>Sudah Dibalas</option>
                    <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>
            <div>
                <label class="block text-sm text-gray-600 mb-1">Subjek</label>
                <select name="subjek"
                    class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                    <option value="">Semua Subjek</option>
                    <option value="Pertanyaan Umum" {{ request('subjek') == 'Pertanyaan Umum' ? 'selected' : '' }}>
                        Pertanyaan Umum</option>
                    <option value="Pelayanan Administrasi"
                        {{ request('subjek') == 'Pelayanan Administrasi' ? 'selected' : '' }}>Pelayanan Administrasi
                    </option>
                    <option value="Saran & Kritik" {{ request('subjek') == 'Saran & Kritik' ? 'selected' : '' }}>Saran &
                        Kritik</option>
                </select>
            </div>
            <div class="flex-1">
                <label class="block text-sm text-gray-600 mb-1">Cari</label>
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari nama, email, atau pesan..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
            </div>
            <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                <i class="fas fa-search mr-2"></i>Filter
            </button>
        </form>
    </div>

    <!-- Messages List -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider w-8">
                            <input type="checkbox" class="rounded border-gray-300 text-green-600 focus:ring-green-500">
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pengirim
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subjek &
                            Pesan</th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($kontaks ?? [] as $kontak)
                        <tr class="hover:bg-gray-50 {{ $kontak->status == 'baru' ? 'bg-yellow-50' : '' }}">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <input type="checkbox" class="rounded border-gray-300 text-green-600 focus:ring-green-500">
                            </td>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center mr-3">
                                        <span class="text-green-700 font-medium">{{ substr($kontak->nama, 0, 1) }}</span>
                                    </div>
                                    <div>
                                        <p
                                            class="font-medium text-gray-900 {{ $kontak->status == 'baru' ? 'font-bold' : '' }}">
                                            {{ $kontak->nama }}
                                        </p>
                                        <p class="text-sm text-gray-500">{{ $kontak->email }}</p>
                                        @if ($kontak->telepon)
                                            <p class="text-xs text-gray-400">{{ $kontak->telepon }}</p>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="font-medium text-gray-800 {{ $kontak->status == 'baru' ? 'font-bold' : '' }}">
                                    {{ $kontak->subjek }}
                                </p>
                                <p class="text-sm text-gray-500 line-clamp-2">{{ Str::limit($kontak->pesan, 80) }}</p>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                @switch($kontak->status)
                                    @case('baru')
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                            <i class="fas fa-envelope mr-1"></i>Baru
                                        </span>
                                    @break

                                    @case('dibaca')
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            <i class="fas fa-eye mr-1"></i>Dibaca
                                        </span>
                                    @break

                                    @case('dibalas')
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-reply mr-1"></i>Dibalas
                                        </span>
                                    @break

                                    @case('selesai')
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                            <i class="fas fa-check mr-1"></i>Selesai
                                        </span>
                                    @break
                                @endswitch
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $kontak->created_at->format('d M Y') }}<br>
                                <span class="text-xs">{{ $kontak->created_at->format('H:i') }}</span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.kontak.show', $kontak) }}"
                                        class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg" title="Lihat">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="mailto:{{ $kontak->email }}"
                                        class="p-2 text-green-600 hover:bg-green-50 rounded-lg" title="Balas Email">
                                        <i class="fas fa-reply"></i>
                                    </a>
                                    <form action="{{ route('admin.kontak.destroy', $kontak) }}" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus pesan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg"
                                            title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center">
                                        <div class="bg-gray-100 rounded-full p-4 mb-4">
                                            <i class="fas fa-inbox text-gray-400 text-3xl"></i>
                                        </div>
                                        <p class="text-gray-500 font-medium">Belum ada pesan masuk</p>
                                        <p class="text-gray-400 text-sm">Pesan dari pengunjung akan muncul di sini</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if (isset($kontaks) && $kontaks->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $kontaks->withQueryString()->links() }}
                </div>
            @endif
        </div>
    @endsection

@extends('layouts.admin')

@section('title', 'Manajemen Wisata')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Wisata</h1>
                <p class="text-gray-600">Kelola destinasi wisata desa</p>
            </div>
            <a href="{{ route('admin.wisata.create') }}"
                class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition">
                <i class="fas fa-plus mr-2"></i>
                Tambah Wisata
            </a>
        </div>

        <!-- Wisata Table -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            @if (session('success'))
                <div class="m-6 mb-0 p-4 bg-green-100 border border-green-200 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Wisata</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Kategori</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Lokasi</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($wisatas as $wisata)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="w-16 h-16 rounded-lg overflow-hidden bg-gray-100 mr-4 flex-shrink-0">
                                            @if ($wisata->gambar)
                                                <img src="{{ Storage::url($wisata->gambar) }}" alt="{{ $wisata->nama }}"
                                                    class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center">
                                                    <i class="fas fa-mountain text-2xl text-gray-300"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-800">{{ $wisata->nama }}</p>
                                            @if ($wisata->harga_tiket)
                                                <p class="text-sm text-primary-600">Rp
                                                    {{ number_format($wisata->harga_tiket, 0, ',', '.') }}</p>
                                            @else
                                                <p class="text-sm text-green-600">Gratis</p>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @if ($wisata->kategori)
                                        <span
                                            class="px-3 py-1 bg-blue-100 text-blue-700 text-sm font-medium rounded-full">{{ $wisata->kategori }}</span>
                                    @else
                                        <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-gray-600 text-sm">{{ $wisata->lokasi ?? '-' }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    @if ($wisata->is_active)
                                        <span
                                            class="px-3 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-full">Aktif</span>
                                    @else
                                        <span
                                            class="px-3 py-1 bg-gray-100 text-gray-600 text-xs font-medium rounded-full">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.wisata.edit', $wisata->id) }}"
                                            class="p-2 text-gray-500 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.wisata.destroy', $wisata->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus wisata ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition"
                                                title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
                                    <i class="fas fa-mountain text-4xl text-gray-300 mb-3"></i>
                                    <p class="text-gray-500">Belum ada data wisata.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($wisatas->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $wisatas->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection

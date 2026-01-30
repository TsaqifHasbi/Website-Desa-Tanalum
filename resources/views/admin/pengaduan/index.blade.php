@extends('layouts.admin')

@section('title', 'Manajemen Pengaduan')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Pengaduan Masyarakat</h1>
                <p class="text-gray-600">Kelola pengaduan dan saran dari masyarakat</p>
            </div>
            <div class="flex items-center gap-3">
                <span class="px-3 py-1 bg-yellow-100 text-yellow-700 text-sm font-medium rounded-full">
                    {{ $stats['pending'] ?? 0 }} Menunggu
                </span>
                <span class="px-3 py-1 bg-blue-100 text-blue-700 text-sm font-medium rounded-full">
                    {{ $stats['proses'] ?? 0 }} Diproses
                </span>
                <span class="px-3 py-1 bg-green-100 text-green-700 text-sm font-medium rounded-full">
                    {{ $stats['selesai'] ?? 0 }} Selesai
                </span>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <form action="{{ route('admin.pengaduan.index') }}" method="GET" class="grid md:grid-cols-4 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Cari</label>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Nama, kode tracking, atau isi pengaduan..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                        <option value="proses" {{ request('status') == 'proses' ? 'selected' : '' }}>Diproses</option>
                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="ditolak" {{ request('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                    </select>
                </div>
                <div class="flex items-end gap-2">
                    <button type="submit"
                        class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition">
                        <i class="fas fa-search mr-1"></i> Filter
                    </button>
                    <a href="{{ route('admin.pengaduan.index') }}"
                        class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Pengaduan Table -->
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
                                Kode</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Pelapor</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Pengaduan</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Tanggal</th>
                            <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($pengaduans as $pengaduan)
                            <tr
                                class="hover:bg-gray-50 transition {{ $pengaduan->status == 'pending' ? 'bg-yellow-50' : '' }}">
                                <td class="px-6 py-4">
                                    <span
                                        class="font-mono text-sm text-primary-600 font-medium">{{ $pengaduan->kode_tracking }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="font-medium text-gray-800">{{ $pengaduan->nama }}</p>
                                    <p class="text-sm text-gray-500">{{ $pengaduan->email ?? ($pengaduan->telepon ?? '-') }}
                                    </p>
                                </td>
                                <td class="px-6 py-4 max-w-xs">
                                    <p class="text-gray-800 line-clamp-2">{{ Str::limit($pengaduan->isi, 100) }}</p>
                                    @if ($pengaduan->lampiran)
                                        <span class="text-xs text-gray-500"><i class="fas fa-paperclip mr-1"></i>
                                            Lampiran</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $statusColors = [
                                            'pending' => 'bg-yellow-100 text-yellow-700',
                                            'proses' => 'bg-blue-100 text-blue-700',
                                            'selesai' => 'bg-green-100 text-green-700',
                                            'ditolak' => 'bg-red-100 text-red-700',
                                        ];
                                        $statusLabels = [
                                            'pending' => 'Menunggu',
                                            'proses' => 'Diproses',
                                            'selesai' => 'Selesai',
                                            'ditolak' => 'Ditolak',
                                        ];
                                    @endphp
                                    <span
                                        class="px-3 py-1 text-xs font-medium rounded-full {{ $statusColors[$pengaduan->status] ?? 'bg-gray-100 text-gray-700' }}">
                                        {{ $statusLabels[$pengaduan->status] ?? $pengaduan->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-gray-800">{{ $pengaduan->created_at->format('d M Y') }}</p>
                                    <p class="text-sm text-gray-500">{{ $pengaduan->created_at->format('H:i') }}</p>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.pengaduan.show', $pengaduan->id) }}"
                                            class="p-2 text-gray-500 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition"
                                            title="Detail">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form action="{{ route('admin.pengaduan.destroy', $pengaduan->id) }}"
                                            method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus pengaduan ini?')">
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
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <i class="fas fa-inbox text-4xl text-gray-300 mb-3"></i>
                                    <p class="text-gray-500">Belum ada pengaduan.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($pengaduans->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $pengaduans->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection

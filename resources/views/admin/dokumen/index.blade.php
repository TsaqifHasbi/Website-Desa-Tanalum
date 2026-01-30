@extends('layouts.admin')

@section('title', 'Manajemen Dokumen PPID')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Dokumen PPID</h1>
                <p class="text-gray-600">Kelola dokumen informasi publik</p>
            </div>
            <a href="{{ route('admin.dokumen.create') }}"
                class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition">
                <i class="fas fa-plus mr-2"></i>
                Upload Dokumen
            </a>
        </div>

        <!-- Stats -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
            <div class="bg-white rounded-xl p-4 shadow-sm">
                <p class="text-sm text-gray-600">Total Dokumen</p>
                <p class="text-2xl font-bold text-gray-800">{{ $stats['total'] ?? 0 }}</p>
            </div>
            <div class="bg-white rounded-xl p-4 shadow-sm">
                <p class="text-sm text-gray-600">Berkala</p>
                <p class="text-2xl font-bold text-blue-600">{{ $stats['berkala'] ?? 0 }}</p>
            </div>
            <div class="bg-white rounded-xl p-4 shadow-sm">
                <p class="text-sm text-gray-600">Serta Merta</p>
                <p class="text-2xl font-bold text-yellow-600">{{ $stats['serta_merta'] ?? 0 }}</p>
            </div>
            <div class="bg-white rounded-xl p-4 shadow-sm">
                <p class="text-sm text-gray-600">Setiap Saat</p>
                <p class="text-2xl font-bold text-green-600">{{ $stats['setiap_saat'] ?? 0 }}</p>
            </div>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <form action="{{ route('admin.dokumen.index') }}" method="GET" class="grid md:grid-cols-4 gap-4">
                <div class="md:col-span-2">
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari dokumen..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                </div>
                <div>
                    <select name="jenis"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                        <option value="">Semua Jenis</option>
                        <option value="berkala" {{ request('jenis') == 'berkala' ? 'selected' : '' }}>Informasi Berkala
                        </option>
                        <option value="serta_merta" {{ request('jenis') == 'serta_merta' ? 'selected' : '' }}>Serta Merta
                        </option>
                        <option value="setiap_saat" {{ request('jenis') == 'setiap_saat' ? 'selected' : '' }}>Setiap Saat
                        </option>
                    </select>
                </div>
                <div class="flex gap-2">
                    <button type="submit"
                        class="flex-1 px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition">
                        <i class="fas fa-filter mr-1"></i> Filter
                    </button>
                    <a href="{{ route('admin.dokumen.index') }}"
                        class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg transition">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Documents Table -->
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
                                Dokumen</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Jenis</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Kategori</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Download</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Tanggal</th>
                            <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($dokumens as $dokumen)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="w-10 h-10 rounded-lg bg-red-100 flex items-center justify-center mr-3">
                                            <i class="fas fa-file-pdf text-red-500"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-800 line-clamp-1">{{ $dokumen->judul }}</p>
                                            <p class="text-sm text-gray-500">{{ $dokumen->file_size ?? '-' }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $jenisColors = [
                                            'berkala' => 'bg-blue-100 text-blue-700',
                                            'serta_merta' => 'bg-yellow-100 text-yellow-700',
                                            'setiap_saat' => 'bg-green-100 text-green-700',
                                        ];
                                        $jenisLabels = [
                                            'berkala' => 'Berkala',
                                            'serta_merta' => 'Serta Merta',
                                            'setiap_saat' => 'Setiap Saat',
                                        ];
                                    @endphp
                                    <span
                                        class="px-3 py-1 text-xs font-medium rounded-full {{ $jenisColors[$dokumen->jenis] ?? 'bg-gray-100 text-gray-700' }}">
                                        {{ $jenisLabels[$dokumen->jenis] ?? $dokumen->jenis }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-gray-600 text-sm">{{ $dokumen->kategori ?? '-' }}</span>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="text-gray-600">{{ number_format($dokumen->download_count ?? 0) }}x</span>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-gray-800">
                                        {{ $dokumen->tanggal ? $dokumen->tanggal->format('d M Y') : $dokumen->created_at->format('d M Y') }}
                                    </p>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ Storage::url($dokumen->file) }}" target="_blank"
                                            class="p-2 text-gray-500 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition"
                                            title="Lihat">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.dokumen.edit', $dokumen->id) }}"
                                            class="p-2 text-gray-500 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.dokumen.destroy', $dokumen->id) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus dokumen ini?')">
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
                                    <i class="fas fa-folder-open text-4xl text-gray-300 mb-3"></i>
                                    <p class="text-gray-500">Belum ada dokumen.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($dokumens->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $dokumens->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection

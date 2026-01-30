@extends('layouts.admin')

@section('title', 'Kelola PPID')

@section('content')
    <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Dokumen PPID</h1>
            <p class="text-gray-600">Kelola dokumen informasi publik desa</p>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.ppid.dokumen.create') }}"
                class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                <i class="fas fa-plus mr-2"></i>Tambah Dokumen
            </a>
        </div>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Total Dokumen</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $dokumens->total() }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-file-alt text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Info Berkala</p>
                    <p class="text-2xl font-bold text-green-600">
                        {{ $kategoris->where('jenis', 'berkala')->sum('dokumens_count') }}</p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-calendar-check text-green-600 text-xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Info Serta Merta</p>
                    <p class="text-2xl font-bold text-orange-600">
                        {{ $kategoris->where('jenis', 'serta_merta')->sum('dokumens_count') }}</p>
                </div>
                <div class="w-12 h-12 bg-orange-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-bullhorn text-orange-600 text-xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Info Setiap Saat</p>
                    <p class="text-2xl font-bold text-blue-600">
                        {{ $kategoris->where('jenis', 'setiap_saat')->sum('dokumens_count') }}</p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-clock text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter -->
    <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
        <form action="" method="GET" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari dokumen..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
            </div>
            <div>
                <select name="kategori"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                    <option value="">Semua Kategori</option>
                    @foreach ($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ request('kategori') == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div>
                <select name="jenis"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                    <option value="">Semua Jenis</option>
                    <option value="berkala" {{ request('jenis') == 'berkala' ? 'selected' : '' }}>Info Berkala</option>
                    <option value="serta_merta" {{ request('jenis') == 'serta_merta' ? 'selected' : '' }}>Info Serta Merta
                    </option>
                    <option value="setiap_saat" {{ request('jenis') == 'setiap_saat' ? 'selected' : '' }}>Info Setiap Saat
                    </option>
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    <i class="fas fa-search"></i>
                </button>
                <a href="{{ route('admin.ppid.index') }}"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Dokumen
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Kategori
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Download
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($dokumens as $dokumen)
                        <tr>
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-red-100 rounded-lg flex items-center justify-center mr-3">
                                        <i class="fas fa-file-pdf text-red-600"></i>
                                    </div>
                                    <div>
                                        <div class="text-sm font-medium text-gray-800">{{ Str::limit($dokumen->nama, 50) }}
                                        </div>
                                        <div class="text-xs text-gray-500">
                                            {{ $dokumen->nomor_dokumen ?? '-' }} |
                                            {{ $dokumen->tanggal_dokumen ? $dokumen->tanggal_dokumen->format('d M Y') : '-' }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                {{ $dokumen->kategori->nama ?? '-' }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $jenisColors = [
                                        'berkala' => 'green',
                                        'serta_merta' => 'orange',
                                        'setiap_saat' => 'blue',
                                    ];
                                    $jenisLabels = [
                                        'berkala' => 'Berkala',
                                        'serta_merta' => 'Serta Merta',
                                        'setiap_saat' => 'Setiap Saat',
                                    ];
                                    $jenis = $dokumen->kategori->jenis ?? 'berkala';
                                @endphp
                                <span
                                    class="px-2 py-1 text-xs font-medium rounded-full bg-{{ $jenisColors[$jenis] ?? 'gray' }}-100 text-{{ $jenisColors[$jenis] ?? 'gray' }}-800">
                                    {{ $jenisLabels[$jenis] ?? $jenis }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                {{ $dokumen->download_count ?? 0 }}x
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if ($dokumen->is_active)
                                    <span
                                        class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Aktif</span>
                                @else
                                    <span
                                        class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">Nonaktif</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center gap-2">
                                    @if ($dokumen->file_path)
                                        <a href="{{ Storage::url($dokumen->file_path) }}" target="_blank"
                                            class="text-blue-600 hover:text-blue-800" title="Lihat">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    @endif
                                    <a href="{{ route('admin.ppid.dokumen.edit', $dokumen) }}"
                                        class="text-green-600 hover:text-green-800" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.ppid.dokumen.destroy', $dokumen) }}" method="POST"
                                        class="inline" onsubmit="return confirm('Yakin ingin menghapus dokumen ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-800" title="Hapus">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-folder-open text-4xl text-gray-300 mb-4"></i>
                                    <p>Belum ada dokumen PPID</p>
                                    <a href="{{ route('admin.ppid.dokumen.create') }}"
                                        class="mt-4 text-green-600 hover:text-green-700">
                                        + Tambah Dokumen Pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if ($dokumens->hasPages())
            <div class="px-6 py-4 border-t border-gray-200">
                {{ $dokumens->links() }}
            </div>
        @endif
    </div>
@endsection

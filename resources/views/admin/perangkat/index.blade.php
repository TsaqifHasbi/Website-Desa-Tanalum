@extends('layouts.admin')

@section('title', 'Manajemen Perangkat Desa')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Perangkat Desa</h1>
                <p class="text-gray-600">Kelola data aparatur desa</p>
            </div>
            <a href="{{ route('admin.perangkat.create') }}"
                class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition">
                <i class="fas fa-plus mr-2"></i>
                Tambah Perangkat
            </a>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <form action="{{ route('admin.perangkat.index') }}" method="GET" class="grid md:grid-cols-4 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Cari</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Nama atau jabatan..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                    <select name="kategori"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                        <option value="">Semua</option>
                        <option value="kepala_desa" {{ request('kategori') == 'kepala_desa' ? 'selected' : '' }}>Kepala Desa
                        </option>
                        <option value="perangkat" {{ request('kategori') == 'perangkat' ? 'selected' : '' }}>Perangkat Desa
                        </option>
                        <option value="bpd" {{ request('kategori') == 'bpd' ? 'selected' : '' }}>BPD</option>
                        <option value="lembaga" {{ request('kategori') == 'lembaga' ? 'selected' : '' }}>Lembaga Desa
                        </option>
                    </select>
                </div>
                <div class="flex items-end gap-2">
                    <button type="submit"
                        class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition">
                        <i class="fas fa-search mr-1"></i> Filter
                    </button>
                    <a href="{{ route('admin.perangkat.index') }}"
                        class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Perangkat Table -->
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
                                Urutan</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Perangkat</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Jabatan</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Kategori</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse($perangkats as $perangkat)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <span
                                        class="w-8 h-8 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center font-bold text-sm">
                                        {{ $perangkat->urutan ?? $loop->iteration }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="w-12 h-12 rounded-full overflow-hidden bg-gray-100 mr-3">
                                            @if ($perangkat->foto)
                                                <img src="{{ Storage::url($perangkat->foto) }}"
                                                    alt="{{ $perangkat->nama }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center">
                                                    <i class="fas fa-user text-gray-300"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-800">{{ $perangkat->nama }}</p>
                                            @if ($perangkat->nip)
                                                <p class="text-sm text-gray-500">NIP: {{ $perangkat->nip }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-gray-800">{{ $perangkat->jabatan }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $kategoriColors = [
                                            'kepala_desa' => 'bg-purple-100 text-purple-700',
                                            'perangkat' => 'bg-blue-100 text-blue-700',
                                            'bpd' => 'bg-green-100 text-green-700',
                                            'lembaga' => 'bg-orange-100 text-orange-700',
                                        ];
                                        $kategoriLabels = [
                                            'kepala_desa' => 'Kepala Desa',
                                            'perangkat' => 'Perangkat',
                                            'bpd' => 'BPD',
                                            'lembaga' => 'Lembaga',
                                        ];
                                    @endphp
                                    <span
                                        class="px-3 py-1 text-xs font-medium rounded-full {{ $kategoriColors[$perangkat->kategori] ?? 'bg-gray-100 text-gray-700' }}">
                                        {{ $kategoriLabels[$perangkat->kategori] ?? $perangkat->kategori }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    @if ($perangkat->is_active)
                                        <span
                                            class="px-3 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-full">Aktif</span>
                                    @else
                                        <span
                                            class="px-3 py-1 bg-gray-100 text-gray-600 text-xs font-medium rounded-full">Nonaktif</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.perangkat.edit', $perangkat->id) }}"
                                            class="p-2 text-gray-500 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.perangkat.destroy', $perangkat->id) }}"
                                            method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
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
                                    <i class="fas fa-users text-4xl text-gray-300 mb-3"></i>
                                    <p class="text-gray-500">Belum ada data perangkat desa.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($perangkats->hasPages())
                <div class="px-6 py-4 border-t border-gray-200">
                    {{ $perangkats->withQueryString()->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection

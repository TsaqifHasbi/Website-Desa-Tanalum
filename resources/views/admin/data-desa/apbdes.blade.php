@extends('layouts.admin')

@section('title', 'Data APBDes')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Anggaran Pendapatan dan Belanja Desa</h1>
                <p class="text-gray-600">Kelola data APBDes</p>
            </div>
            <div class="flex items-center gap-3">
                <select id="tahun"
                    class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                    onchange="window.location.href='?tahun='+this.value">
                    @for ($y = date('Y'); $y >= 2020; $y--)
                        <option value="{{ $y }}" {{ request('tahun', date('Y')) == $y ? 'selected' : '' }}>
                            {{ $y }}</option>
                    @endfor
                </select>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="grid md:grid-cols-3 gap-6">
            <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-xl shadow-sm p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-green-100">Total Pendapatan</p>
                        <p class="text-3xl font-bold mt-1">Rp {{ number_format($summary['pendapatan'] ?? 0, 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                        <i class="fas fa-arrow-down text-xl"></i>
                    </div>
                </div>
            </div>
            <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-xl shadow-sm p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-red-100">Total Belanja</p>
                        <p class="text-3xl font-bold mt-1">Rp {{ number_format($summary['belanja'] ?? 0, 0, ',', '.') }}</p>
                    </div>
                    <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                        <i class="fas fa-arrow-up text-xl"></i>
                    </div>
                </div>
            </div>
            <div class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-xl shadow-sm p-6 text-white">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-blue-100">Pembiayaan</p>
                        <p class="text-3xl font-bold mt-1">Rp {{ number_format($summary['pembiayaan'] ?? 0, 0, ',', '.') }}
                        </p>
                    </div>
                    <div class="w-12 h-12 bg-white/20 rounded-lg flex items-center justify-center">
                        <i class="fas fa-exchange-alt text-xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.data.apbdes.update') }}" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="tahun" value="{{ request('tahun', date('Y')) }}">

            @if (session('success'))
                <div class="p-4 bg-green-100 border border-green-200 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Pendapatan -->
            <div class="bg-white rounded-xl shadow-sm mb-6">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-800">
                        <i class="fas fa-arrow-down text-green-600 mr-2"></i>
                        Pendapatan
                    </h3>
                </div>
                <div class="p-6 space-y-4">
                    @php
                        $pendapatanItems = [
                            'Pendapatan Asli Desa' => [
                                'Hasil Usaha Desa',
                                'Hasil Aset Desa',
                                'Swadaya/Partisipasi',
                                'Lain-lain PAD',
                            ],
                            'Pendapatan Transfer' => [
                                'Dana Desa',
                                'Bagian Hasil PDRD',
                                'ADD',
                                'Bantuan Keuangan Provinsi',
                                'Bantuan Keuangan Kab/Kota',
                            ],
                            'Pendapatan Lain-lain' => ['Hibah/Sumbangan', 'Lain-lain Pendapatan'],
                        ];
                    @endphp

                    @foreach ($pendapatanItems as $kategori => $items)
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h4 class="font-semibold text-gray-700 mb-3">{{ $kategori }}</h4>
                            <div class="grid md:grid-cols-2 gap-4">
                                @foreach ($items as $item)
                                    <div>
                                        <label class="block text-sm text-gray-600 mb-1">{{ $item }}</label>
                                        <div class="relative">
                                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">Rp</span>
                                            <input type="number" name="pendapatan[{{ Str::slug($item) }}]"
                                                value="{{ old('pendapatan.' . Str::slug($item), $data['pendapatan'][Str::slug($item)] ?? 0) }}"
                                                min="0"
                                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Belanja -->
            <div class="bg-white rounded-xl shadow-sm mb-6">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-800">
                        <i class="fas fa-arrow-up text-red-600 mr-2"></i>
                        Belanja
                    </h3>
                </div>
                <div class="p-6 space-y-4">
                    @php
                        $belanjaItems = [
                            'Bidang Penyelenggaraan Pemerintahan' => [
                                'Operasional Pemerintahan',
                                'Penghasilan Tetap',
                                'Tunjangan',
                                'Operasional BPD',
                            ],
                            'Bidang Pelaksanaan Pembangunan' => [
                                'Pembangunan Infrastruktur',
                                'Pembangunan Sarana Prasarana',
                                'Pengembangan Ekonomi',
                                'Pembangunan Kesehatan',
                                'Pembangunan Pendidikan',
                            ],
                            'Bidang Pembinaan Kemasyarakatan' => [
                                'Ketentraman/Ketertiban',
                                'Kebudayaan/Keagamaan',
                                'Kepemudaan/Olahraga',
                                'Kelembagaan Masyarakat',
                            ],
                            'Bidang Pemberdayaan Masyarakat' => [
                                'Pemberdayaan Ekonomi',
                                'Pelatihan/Pendidikan',
                                'Kesehatan Masyarakat',
                            ],
                        ];
                    @endphp

                    @foreach ($belanjaItems as $kategori => $items)
                        <div class="bg-gray-50 rounded-lg p-4">
                            <h4 class="font-semibold text-gray-700 mb-3">{{ $kategori }}</h4>
                            <div class="grid md:grid-cols-2 gap-4">
                                @foreach ($items as $item)
                                    <div>
                                        <label class="block text-sm text-gray-600 mb-1">{{ $item }}</label>
                                        <div class="relative">
                                            <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">Rp</span>
                                            <input type="number" name="belanja[{{ Str::slug($item) }}]"
                                                value="{{ old('belanja.' . Str::slug($item), $data['belanja'][Str::slug($item)] ?? 0) }}"
                                                min="0"
                                                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Pembiayaan -->
            <div class="bg-white rounded-xl shadow-sm">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-bold text-gray-800">
                        <i class="fas fa-exchange-alt text-blue-600 mr-2"></i>
                        Pembiayaan
                    </h3>
                </div>
                <div class="p-6">
                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="bg-green-50 rounded-lg p-4">
                            <h4 class="font-semibold text-green-700 mb-3">Penerimaan Pembiayaan</h4>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm text-gray-600 mb-1">SILPA Tahun Sebelumnya</label>
                                    <div class="relative">
                                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">Rp</span>
                                        <input type="number" name="pembiayaan[silpa]"
                                            value="{{ old('pembiayaan.silpa', $data['pembiayaan']['silpa'] ?? 0) }}"
                                            min="0"
                                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm text-gray-600 mb-1">Pencairan Dana Cadangan</label>
                                    <div class="relative">
                                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">Rp</span>
                                        <input type="number" name="pembiayaan[pencairan_cadangan]"
                                            value="{{ old('pembiayaan.pencairan_cadangan', $data['pembiayaan']['pencairan_cadangan'] ?? 0) }}"
                                            min="0"
                                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bg-red-50 rounded-lg p-4">
                            <h4 class="font-semibold text-red-700 mb-3">Pengeluaran Pembiayaan</h4>
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm text-gray-600 mb-1">Pembentukan Dana Cadangan</label>
                                    <div class="relative">
                                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">Rp</span>
                                        <input type="number" name="pembiayaan[pembentukan_cadangan]"
                                            value="{{ old('pembiayaan.pembentukan_cadangan', $data['pembiayaan']['pembentukan_cadangan'] ?? 0) }}"
                                            min="0"
                                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                    </div>
                                </div>
                                <div>
                                    <label class="block text-sm text-gray-600 mb-1">Penyertaan Modal</label>
                                    <div class="relative">
                                        <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400">Rp</span>
                                        <input type="number" name="pembiayaan[penyertaan_modal]"
                                            value="{{ old('pembiayaan.penyertaan_modal', $data['pembiayaan']['penyertaan_modal'] ?? 0) }}"
                                            min="0"
                                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 rounded-b-xl flex items-center justify-end">
                    <button type="submit"
                        class="px-6 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition">
                        <i class="fas fa-save mr-2"></i>
                        Simpan Data
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection

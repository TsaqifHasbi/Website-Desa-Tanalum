@extends('layouts.app')

@section('title', 'Data Stunting - Infografis')

@section('content')
    <!-- Header -->
    <section class="bg-gradient-to-r from-green-600 to-green-700 py-8">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl md:text-4xl font-bold text-white">INFOGRAFIS</h1>
            <p class="text-green-100 text-lg">DESA TANALUM</p>
        </div>
    </section>

    <!-- Tab Navigation -->
    @include('infografis.partials.tabs')

    <!-- Content -->
    <section class="py-8 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="bg-white rounded-xl shadow-sm p-8">
                <h2 class="text-2xl font-bold text-green-600 mb-6">Data Stunting</h2>

                @if (isset($stuntingData) && count($stuntingData) > 0)
                    <!-- Summary Cards -->
                    <div class="grid md:grid-cols-4 gap-4 mb-8">
                        <div class="bg-green-50 rounded-xl p-6 text-center">
                            <p class="text-gray-600 mb-2">Total Balita</p>
                            <p class="text-3xl font-bold text-green-600">{{ $totalBalita ?? 0 }}</p>
                        </div>
                        <div class="bg-red-50 rounded-xl p-6 text-center">
                            <p class="text-gray-600 mb-2">Stunting</p>
                            <p class="text-3xl font-bold text-red-600">{{ $totalStunting ?? 0 }}</p>
                        </div>
                        <div class="bg-yellow-50 rounded-xl p-6 text-center">
                            <p class="text-gray-600 mb-2">Risiko Stunting</p>
                            <p class="text-3xl font-bold text-yellow-600">{{ $risikoStunting ?? 0 }}</p>
                        </div>
                        <div class="bg-blue-50 rounded-xl p-6 text-center">
                            <p class="text-gray-600 mb-2">Prevalensi</p>
                            <p class="text-3xl font-bold text-blue-600">{{ $prevalensi ?? '0%' }}</p>
                        </div>
                    </div>

                    <!-- Data Table -->
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead>
                                <tr class="bg-green-600 text-white">
                                    <th class="px-4 py-3 text-left">No</th>
                                    <th class="px-4 py-3 text-left">Nama</th>
                                    <th class="px-4 py-3 text-left">Usia</th>
                                    <th class="px-4 py-3 text-left">Status Gizi</th>
                                    <th class="px-4 py-3 text-left">Keterangan</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y">
                                @foreach ($stuntingData as $index => $data)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-3">{{ $index + 1 }}</td>
                                        <td class="px-4 py-3">{{ $data->nama }}</td>
                                        <td class="px-4 py-3">{{ $data->usia }} bulan</td>
                                        <td class="px-4 py-3">
                                            <span
                                                class="px-2 py-1 rounded-full text-xs font-medium 
                                            {{ $data->status == 'normal' ? 'bg-green-100 text-green-700' : '' }}
                                            {{ $data->status == 'risiko' ? 'bg-yellow-100 text-yellow-700' : '' }}
                                            {{ $data->status == 'stunting' ? 'bg-red-100 text-red-700' : '' }}">
                                                {{ ucfirst($data->status) }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-gray-600">{{ $data->keterangan ?? '-' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="text-center py-16">
                        <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                        </div>
                        <p class="text-gray-500 text-lg">Belum Ada Data</p>
                        <p class="text-gray-400 mt-2">Data stunting belum tersedia untuk desa ini.</p>
                    </div>
                @endif
            </div>

            <!-- Information Card -->
            <div class="mt-8 bg-blue-50 rounded-xl p-6">
                <h3 class="text-lg font-semibold text-blue-800 mb-3">
                    <i class="fas fa-info-circle mr-2"></i>
                    Tentang Stunting
                </h3>
                <p class="text-blue-700 mb-4">
                    Stunting adalah kondisi gagal tumbuh pada anak balita akibat kekurangan gizi kronis sehingga anak
                    terlalu pendek untuk usianya.
                    Kekurangan gizi terjadi sejak bayi dalam kandungan dan pada masa awal setelah bayi lahir, tetapi kondisi
                    stunting baru nampak setelah bayi berusia 2 tahun.
                </p>
                <div class="grid md:grid-cols-3 gap-4">
                    <div class="bg-white rounded-lg p-4">
                        <h4 class="font-semibold text-gray-800 mb-2">Penyebab</h4>
                        <ul class="text-sm text-gray-600 space-y-1">
                            <li>• Kurang gizi kronis</li>
                            <li>• Infeksi berulang</li>
                            <li>• Stimulasi psikososial tidak memadai</li>
                        </ul>
                    </div>
                    <div class="bg-white rounded-lg p-4">
                        <h4 class="font-semibold text-gray-800 mb-2">Dampak</h4>
                        <ul class="text-sm text-gray-600 space-y-1">
                            <li>• Gangguan perkembangan otak</li>
                            <li>• Kecerdasan berkurang</li>
                            <li>• Daya tahan tubuh lemah</li>
                        </ul>
                    </div>
                    <div class="bg-white rounded-lg p-4">
                        <h4 class="font-semibold text-gray-800 mb-2">Pencegahan</h4>
                        <ul class="text-sm text-gray-600 space-y-1">
                            <li>• ASI eksklusif 6 bulan</li>
                            <li>• MPASI berkualitas</li>
                            <li>• Pemantauan pertumbuhan rutin</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

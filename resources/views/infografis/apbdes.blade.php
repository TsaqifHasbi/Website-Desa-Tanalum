@extends('layouts.app')

@section('title', 'APBDes')

@section('content')
    <!-- Hero Section -->
    <section class="relative py-20 bg-gradient-to-r from-green-600 to-green-700">
        <div class="container mx-auto px-4">
            <div class="text-center text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">APBDes {{ $apbdes->tahun ?? date('Y') }}</h1>
                <p class="text-lg text-green-100">Anggaran Pendapatan dan Belanja {{ $profil->nama_desa ?? 'Desa Tanalum' }}
                </p>
            </div>
        </div>
    </section>

    <!-- Breadcrumb -->
    <div class="bg-white shadow-sm">
        <div class="container mx-auto px-4">
            <nav class="flex items-center space-x-2 py-4 text-sm">
                <a href="{{ route('home') }}" class="text-gray-500 hover:text-primary-600">Beranda</a>
                <span class="text-gray-400">/</span>
                <a href="{{ route('infografis.index') }}" class="text-gray-500 hover:text-primary-600">Infografis</a>
                <span class="text-gray-400">/</span>
                <span class="text-primary-600 font-medium">APBDes</span>
            </nav>
        </div>
    </div>

    <!-- Tab Navigation -->
    @include('infografis.partials.tabs')

    <!-- Content -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            @if ($apbdes)
                <!-- Year Selector -->
                @if ($years->count() > 1)
                    <div class="mb-8 flex justify-center" data-aos="fade-up">
                        <div class="inline-flex bg-white rounded-lg shadow-sm p-1">
                            @foreach ($years as $year)
                                <a href="{{ route('infografis.apbdes', ['tahun' => $year->tahun]) }}"
                                    class="px-6 py-2 rounded-md transition {{ $apbdes->tahun == $year->tahun ? 'bg-green-600 text-white' : 'text-gray-600 hover:bg-gray-100' }}">
                                    {{ $year->tahun }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Stats Overview -->
                <div class="grid md:grid-cols-3 gap-6 mb-12">
                    <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-6 text-white"
                        data-aos="fade-up">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                <i class="fas fa-arrow-down text-xl"></i>
                            </div>
                            <span class="text-green-100 text-sm">Pendapatan</span>
                        </div>
                        <p class="text-3xl font-bold">Rp {{ number_format($apbdes->total_pendapatan) }}</p>
                    </div>
                    <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-2xl p-6 text-white" data-aos="fade-up"
                        data-aos-delay="100">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                <i class="fas fa-arrow-up text-xl"></i>
                            </div>
                            <span class="text-red-100 text-sm">Belanja</span>
                        </div>
                        <p class="text-3xl font-bold">Rp {{ number_format($apbdes->total_belanja) }}</p>
                    </div>
                    <div class="bg-gradient-to-br {{ $apbdes->surplus_defisit >= 0 ? 'from-blue-500 to-blue-600' : 'from-orange-500 to-orange-600' }} rounded-2xl p-6 text-white"
                        data-aos="fade-up" data-aos-delay="200">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                <i class="fas fa-balance-scale text-xl"></i>
                            </div>
                            <span
                                class="text-white/80 text-sm">{{ $apbdes->surplus_defisit >= 0 ? 'Surplus' : 'Defisit' }}</span>
                        </div>
                        <p class="text-3xl font-bold">Rp {{ number_format(abs($apbdes->surplus_defisit)) }}</p>
                    </div>
                </div>

                <div class="grid lg:grid-cols-2 gap-8">
                    <!-- Pendapatan Chart -->
                    <div class="bg-white rounded-2xl shadow-sm p-6" data-aos="fade-up">
                        <h3 class="text-xl font-bold text-gray-800 mb-6">Rincian Pendapatan</h3>
                        <canvas id="pendapatanChart" height="300"></canvas>
                        @if ($apbdes->rincian_pendapatan)
                            <div class="mt-6 space-y-2">
                                @foreach ($apbdes->rincian_pendapatan as $item => $nilai)
                                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                        <span class="text-gray-600">{{ $item }}</span>
                                        <span class="font-semibold text-gray-800">Rp {{ number_format($nilai) }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Belanja Chart -->
                    <div class="bg-white rounded-2xl shadow-sm p-6" data-aos="fade-up" data-aos-delay="100">
                        <h3 class="text-xl font-bold text-gray-800 mb-6">Rincian Belanja</h3>
                        <canvas id="belanjaChart" height="300"></canvas>
                        @if ($apbdes->rincian_belanja)
                            <div class="mt-6 space-y-2">
                                @foreach ($apbdes->rincian_belanja as $item => $nilai)
                                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                        <span class="text-gray-600">{{ $item }}</span>
                                        <span class="font-semibold text-gray-800">Rp {{ number_format($nilai) }}</span>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Pembiayaan -->
                @if ($apbdes->pembiayaan_penerimaan || $apbdes->pembiayaan_pengeluaran)
                    <div class="bg-white rounded-2xl shadow-sm p-6 mt-8" data-aos="fade-up">
                        <h3 class="text-xl font-bold text-gray-800 mb-6">Pembiayaan</h3>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <h4 class="font-semibold text-gray-700 mb-4">Penerimaan Pembiayaan</h4>
                                <p class="text-2xl font-bold text-green-600">Rp
                                    {{ number_format($apbdes->pembiayaan_penerimaan ?? 0) }}</p>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-700 mb-4">Pengeluaran Pembiayaan</h4>
                                <p class="text-2xl font-bold text-red-600">Rp
                                    {{ number_format($apbdes->pembiayaan_pengeluaran ?? 0) }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <p class="text-sm text-gray-500 mt-6 text-center">
                    <i class="fas fa-info-circle mr-1"></i>
                    Data terakhir diperbarui: {{ $apbdes->updated_at->format('d M Y') }}
                </p>
            @else
                <div class="text-center py-16 bg-white rounded-2xl shadow-sm">
                    <i class="fas fa-money-bill-wave text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">Data Belum Tersedia</h3>
                    <p class="text-gray-500">Data APBDes belum diinput ke dalam sistem.</p>
                </div>
            @endif
        </div>
    </section>
@endsection

@push('scripts')
    @if ($apbdes)
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Pendapatan Chart
                @php
                    $pendapatan = $apbdes->rincian_pendapatan ?? ['Dana Desa' => $apbdes->total_pendapatan];
                @endphp
                new Chart(document.getElementById('pendapatanChart'), {
                    type: 'doughnut',
                    data: {
                        labels: {!! json_encode(array_keys($pendapatan)) !!},
                        datasets: [{
                            data: {!! json_encode(array_values($pendapatan)) !!},
                            backgroundColor: ['#22C55E', '#3B82F6', '#F59E0B', '#EF4444', '#8B5CF6',
                                '#EC4899'
                            ],
                            borderWidth: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });

                // Belanja Chart
                @php
                    $belanja = $apbdes->rincian_belanja ?? ['Belanja Desa' => $apbdes->total_belanja];
                @endphp
                new Chart(document.getElementById('belanjaChart'), {
                    type: 'doughnut',
                    data: {
                        labels: {!! json_encode(array_keys($belanja)) !!},
                        datasets: [{
                            data: {!! json_encode(array_values($belanja)) !!},
                            backgroundColor: ['#EF4444', '#F59E0B', '#3B82F6', '#22C55E', '#8B5CF6',
                                '#EC4899'
                            ],
                            borderWidth: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });
            });
        </script>
    @endif
@endpush

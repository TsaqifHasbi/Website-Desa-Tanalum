@extends('layouts.app')

@section('title', 'Data Penduduk')

@section('content')
    <!-- Hero Section -->
    <section class="relative py-20 bg-gradient-to-r from-blue-600 to-blue-700">
        <div class="container mx-auto px-4">
            <div class="text-center text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Data Penduduk</h1>
                <p class="text-lg text-blue-100">Statistik Kependudukan {{ $profil->nama_desa ?? 'Desa Tanalum' }}</p>
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
                <span class="text-primary-600 font-medium">Data Penduduk</span>
            </nav>
        </div>
    </div>

    <!-- Content -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            @if ($penduduk)
                <!-- Stats Overview -->
                <div class="grid md:grid-cols-4 gap-6 mb-12">
                    <div class="bg-white rounded-2xl shadow-sm p-6 text-center" data-aos="fade-up">
                        <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-users text-2xl text-blue-600"></i>
                        </div>
                        <p class="text-3xl font-bold text-gray-800">{{ number_format($penduduk->jumlah_penduduk) }}</p>
                        <p class="text-gray-500 mt-1">Total Penduduk</p>
                    </div>
                    <div class="bg-white rounded-2xl shadow-sm p-6 text-center" data-aos="fade-up" data-aos-delay="100">
                        <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-male text-2xl text-blue-600"></i>
                        </div>
                        <p class="text-3xl font-bold text-gray-800">{{ number_format($penduduk->jumlah_laki_laki) }}</p>
                        <p class="text-gray-500 mt-1">Laki-laki</p>
                    </div>
                    <div class="bg-white rounded-2xl shadow-sm p-6 text-center" data-aos="fade-up" data-aos-delay="200">
                        <div class="w-14 h-14 bg-pink-100 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-female text-2xl text-pink-600"></i>
                        </div>
                        <p class="text-3xl font-bold text-gray-800">{{ number_format($penduduk->jumlah_perempuan) }}</p>
                        <p class="text-gray-500 mt-1">Perempuan</p>
                    </div>
                    <div class="bg-white rounded-2xl shadow-sm p-6 text-center" data-aos="fade-up" data-aos-delay="300">
                        <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-home text-2xl text-green-600"></i>
                        </div>
                        <p class="text-3xl font-bold text-gray-800">{{ number_format($penduduk->jumlah_kk) }}</p>
                        <p class="text-gray-500 mt-1">Kepala Keluarga</p>
                    </div>
                </div>

                <div class="grid lg:grid-cols-2 gap-8">
                    <!-- Gender Distribution -->
                    <div class="bg-white rounded-2xl shadow-sm p-6" data-aos="fade-up">
                        <h3 class="text-xl font-bold text-gray-800 mb-6">Berdasarkan Jenis Kelamin</h3>
                        <div class="flex items-center justify-center mb-6">
                            <canvas id="genderChart" width="300" height="300"></canvas>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="flex items-center">
                                <div class="w-4 h-4 bg-blue-500 rounded-full mr-2"></div>
                                <span class="text-gray-600">Laki-laki:
                                    {{ number_format($penduduk->jumlah_laki_laki) }}</span>
                            </div>
                            <div class="flex items-center">
                                <div class="w-4 h-4 bg-pink-500 rounded-full mr-2"></div>
                                <span class="text-gray-600">Perempuan:
                                    {{ number_format($penduduk->jumlah_perempuan) }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Age Distribution -->
                    <div class="bg-white rounded-2xl shadow-sm p-6" data-aos="fade-up" data-aos-delay="100">
                        <h3 class="text-xl font-bold text-gray-800 mb-6">Berdasarkan Kelompok Umur</h3>
                        <canvas id="ageChart" height="250"></canvas>
                    </div>

                    <!-- Education Distribution -->
                    <div class="bg-white rounded-2xl shadow-sm p-6" data-aos="fade-up" data-aos-delay="200">
                        <h3 class="text-xl font-bold text-gray-800 mb-6">Berdasarkan Pendidikan</h3>
                        <canvas id="educationChart" height="250"></canvas>
                    </div>

                    <!-- Occupation Distribution -->
                    <div class="bg-white rounded-2xl shadow-sm p-6" data-aos="fade-up" data-aos-delay="300">
                        <h3 class="text-xl font-bold text-gray-800 mb-6">Berdasarkan Pekerjaan</h3>
                        <canvas id="occupationChart" height="250"></canvas>
                    </div>
                </div>

                <!-- Data Table -->
                <div class="bg-white rounded-2xl shadow-sm p-6 mt-8" data-aos="fade-up">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Detail Data Penduduk</h3>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="border-b border-gray-100">
                                    <th class="py-3 px-4 font-semibold text-gray-600">Kategori</th>
                                    <th class="py-3 px-4 font-semibold text-gray-600 text-right">Jumlah</th>
                                    <th class="py-3 px-4 font-semibold text-gray-600 text-right">Persentase</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                <tr>
                                    <td class="py-3 px-4 text-gray-800">Laki-laki</td>
                                    <td class="py-3 px-4 text-right text-gray-800">
                                        {{ number_format($penduduk->jumlah_laki_laki) }}</td>
                                    <td class="py-3 px-4 text-right text-gray-500">
                                        {{ $penduduk->jumlah_penduduk > 0 ? number_format(($penduduk->jumlah_laki_laki / $penduduk->jumlah_penduduk) * 100, 1) : 0 }}%
                                    </td>
                                </tr>
                                <tr>
                                    <td class="py-3 px-4 text-gray-800">Perempuan</td>
                                    <td class="py-3 px-4 text-right text-gray-800">
                                        {{ number_format($penduduk->jumlah_perempuan) }}</td>
                                    <td class="py-3 px-4 text-right text-gray-500">
                                        {{ $penduduk->jumlah_penduduk > 0 ? number_format(($penduduk->jumlah_perempuan / $penduduk->jumlah_penduduk) * 100, 1) : 0 }}%
                                    </td>
                                </tr>
                                <tr class="bg-gray-50 font-semibold">
                                    <td class="py-3 px-4 text-gray-800">Total</td>
                                    <td class="py-3 px-4 text-right text-gray-800">
                                        {{ number_format($penduduk->jumlah_penduduk) }}</td>
                                    <td class="py-3 px-4 text-right text-gray-500">100%</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <p class="text-sm text-gray-500 mt-4">
                        <i class="fas fa-info-circle mr-1"></i>
                        Data terakhir diperbarui: {{ $penduduk->updated_at->format('d M Y') }}
                    </p>
                </div>
            @else
                <div class="text-center py-16 bg-white rounded-2xl shadow-sm">
                    <i class="fas fa-users text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">Data Belum Tersedia</h3>
                    <p class="text-gray-500">Data penduduk belum diinput ke dalam sistem.</p>
                </div>
            @endif
        </div>
    </section>
@endsection

@push('scripts')
    @if ($penduduk)
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Gender Chart
                new Chart(document.getElementById('genderChart'), {
                    type: 'doughnut',
                    data: {
                        labels: ['Laki-laki', 'Perempuan'],
                        datasets: [{
                            data: [{{ $penduduk->jumlah_laki_laki }},
                                {{ $penduduk->jumlah_perempuan }}
                            ],
                            backgroundColor: ['#3B82F6', '#EC4899'],
                            borderWidth: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: true,
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });

                // Age Chart
                @php
                    $usia = $penduduk->penduduk_by_usia ?? [];
                @endphp
                new Chart(document.getElementById('ageChart'), {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode(array_keys($usia)) !!},
                        datasets: [{
                            label: 'Jumlah',
                            data: {!! json_encode(array_values($usia)) !!},
                            backgroundColor: '#3B82F6'
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });

                // Education Chart
                @php
                    $pendidikan = $penduduk->penduduk_by_pendidikan ?? [];
                @endphp
                new Chart(document.getElementById('educationChart'), {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode(array_keys($pendidikan)) !!},
                        datasets: [{
                            label: 'Jumlah',
                            data: {!! json_encode(array_values($pendidikan)) !!},
                            backgroundColor: '#22C55E'
                        }]
                    },
                    options: {
                        responsive: true,
                        indexAxis: 'y',
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });

                // Occupation Chart
                @php
                    $pekerjaan = $penduduk->penduduk_by_pekerjaan ?? [];
                @endphp
                new Chart(document.getElementById('occupationChart'), {
                    type: 'bar',
                    data: {
                        labels: {!! json_encode(array_keys($pekerjaan)) !!},
                        datasets: [{
                            label: 'Jumlah',
                            data: {!! json_encode(array_values($pekerjaan)) !!},
                            backgroundColor: '#F59E0B'
                        }]
                    },
                    options: {
                        responsive: true,
                        indexAxis: 'y',
                        plugins: {
                            legend: {
                                display: false
                            }
                        }
                    }
                });
            });
        </script>
    @endif
@endpush

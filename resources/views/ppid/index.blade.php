@extends('layouts.main')

@section('title', 'PPID - Pejabat Pengelola Informasi dan Dokumentasi')

@section('content')
    <!-- Hero Section -->
    <section class="relative py-12 bg-gradient-to-r from-green-600 to-green-700">
        <div class="container mx-auto px-4">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-8">
                <!-- Text Content -->
                <div class="text-white max-w-2xl">
                    <h1 class="text-4xl md:text-5xl font-bold mb-4">PPID</h1>
                    <p class="text-lg text-green-100 mb-6">
                        Pejabat Pengelola Informasi dan Dokumentasi (PPID) adalah pejabat yang bertanggung jawab di bidang
                        penyimpanan, pendokumentasian, penyediaan, dan/atau pelayanan informasi di badan publik.
                    </p>
                    <a href="{{ route('ppid.dasar-hukum') }}"
                        class="inline-flex items-center px-6 py-3 border-2 border-white text-white hover:bg-white hover:text-green-700 rounded-lg transition-colors font-medium">
                        Dasar Hukum PPID
                    </a>
                </div>

                <!-- Category Cards -->
                <div class="grid grid-cols-3 gap-4">
                    <a href="{{ route('ppid.berkala') }}"
                        class="bg-white rounded-xl p-6 text-center hover:shadow-lg transition-shadow">
                        <div class="w-16 h-16 mx-auto mb-3 bg-green-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-calendar-check text-green-600 text-2xl"></i>
                        </div>
                        <h3 class="font-bold text-gray-800 text-xs">INFORMASI SECARA BERKALA</h3>
                    </a>
                    <a href="{{ route('ppid.serta-merta') }}"
                        class="bg-white rounded-xl p-6 text-center hover:shadow-lg transition-shadow">
                        <div class="w-16 h-16 mx-auto mb-3 bg-orange-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-bullhorn text-orange-600 text-2xl"></i>
                        </div>
                        <h3 class="font-bold text-gray-800 text-xs">INFORMASI SERTA MERTA</h3>
                    </a>
                    <a href="{{ route('ppid.setiap-saat') }}"
                        class="bg-white rounded-xl p-6 text-center hover:shadow-lg transition-shadow">
                        <div class="w-16 h-16 mx-auto mb-3 bg-blue-100 rounded-full flex items-center justify-center">
                            <i class="fas fa-clock text-blue-600 text-2xl"></i>
                        </div>
                        <h3 class="font-bold text-gray-800 text-xs">INFORMASI SETIAP SAAT</h3>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest Documents Section -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="mb-8">
                <h2 class="text-3xl font-bold text-green-600 mb-2">INFORMASI PUBLIK TERBARU</h2>
                <p class="text-gray-600">Update terakhir {{ now()->diffForHumans() }}</p>
            </div>

            @php
                $allDokumens = collect()
                    ->merge($dokumenBerkala ?? collect())
                    ->merge($dokumenSertaMerta ?? collect())
                    ->merge($dokumenSetiapSaat ?? collect())
                    ->sortByDesc('created_at')
                    ->take(5);
            @endphp

            <div class="space-y-4">
                @forelse($allDokumens as $dokumen)
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                        <div class="p-6 flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                            <div class="flex-1">
                                <h3 class="text-lg font-bold text-gray-800 uppercase mb-2">
                                    {{ $dokumen->nama }}
                                </h3>
                                <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500">
                                    <span class="inline-flex items-center">
                                        <i class="fas fa-folder mr-2 text-green-600"></i>
                                        {{ $dokumen->kategori->nama ?? 'Informasi Publik' }}
                                    </span>
                                    <span class="inline-flex items-center">
                                        <i class="fas fa-calendar mr-2 text-green-600"></i>
                                        {{ $dokumen->tanggal_dokumen ? $dokumen->tanggal_dokumen->translatedFormat('l, d F Y') : $dokumen->created_at->translatedFormat('l, d F Y') }}
                                    </span>
                                </div>
                            </div>
                            <div class="flex flex-col gap-2 lg:items-end">
                                <a href="{{ route('ppid.view', $dokumen->slug) }}" target="_blank"
                                    class="inline-flex items-center justify-center px-6 py-2 border border-green-600 text-green-600 hover:bg-green-50 rounded-lg transition-colors">
                                    <i class="fas fa-eye mr-2"></i>
                                    Lihat Berkas
                                </a>
                                <a href="{{ route('ppid.download', $dokumen->slug) }}"
                                    class="inline-flex items-center justify-center px-6 py-2 text-gray-600 hover:text-green-600 transition-colors">
                                    <i class="fas fa-download mr-2"></i>
                                    Unduh ({{ $dokumen->download_count ?? 0 }}x)
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-xl shadow-sm p-12 text-center">
                        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-folder-open text-gray-400 text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Belum Ada Dokumen</h3>
                        <p class="text-gray-600">Dokumen informasi publik belum tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Request Information CTA -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <div class="bg-white rounded-2xl shadow-sm p-8 text-center">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Ingin mengajukan permohonan informasi?</h2>
                <a href="{{ route('ppid.permohonan') }}"
                    class="inline-flex items-center px-8 py-3 border-2 border-green-600 text-green-600 hover:bg-green-600 hover:text-white rounded-lg transition-colors font-medium">
                    Ajukan Permohonan Informasi
                </a>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script>
        // Any additional scripts for PPID page
    </script>
@endpush

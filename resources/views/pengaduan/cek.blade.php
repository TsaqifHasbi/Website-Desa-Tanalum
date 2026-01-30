@extends('layouts.main')

@section('title', 'Status Pengaduan - Desa Tanalum')

@section('content')
    <!-- Hero Section -->
    <section class="relative py-16 bg-gradient-to-r from-green-600 to-green-700">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="container mx-auto px-4 relative">
            <div class="text-center text-white">
                <h1 class="text-3xl md:text-4xl font-bold mb-4">Status Pengaduan</h1>
                <p class="text-green-100">Nomor Tiket: <span class="font-semibold">{{ $pengaduan->nomor_tiket }}</span></p>
            </div>
        </div>
    </section>

    <!-- Success Message -->
    @if (session('success'))
        <div class="container mx-auto px-4 -mt-6 relative z-10">
            <div class="max-w-3xl mx-auto">
                <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-xl">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-xl mr-3"></i>
                        <p>{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <!-- Main Content -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto">
                <!-- Status Card -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-8">
                    <div class="p-6 border-b border-gray-200">
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                            <div>
                                <h2 class="text-xl font-bold text-gray-800">{{ $pengaduan->judul }}</h2>
                                <p class="text-sm text-gray-500 mt-1">
                                    Dibuat pada {{ $pengaduan->created_at->format('d F Y, H:i') }} WIB
                                </p>
                            </div>
                            <div>
                                @php
                                    $statusColors = [
                                        'menunggu' => 'bg-yellow-100 text-yellow-800',
                                        'diproses' => 'bg-blue-100 text-blue-800',
                                        'ditanggapi' => 'bg-purple-100 text-purple-800',
                                        'selesai' => 'bg-green-100 text-green-800',
                                        'ditolak' => 'bg-red-100 text-red-800',
                                    ];
                                    $statusLabels = [
                                        'menunggu' => 'Menunggu Verifikasi',
                                        'diproses' => 'Sedang Diproses',
                                        'ditanggapi' => 'Sudah Ditanggapi',
                                        'selesai' => 'Selesai',
                                        'ditolak' => 'Ditolak',
                                    ];
                                @endphp
                                <span
                                    class="px-4 py-2 rounded-full text-sm font-medium {{ $statusColors[$pengaduan->status] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ $statusLabels[$pengaduan->status] ?? ucfirst($pengaduan->status) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Timeline -->
                    <div class="p-6">
                        <h3 class="font-semibold text-gray-800 mb-4">Progress Pengaduan</h3>
                        <div class="relative">
                            <!-- Timeline Line -->
                            <div class="absolute left-4 top-4 bottom-4 w-0.5 bg-gray-200"></div>

                            <!-- Step 1: Dibuat -->
                            <div class="relative flex items-start mb-6">
                                <div class="w-8 h-8 rounded-full bg-green-500 flex items-center justify-center z-10">
                                    <i class="fas fa-check text-white text-xs"></i>
                                </div>
                                <div class="ml-4">
                                    <h4 class="font-medium text-gray-800">Pengaduan Dibuat</h4>
                                    <p class="text-sm text-gray-500">{{ $pengaduan->created_at->format('d M Y, H:i') }}</p>
                                </div>
                            </div>

                            <!-- Step 2: Diverifikasi -->
                            <div class="relative flex items-start mb-6">
                                <div
                                    class="w-8 h-8 rounded-full {{ in_array($pengaduan->status, ['diproses', 'ditanggapi', 'selesai']) ? 'bg-green-500' : 'bg-gray-300' }} flex items-center justify-center z-10">
                                    @if (in_array($pengaduan->status, ['diproses', 'ditanggapi', 'selesai']))
                                        <i class="fas fa-check text-white text-xs"></i>
                                    @else
                                        <span class="text-white text-xs font-bold">2</span>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <h4
                                        class="font-medium {{ in_array($pengaduan->status, ['diproses', 'ditanggapi', 'selesai']) ? 'text-gray-800' : 'text-gray-400' }}">
                                        Diverifikasi</h4>
                                    <p class="text-sm text-gray-500">
                                        @if (in_array($pengaduan->status, ['diproses', 'ditanggapi', 'selesai']))
                                            Pengaduan telah diverifikasi
                                        @else
                                            Menunggu verifikasi petugas
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <!-- Step 3: Diproses -->
                            <div class="relative flex items-start mb-6">
                                <div
                                    class="w-8 h-8 rounded-full {{ in_array($pengaduan->status, ['ditanggapi', 'selesai']) ? 'bg-green-500' : ($pengaduan->status == 'diproses' ? 'bg-blue-500' : 'bg-gray-300') }} flex items-center justify-center z-10">
                                    @if (in_array($pengaduan->status, ['ditanggapi', 'selesai']))
                                        <i class="fas fa-check text-white text-xs"></i>
                                    @elseif($pengaduan->status == 'diproses')
                                        <i class="fas fa-spinner fa-spin text-white text-xs"></i>
                                    @else
                                        <span class="text-white text-xs font-bold">3</span>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <h4
                                        class="font-medium {{ in_array($pengaduan->status, ['diproses', 'ditanggapi', 'selesai']) ? 'text-gray-800' : 'text-gray-400' }}">
                                        Sedang Diproses</h4>
                                    <p class="text-sm text-gray-500">
                                        @if ($pengaduan->status == 'diproses')
                                            Pengaduan sedang ditindaklanjuti
                                        @elseif(in_array($pengaduan->status, ['ditanggapi', 'selesai']))
                                            Pengaduan telah diproses
                                        @else
                                            Belum diproses
                                        @endif
                                    </p>
                                </div>
                            </div>

                            <!-- Step 4: Selesai -->
                            <div class="relative flex items-start">
                                <div
                                    class="w-8 h-8 rounded-full {{ $pengaduan->status == 'selesai' ? 'bg-green-500' : 'bg-gray-300' }} flex items-center justify-center z-10">
                                    @if ($pengaduan->status == 'selesai')
                                        <i class="fas fa-check text-white text-xs"></i>
                                    @else
                                        <span class="text-white text-xs font-bold">4</span>
                                    @endif
                                </div>
                                <div class="ml-4">
                                    <h4
                                        class="font-medium {{ $pengaduan->status == 'selesai' ? 'text-gray-800' : 'text-gray-400' }}">
                                        Selesai</h4>
                                    <p class="text-sm text-gray-500">
                                        @if ($pengaduan->status == 'selesai')
                                            Pengaduan telah selesai ditangani
                                        @else
                                            Menunggu penyelesaian
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Detail Pengaduan -->
                <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-8">
                    <div class="p-6 border-b border-gray-200">
                        <h3 class="font-semibold text-gray-800">Detail Pengaduan</h3>
                    </div>
                    <div class="p-6">
                        <div class="grid grid-cols-2 gap-4 mb-6">
                            <div>
                                <p class="text-sm text-gray-500">Kategori</p>
                                <p class="font-medium text-gray-800">{{ $pengaduan->kategori ?? 'Umum' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Nama Pelapor</p>
                                <p class="font-medium text-gray-800">{{ $pengaduan->nama }}</p>
                            </div>
                            @if ($pengaduan->email)
                                <div>
                                    <p class="text-sm text-gray-500">Email</p>
                                    <p class="font-medium text-gray-800">{{ $pengaduan->email }}</p>
                                </div>
                            @endif
                            @if ($pengaduan->telepon)
                                <div>
                                    <p class="text-sm text-gray-500">Telepon</p>
                                    <p class="font-medium text-gray-800">{{ $pengaduan->telepon }}</p>
                                </div>
                            @endif
                        </div>

                        <div class="border-t border-gray-200 pt-6">
                            <p class="text-sm text-gray-500 mb-2">Isi Pengaduan</p>
                            <div class="prose prose-sm max-w-none text-gray-700">
                                {!! nl2br(e($pengaduan->isi_pengaduan)) !!}
                            </div>
                        </div>

                        @if ($pengaduan->lampiran && count($pengaduan->lampiran) > 0)
                            <div class="border-t border-gray-200 pt-6 mt-6">
                                <p class="text-sm text-gray-500 mb-3">Lampiran</p>
                                <div class="flex flex-wrap gap-3">
                                    @foreach ($pengaduan->lampiran as $index => $file)
                                        <a href="{{ Storage::url($file) }}" target="_blank"
                                            class="inline-flex items-center px-4 py-2 bg-gray-100 rounded-lg hover:bg-gray-200 transition-colors">
                                            <i class="fas fa-file mr-2 text-gray-500"></i>
                                            <span class="text-sm text-gray-700">Lampiran {{ $index + 1 }}</span>
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Tanggapan -->
                @if ($pengaduan->tanggapan)
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden mb-8">
                        <div class="p-6 border-b border-gray-200 bg-green-50">
                            <div class="flex items-center">
                                <div class="w-10 h-10 bg-green-100 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-reply text-green-600"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800">Tanggapan Petugas</h3>
                                    @if ($pengaduan->ditanggapi_pada)
                                        <p class="text-sm text-gray-500">
                                            {{ $pengaduan->ditanggapi_pada->format('d F Y, H:i') }} WIB</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="p-6">
                            <div class="prose prose-sm max-w-none text-gray-700">
                                {!! nl2br(e($pengaduan->tanggapan)) !!}
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Actions -->
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <a href="{{ route('pengaduan.index') }}"
                        class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali
                    </a>
                    <button onclick="window.print()"
                        class="inline-flex items-center justify-center px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">
                        <i class="fas fa-print mr-2"></i>
                        Cetak
                    </button>
                    <a href="{{ route('pengaduan.create') }}"
                        class="inline-flex items-center justify-center px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                        <i class="fas fa-plus mr-2"></i>
                        Buat Pengaduan Baru
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
    <style>
        @media print {

            header,
            footer,
            nav,
            .no-print {
                display: none !important;
            }

            body {
                background: white !important;
            }

            .shadow-sm {
                box-shadow: none !important;
            }
        }
    </style>
@endpush

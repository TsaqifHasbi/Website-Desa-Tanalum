@extends('layouts.app')

@section('title', 'Cek Penerima Bansos')

@section('content')
    <!-- Hero Section -->
    <section class="relative py-20 bg-gradient-to-r from-teal-600 to-teal-700">
        <div class="container mx-auto px-4">
            <div class="text-center text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Cek Penerima Bansos</h1>
                <p class="text-lg text-teal-100">Cek status penerimaan bantuan sosial Anda</p>
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
                <span class="text-primary-600 font-medium">Cek Bansos</span>
            </nav>
        </div>
    </div>

    <!-- Content -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-2xl mx-auto">
                <!-- Search Form -->
                <div class="bg-white rounded-2xl shadow-sm p-8 mb-8" data-aos="fade-up">
                    <div class="text-center mb-8">
                        <div class="w-16 h-16 bg-teal-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-search text-2xl text-teal-600"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-2">Masukkan NIK Anda</h2>
                        <p class="text-gray-600">Cek apakah Anda terdaftar sebagai penerima bantuan sosial</p>
                    </div>

                    <form action="{{ route('cek-bansos') }}" method="GET">
                        <div class="mb-6">
                            <label for="nik" class="block text-sm font-medium text-gray-700 mb-2">Nomor Induk
                                Kependudukan (NIK)</label>
                            <input type="text" name="nik" id="nik" value="{{ request('nik') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-teal-500 transition text-center text-lg tracking-wider"
                                placeholder="Masukkan 16 digit NIK" maxlength="16" pattern="[0-9]{16}" required>
                            <p class="text-sm text-gray-500 mt-2">NIK dapat ditemukan di KTP/KK Anda</p>
                        </div>
                        <button type="submit"
                            class="w-full py-3 bg-teal-600 hover:bg-teal-700 text-white font-semibold rounded-lg transition">
                            <i class="fas fa-search mr-2"></i>
                            Cek Status
                        </button>
                    </form>
                </div>

                <!-- Results -->
                @if (request('nik'))
                    @if ($penerima && $penerima->count() > 0)
                        <div class="bg-white rounded-2xl shadow-sm overflow-hidden" data-aos="fade-up">
                            <div class="bg-green-500 text-white p-6 text-center">
                                <div
                                    class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-check text-3xl"></i>
                                </div>
                                <h3 class="text-xl font-bold">Data Ditemukan</h3>
                                <p class="text-green-100">Anda terdaftar sebagai penerima bantuan sosial</p>
                            </div>

                            <div class="p-6">
                                <div class="mb-6 pb-6 border-b border-gray-100">
                                    <p class="text-sm text-gray-500">Nama</p>
                                    <p class="text-lg font-semibold text-gray-800">{{ $penerima->first()->nama }}</p>
                                </div>

                                <h4 class="font-semibold text-gray-800 mb-4">Bantuan yang Diterima:</h4>
                                <div class="space-y-4">
                                    @foreach ($penerima as $item)
                                        <div class="flex items-start p-4 bg-gray-50 rounded-xl">
                                            <div
                                                class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                                <i class="fas fa-gift text-green-600"></i>
                                            </div>
                                            <div class="flex-1">
                                                <h5 class="font-semibold text-gray-800">
                                                    {{ $item->dataBansos->nama_program ?? 'Program Bantuan' }}</h5>
                                                <p class="text-sm text-gray-500">Tahun {{ $item->dataBansos->tahun ?? '-' }}
                                                </p>
                                                @if ($item->nominal)
                                                    <p class="text-sm text-green-600 font-medium mt-1">Nominal: Rp
                                                        {{ number_format($item->nominal) }}</p>
                                                @endif
                                            </div>
                                            <span
                                                class="px-3 py-1 text-xs font-medium rounded-full {{ $item->status_penerima === 'aktif' ? 'bg-green-100 text-green-700' : 'bg-gray-100 text-gray-600' }}">
                                                {{ ucfirst($item->status_penerima) }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="bg-white rounded-2xl shadow-sm overflow-hidden" data-aos="fade-up">
                            <div class="bg-gray-500 text-white p-6 text-center">
                                <div
                                    class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-times text-3xl"></i>
                                </div>
                                <h3 class="text-xl font-bold">Data Tidak Ditemukan</h3>
                                <p class="text-gray-200">NIK {{ request('nik') }} tidak terdaftar sebagai penerima bantuan
                                    sosial</p>
                            </div>

                            <div class="p-6">
                                <p class="text-gray-600 text-center mb-6">Jika Anda merasa berhak menerima bantuan sosial,
                                    silakan hubungi kantor desa untuk informasi lebih lanjut.</p>
                                <div class="flex justify-center">
                                    <a href="{{ route('pengaduan.create') }}"
                                        class="inline-flex items-center px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-lg transition">
                                        <i class="fas fa-paper-plane mr-2"></i>
                                        Ajukan Pengaduan
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endif
                @endif

                <!-- Info -->
                <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 mt-8" data-aos="fade-up">
                    <div class="flex items-start">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                            <i class="fas fa-info text-blue-600"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-blue-800 mb-2">Informasi Penting</h4>
                            <ul class="text-sm text-blue-700 space-y-1">
                                <li>• Data yang ditampilkan sesuai dengan data yang tercatat di sistem desa</li>
                                <li>• Jika ada ketidaksesuaian data, silakan hubungi kantor desa</li>
                                <li>• NIK yang digunakan harus sesuai dengan KTP/KK</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@extends('layouts.public')

@section('title', 'Pemerintahan Desa - Desa Tanalum')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-green-600 to-green-800 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-3xl md:text-4xl font-bold mb-4">Pemerintahan Desa</h1>
                <p class="text-lg text-green-100">Struktur Organisasi Pemerintah Desa Tanalum</p>
            </div>
        </div>
    </section>

    <!-- Kepala Desa Section -->
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Kepala Desa</h2>
                <div class="w-24 h-1 bg-green-600 mx-auto rounded-full"></div>
            </div>

            <div class="max-w-md mx-auto">
                <div
                    class="bg-gradient-to-br from-green-50 to-white rounded-2xl shadow-xl overflow-hidden border border-green-100">
                    <div class="bg-gradient-to-r from-green-600 to-green-700 h-24"></div>
                    <div class="-mt-12 px-6 pb-6">
                        <div class="relative">
                            <img src="{{ $kepalaDesa->foto ?? asset('images/default-avatar.png') }}" alt="Kepala Desa"
                                class="w-24 h-24 rounded-full border-4 border-white shadow-lg mx-auto object-cover bg-gray-200">
                        </div>
                        <div class="text-center mt-4">
                            <h3 class="text-xl font-bold text-gray-800">{{ $kepalaDesa->nama ?? 'Nama Kepala Desa' }}</h3>
                            <p class="text-green-600 font-medium">Kepala Desa Tanalum</p>
                            <p class="text-gray-500 text-sm mt-2">
                                Periode: {{ $kepalaDesa->periode ?? '2021 - 2027' }}
                            </p>
                        </div>
                        <div class="mt-6 space-y-2 text-sm">
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-id-card w-5 text-green-600"></i>
                                <span class="ml-3">NIP: {{ $kepalaDesa->nip ?? '-' }}</span>
                            </div>
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-phone w-5 text-green-600"></i>
                                <span class="ml-3">{{ $kepalaDesa->telepon ?? '0812-xxxx-xxxx' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Perangkat Desa Section -->
    <section class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Perangkat Desa</h2>
                <div class="w-24 h-1 bg-green-600 mx-auto rounded-full"></div>
                <p class="text-gray-600 mt-4">Tim yang bertugas membantu Kepala Desa dalam menjalankan pemerintahan</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @forelse($perangkatDesa ?? [] as $perangkat)
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow group">
                        <div class="h-2 bg-gradient-to-r from-green-500 to-green-600"></div>
                        <div class="p-6">
                            <div class="relative mb-4">
                                <img src="{{ $perangkat->foto ?? asset('images/default-avatar.png') }}"
                                    alt="{{ $perangkat->nama }}"
                                    class="w-20 h-20 rounded-full mx-auto object-cover border-2 border-green-100 group-hover:border-green-300 transition-colors bg-gray-200">
                            </div>
                            <div class="text-center">
                                <h3 class="font-semibold text-gray-800">{{ $perangkat->nama }}</h3>
                                <p class="text-green-600 text-sm font-medium">{{ $perangkat->jabatan }}</p>
                                @if ($perangkat->pendidikan)
                                    <p class="text-gray-500 text-xs mt-2">
                                        <i class="fas fa-graduation-cap mr-1"></i>
                                        {{ $perangkat->pendidikan }}
                                    </p>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Default Perangkat -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow group">
                        <div class="h-2 bg-gradient-to-r from-green-500 to-green-600"></div>
                        <div class="p-6">
                            <div class="relative mb-4">
                                <div class="w-20 h-20 rounded-full mx-auto bg-gray-200 flex items-center justify-center">
                                    <i class="fas fa-user text-gray-400 text-2xl"></i>
                                </div>
                            </div>
                            <div class="text-center">
                                <h3 class="font-semibold text-gray-800">Nama Sekretaris</h3>
                                <p class="text-green-600 text-sm font-medium">Sekretaris Desa</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow group">
                        <div class="h-2 bg-gradient-to-r from-green-500 to-green-600"></div>
                        <div class="p-6">
                            <div class="relative mb-4">
                                <div class="w-20 h-20 rounded-full mx-auto bg-gray-200 flex items-center justify-center">
                                    <i class="fas fa-user text-gray-400 text-2xl"></i>
                                </div>
                            </div>
                            <div class="text-center">
                                <h3 class="font-semibold text-gray-800">Nama Kaur</h3>
                                <p class="text-green-600 text-sm font-medium">Kaur Keuangan</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow group">
                        <div class="h-2 bg-gradient-to-r from-green-500 to-green-600"></div>
                        <div class="p-6">
                            <div class="relative mb-4">
                                <div class="w-20 h-20 rounded-full mx-auto bg-gray-200 flex items-center justify-center">
                                    <i class="fas fa-user text-gray-400 text-2xl"></i>
                                </div>
                            </div>
                            <div class="text-center">
                                <h3 class="font-semibold text-gray-800">Nama Kaur</h3>
                                <p class="text-green-600 text-sm font-medium">Kaur Umum</p>
                            </div>
                        </div>
                    </div>
                    <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow group">
                        <div class="h-2 bg-gradient-to-r from-green-500 to-green-600"></div>
                        <div class="p-6">
                            <div class="relative mb-4">
                                <div class="w-20 h-20 rounded-full mx-auto bg-gray-200 flex items-center justify-center">
                                    <i class="fas fa-user text-gray-400 text-2xl"></i>
                                </div>
                            </div>
                            <div class="text-center">
                                <h3 class="font-semibold text-gray-800">Nama Kasi</h3>
                                <p class="text-green-600 text-sm font-medium">Kasi Pemerintahan</p>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- BPD Section -->
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Badan Permusyawaratan Desa (BPD)</h2>
                <div class="w-24 h-1 bg-blue-600 mx-auto rounded-full"></div>
                <p class="text-gray-600 mt-4">Lembaga yang menjalankan fungsi pemerintahan yang anggotanya merupakan wakil
                    dari penduduk desa</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
                @forelse($bpd ?? [] as $anggota)
                    <div
                        class="bg-gradient-to-br from-blue-50 to-white rounded-xl shadow-md overflow-hidden border border-blue-100 hover:shadow-lg transition-shadow">
                        <div class="p-5">
                            <div class="relative mb-4">
                                <img src="{{ $anggota->foto ?? asset('images/default-avatar.png') }}"
                                    alt="{{ $anggota->nama }}"
                                    class="w-16 h-16 rounded-full mx-auto object-cover border-2 border-blue-200 bg-gray-200">
                            </div>
                            <div class="text-center">
                                <h3 class="font-semibold text-gray-800 text-sm">{{ $anggota->nama }}</h3>
                                <p class="text-blue-600 text-xs font-medium mt-1">{{ $anggota->jabatan }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Default BPD -->
                    <div
                        class="bg-gradient-to-br from-blue-50 to-white rounded-xl shadow-md overflow-hidden border border-blue-100">
                        <div class="p-5">
                            <div class="relative mb-4">
                                <div class="w-16 h-16 rounded-full mx-auto bg-gray-200 flex items-center justify-center">
                                    <i class="fas fa-user text-gray-400 text-xl"></i>
                                </div>
                            </div>
                            <div class="text-center">
                                <h3 class="font-semibold text-gray-800 text-sm">Nama Ketua BPD</h3>
                                <p class="text-blue-600 text-xs font-medium mt-1">Ketua</p>
                            </div>
                        </div>
                    </div>
                    <div
                        class="bg-gradient-to-br from-blue-50 to-white rounded-xl shadow-md overflow-hidden border border-blue-100">
                        <div class="p-5">
                            <div class="relative mb-4">
                                <div class="w-16 h-16 rounded-full mx-auto bg-gray-200 flex items-center justify-center">
                                    <i class="fas fa-user text-gray-400 text-xl"></i>
                                </div>
                            </div>
                            <div class="text-center">
                                <h3 class="font-semibold text-gray-800 text-sm">Nama Wakil</h3>
                                <p class="text-blue-600 text-xs font-medium mt-1">Wakil Ketua</p>
                            </div>
                        </div>
                    </div>
                    <div
                        class="bg-gradient-to-br from-blue-50 to-white rounded-xl shadow-md overflow-hidden border border-blue-100">
                        <div class="p-5">
                            <div class="relative mb-4">
                                <div class="w-16 h-16 rounded-full mx-auto bg-gray-200 flex items-center justify-center">
                                    <i class="fas fa-user text-gray-400 text-xl"></i>
                                </div>
                            </div>
                            <div class="text-center">
                                <h3 class="font-semibold text-gray-800 text-sm">Nama Sekretaris</h3>
                                <p class="text-blue-600 text-xs font-medium mt-1">Sekretaris</p>
                            </div>
                        </div>
                    </div>
                    <div
                        class="bg-gradient-to-br from-blue-50 to-white rounded-xl shadow-md overflow-hidden border border-blue-100">
                        <div class="p-5">
                            <div class="relative mb-4">
                                <div class="w-16 h-16 rounded-full mx-auto bg-gray-200 flex items-center justify-center">
                                    <i class="fas fa-user text-gray-400 text-xl"></i>
                                </div>
                            </div>
                            <div class="text-center">
                                <h3 class="font-semibold text-gray-800 text-sm">Nama Anggota</h3>
                                <p class="text-blue-600 text-xs font-medium mt-1">Anggota</p>
                            </div>
                        </div>
                    </div>
                    <div
                        class="bg-gradient-to-br from-blue-50 to-white rounded-xl shadow-md overflow-hidden border border-blue-100">
                        <div class="p-5">
                            <div class="relative mb-4">
                                <div class="w-16 h-16 rounded-full mx-auto bg-gray-200 flex items-center justify-center">
                                    <i class="fas fa-user text-gray-400 text-xl"></i>
                                </div>
                            </div>
                            <div class="text-center">
                                <h3 class="font-semibold text-gray-800 text-sm">Nama Anggota</h3>
                                <p class="text-blue-600 text-xs font-medium mt-1">Anggota</p>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Lembaga Kemasyarakatan Section -->
    <section class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Lembaga Kemasyarakatan Desa</h2>
                <div class="w-24 h-1 bg-orange-500 mx-auto rounded-full"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- LPM -->
                <div
                    class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow border-t-4 border-orange-500">
                    <div class="bg-orange-100 rounded-full w-14 h-14 flex items-center justify-center mb-4">
                        <i class="fas fa-users text-orange-600 text-xl"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 mb-2">LPM</h3>
                    <p class="text-gray-600 text-sm mb-3">Lembaga Pemberdayaan Masyarakat</p>
                    <p class="text-sm text-gray-500">
                        <span class="font-medium">Ketua:</span> {{ $lpm->ketua ?? 'Nama Ketua LPM' }}
                    </p>
                </div>

                <!-- PKK -->
                <div
                    class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow border-t-4 border-pink-500">
                    <div class="bg-pink-100 rounded-full w-14 h-14 flex items-center justify-center mb-4">
                        <i class="fas fa-female text-pink-600 text-xl"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 mb-2">PKK</h3>
                    <p class="text-gray-600 text-sm mb-3">Pemberdayaan Kesejahteraan Keluarga</p>
                    <p class="text-sm text-gray-500">
                        <span class="font-medium">Ketua:</span> {{ $pkk->ketua ?? 'Nama Ketua PKK' }}
                    </p>
                </div>

                <!-- Karang Taruna -->
                <div
                    class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow border-t-4 border-yellow-500">
                    <div class="bg-yellow-100 rounded-full w-14 h-14 flex items-center justify-center mb-4">
                        <i class="fas fa-user-friends text-yellow-600 text-xl"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 mb-2">Karang Taruna</h3>
                    <p class="text-gray-600 text-sm mb-3">Organisasi Kepemudaan</p>
                    <p class="text-sm text-gray-500">
                        <span class="font-medium">Ketua:</span> {{ $karangTaruna->ketua ?? 'Nama Ketua Karang Taruna' }}
                    </p>
                </div>

                <!-- RT/RW -->
                <div
                    class="bg-white rounded-xl shadow-md p-6 hover:shadow-lg transition-shadow border-t-4 border-green-500">
                    <div class="bg-green-100 rounded-full w-14 h-14 flex items-center justify-center mb-4">
                        <i class="fas fa-home text-green-600 text-xl"></i>
                    </div>
                    <h3 class="font-bold text-gray-800 mb-2">RT/RW</h3>
                    <p class="text-gray-600 text-sm mb-3">Rukun Tetangga / Rukun Warga</p>
                    <p class="text-sm text-gray-500">
                        <span class="font-medium">Jumlah RT:</span> {{ $jumlahRT ?? '5' }} RT
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Organization Chart -->
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12">
                <h2 class="text-2xl font-bold text-gray-800 mb-2">Struktur Organisasi</h2>
                <div class="w-24 h-1 bg-green-600 mx-auto rounded-full"></div>
            </div>

            <div class="bg-gray-50 rounded-2xl p-8 overflow-x-auto">
                <div class="min-w-[800px]">
                    <!-- Struktur Visual -->
                    <div class="flex flex-col items-center">
                        <!-- Level 1: Kepala Desa -->
                        <div
                            class="bg-gradient-to-r from-green-600 to-green-700 text-white px-8 py-4 rounded-xl shadow-lg">
                            <p class="font-bold text-center">KEPALA DESA</p>
                            <p class="text-sm text-center text-green-100">{{ $kepalaDesa->nama ?? 'Nama Kepala Desa' }}
                            </p>
                        </div>

                        <!-- Connector -->
                        <div class="w-0.5 h-8 bg-green-400"></div>

                        <!-- Level 2: Sekretaris -->
                        <div class="bg-green-500 text-white px-6 py-3 rounded-xl shadow-md">
                            <p class="font-semibold text-center">SEKRETARIS DESA</p>
                        </div>

                        <!-- Connector -->
                        <div class="w-0.5 h-8 bg-green-400"></div>

                        <!-- Horizontal Line -->
                        <div class="w-[600px] h-0.5 bg-green-400 relative">
                            <!-- Vertical connectors down -->
                            <div class="absolute left-0 top-0 w-0.5 h-8 bg-green-400"></div>
                            <div class="absolute left-1/4 top-0 w-0.5 h-8 bg-green-400"></div>
                            <div class="absolute left-1/2 top-0 w-0.5 h-8 bg-green-400 -translate-x-1/2"></div>
                            <div class="absolute left-3/4 top-0 w-0.5 h-8 bg-green-400"></div>
                            <div class="absolute right-0 top-0 w-0.5 h-8 bg-green-400"></div>
                        </div>

                        <!-- Level 3: Kaur & Kasi -->
                        <div class="flex justify-between w-[600px] mt-8">
                            <div class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow text-center text-sm">
                                <p class="font-medium">Kaur TU & Umum</p>
                            </div>
                            <div class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow text-center text-sm">
                                <p class="font-medium">Kaur Keuangan</p>
                            </div>
                            <div class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow text-center text-sm">
                                <p class="font-medium">Kaur Perencanaan</p>
                            </div>
                            <div class="bg-purple-500 text-white px-4 py-2 rounded-lg shadow text-center text-sm">
                                <p class="font-medium">Kasi Pemerintahan</p>
                            </div>
                            <div class="bg-purple-500 text-white px-4 py-2 rounded-lg shadow text-center text-sm">
                                <p class="font-medium">Kasi Kesejahteraan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Download Button -->
            <div class="text-center mt-8">
                <a href="#"
                    class="inline-flex items-center px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors shadow-md">
                    <i class="fas fa-download mr-2"></i>
                    Download Struktur Organisasi (PDF)
                </a>
            </div>
        </div>
    </section>

    <!-- Visi Misi Section -->
    <section class="py-12 bg-gradient-to-br from-green-600 to-green-800 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                <!-- Visi -->
                <div>
                    <div class="flex items-center mb-6">
                        <div class="bg-white/20 rounded-full p-3 mr-4">
                            <i class="fas fa-eye text-2xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold">Visi</h2>
                    </div>
                    <div class="bg-white/10 backdrop-blur rounded-xl p-6">
                        <p class="text-lg italic leading-relaxed">
                            "{{ $visi ?? 'Terwujudnya Desa Tanalum yang Maju, Mandiri, Sejahtera dan Berkeadilan Berlandaskan Nilai-nilai Keagamaan dan Kearifan Lokal' }}"
                        </p>
                    </div>
                </div>

                <!-- Misi -->
                <div>
                    <div class="flex items-center mb-6">
                        <div class="bg-white/20 rounded-full p-3 mr-4">
                            <i class="fas fa-bullseye text-2xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold">Misi</h2>
                    </div>
                    <div class="bg-white/10 backdrop-blur rounded-xl p-6">
                        <ul class="space-y-3">
                            @forelse($misi ?? [] as $index => $item)
                                <li class="flex items-start">
                                    <span
                                        class="bg-white text-green-700 rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold mr-3 mt-0.5 flex-shrink-0">{{ $index + 1 }}</span>
                                    <span>{{ $item }}</span>
                                </li>
                            @empty
                                <li class="flex items-start">
                                    <span
                                        class="bg-white text-green-700 rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold mr-3 mt-0.5 flex-shrink-0">1</span>
                                    <span>Meningkatkan kualitas pelayanan publik kepada masyarakat</span>
                                </li>
                                <li class="flex items-start">
                                    <span
                                        class="bg-white text-green-700 rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold mr-3 mt-0.5 flex-shrink-0">2</span>
                                    <span>Meningkatkan pembangunan infrastruktur desa</span>
                                </li>
                                <li class="flex items-start">
                                    <span
                                        class="bg-white text-green-700 rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold mr-3 mt-0.5 flex-shrink-0">3</span>
                                    <span>Mengembangkan ekonomi kerakyatan berbasis potensi lokal</span>
                                </li>
                                <li class="flex items-start">
                                    <span
                                        class="bg-white text-green-700 rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold mr-3 mt-0.5 flex-shrink-0">4</span>
                                    <span>Meningkatkan kualitas sumber daya manusia</span>
                                </li>
                                <li class="flex items-start">
                                    <span
                                        class="bg-white text-green-700 rounded-full w-6 h-6 flex items-center justify-center text-sm font-bold mr-3 mt-0.5 flex-shrink-0">5</span>
                                    <span>Melestarikan nilai-nilai budaya dan kearifan lokal</span>
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@extends('layouts.app')

@section('title', 'Data Geografis')

@section('content')
    <!-- Hero Section -->
    <section class="relative py-20 bg-gradient-to-r from-primary-600 to-primary-700">
        <div class="container mx-auto px-4">
            <div class="text-center text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Data Geografis</h1>
                <p class="text-lg text-primary-100">{{ $profil->nama_desa ?? 'Desa Tanalum' }}</p>
            </div>
        </div>
    </section>

    <!-- Breadcrumb -->
    <div class="bg-white shadow-sm">
        <div class="container mx-auto px-4">
            <nav class="flex items-center space-x-2 py-4 text-sm">
                <a href="{{ route('home') }}" class="text-gray-500 hover:text-primary-600">Beranda</a>
                <span class="text-gray-400">/</span>
                <a href="{{ route('profil.index') }}" class="text-gray-500 hover:text-primary-600">Profil Desa</a>
                <span class="text-gray-400">/</span>
                <span class="text-primary-600 font-medium">Data Geografis</span>
            </nav>
        </div>
    </div>

    <!-- Content -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Peta -->
                    <div class="bg-white rounded-2xl shadow-sm overflow-hidden" data-aos="fade-up">
                        <div class="p-6 border-b border-gray-100">
                            <h2 class="text-xl font-bold text-gray-800">Peta Lokasi</h2>
                        </div>
                        <div class="aspect-video">
                            @if ($profil->peta_desa)
                                {!! $profil->peta_desa !!}
                            @elseif($profil->latitude && $profil->longitude)
                                <iframe
                                    src="https://maps.google.com/maps?q={{ $profil->latitude }},{{ $profil->longitude }}&z=14&output=embed"
                                    class="w-full h-full" loading="lazy" allowfullscreen>
                                </iframe>
                            @else
                                <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                                    <div class="text-center text-gray-500">
                                        <i class="fas fa-map text-4xl mb-2"></i>
                                        <p>Peta belum tersedia</p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Batas Wilayah -->
                    <div class="bg-white rounded-2xl shadow-sm p-6" data-aos="fade-up">
                        <h2 class="text-xl font-bold text-gray-800 mb-6">Batas Wilayah</h2>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                                    <i class="fas fa-arrow-up text-blue-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Utara</p>
                                    <p class="font-medium text-gray-800">{{ $profil->batas_utara ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                                    <i class="fas fa-arrow-right text-green-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Timur</p>
                                    <p class="font-medium text-gray-800">{{ $profil->batas_timur ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mr-4">
                                    <i class="fas fa-arrow-down text-yellow-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Selatan</p>
                                    <p class="font-medium text-gray-800">{{ $profil->batas_selatan ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mr-4">
                                    <i class="fas fa-arrow-left text-red-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Barat</p>
                                    <p class="font-medium text-gray-800">{{ $profil->batas_barat ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Topografi -->
                    @if ($profil->topografi || $profil->iklim)
                        <div class="bg-white rounded-2xl shadow-sm p-6" data-aos="fade-up">
                            <h2 class="text-xl font-bold text-gray-800 mb-6">Kondisi Alam</h2>
                            <div class="grid md:grid-cols-2 gap-6">
                                @if ($profil->topografi)
                                    <div>
                                        <h3 class="font-semibold text-gray-700 mb-2">Topografi</h3>
                                        <p class="text-gray-600">{{ $profil->topografi }}</p>
                                    </div>
                                @endif
                                @if ($profil->iklim)
                                    <div>
                                        <h3 class="font-semibold text-gray-700 mb-2">Iklim</h3>
                                        <p class="text-gray-600">{{ $profil->iklim }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Data Wilayah -->
                    <div class="bg-white rounded-2xl shadow-sm p-6" data-aos="fade-left">
                        <h3 class="font-bold text-gray-800 mb-4">Data Wilayah</h3>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center pb-3 border-b border-gray-100">
                                <span class="text-gray-500">Luas Wilayah</span>
                                <span
                                    class="font-semibold text-gray-800">{{ $profil->luas_wilayah ? number_format($profil->luas_wilayah, 2) . ' Km²' : '-' }}</span>
                            </div>
                            <div class="flex justify-between items-center pb-3 border-b border-gray-100">
                                <span class="text-gray-500">Jumlah Dusun</span>
                                <span class="font-semibold text-gray-800">{{ $profil->jumlah_dusun ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between items-center pb-3 border-b border-gray-100">
                                <span class="text-gray-500">Jumlah RT</span>
                                <span class="font-semibold text-gray-800">{{ $profil->jumlah_rt ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-500">Jumlah RW</span>
                                <span class="font-semibold text-gray-800">{{ $profil->jumlah_rw ?? '-' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Koordinat -->
                    @if ($profil->latitude && $profil->longitude)
                        <div class="bg-white rounded-2xl shadow-sm p-6" data-aos="fade-left" data-aos-delay="100">
                            <h3 class="font-bold text-gray-800 mb-4">Koordinat</h3>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-500">Latitude</span>
                                    <span class="font-mono text-gray-800">{{ $profil->latitude }}</span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-500">Longitude</span>
                                    <span class="font-mono text-gray-800">{{ $profil->longitude }}</span>
                                </div>
                            </div>
                            <a href="https://www.google.com/maps?q={{ $profil->latitude }},{{ $profil->longitude }}"
                                target="_blank"
                                class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium mt-4 text-sm">
                                <i class="fas fa-external-link-alt mr-2"></i>
                                Buka di Google Maps
                            </a>
                        </div>
                    @endif

                    <!-- Administrasi -->
                    <div class="bg-white rounded-2xl shadow-sm p-6" data-aos="fade-left" data-aos-delay="200">
                        <h3 class="font-bold text-gray-800 mb-4">Wilayah Administrasi</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center pb-3 border-b border-gray-100">
                                <span class="text-gray-500">Provinsi</span>
                                <span
                                    class="font-medium text-gray-800">{{ $profil->provinsi ?? 'Kalimantan Timur' }}</span>
                            </div>
                            <div class="flex justify-between items-center pb-3 border-b border-gray-100">
                                <span class="text-gray-500">Kabupaten</span>
                                <span
                                    class="font-medium text-gray-800">{{ $profil->kabupaten ?? 'Kutai Kartanegara' }}</span>
                            </div>
                            <div class="flex justify-between items-center pb-3 border-b border-gray-100">
                                <span class="text-gray-500">Kecamatan</span>
                                <span class="font-medium text-gray-800">{{ $profil->kecamatan ?? 'Marang Kayu' }}</span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-500">Kode Pos</span>
                                <span class="font-medium text-gray-800">{{ $profil->kode_pos ?? '-' }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <div class="flex flex-col sm:flex-row justify-between gap-4 mt-12">
                <a href="{{ route('profil.struktur') }}"
                    class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-gray-700 hover:bg-gray-50 rounded-lg transition">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Struktur Organisasi
                </a>
                <a href="{{ route('infografis.index') }}"
                    class="inline-flex items-center justify-center px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white rounded-lg transition">
                    Infografis
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>
@endsection

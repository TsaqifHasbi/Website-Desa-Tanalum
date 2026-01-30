@extends('layouts.app')

@section('title', 'Infografis')

@section('content')
    <!-- Hero Section -->
    <section class="relative py-20 bg-gradient-to-r from-primary-600 to-primary-700">
        <div class="container mx-auto px-4">
            <div class="text-center text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Infografis</h1>
                <p class="text-lg text-primary-100">Data & Statistik {{ $profil->nama_desa ?? 'Desa Tanalum' }}</p>
            </div>
        </div>
    </section>

    <!-- Breadcrumb -->
    <div class="bg-white shadow-sm">
        <div class="container mx-auto px-4">
            <nav class="flex items-center space-x-2 py-4 text-sm">
                <a href="{{ route('home') }}" class="text-gray-500 hover:text-primary-600">Beranda</a>
                <span class="text-gray-400">/</span>
                <span class="text-primary-600 font-medium">Infografis</span>
            </nav>
        </div>
    </div>

    <!-- Content -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Penduduk -->
                <a href="{{ route('infografis.penduduk') }}" class="group" data-aos="fade-up">
                    <div class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-lg transition">
                        <div class="h-48 bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center">
                            <i class="fas fa-users text-6xl text-white/50"></i>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-xl font-bold text-gray-800">Data Penduduk</h3>
                                <i
                                    class="fas fa-arrow-right text-primary-600 opacity-0 group-hover:opacity-100 transition"></i>
                            </div>
                            <p class="text-gray-600">Statistik kependudukan meliputi jumlah penduduk berdasarkan usia, jenis
                                kelamin, pendidikan, dan pekerjaan.</p>
                        </div>
                    </div>
                </a>

                <!-- APBDes -->
                <a href="{{ route('infografis.apbdes') }}" class="group" data-aos="fade-up" data-aos-delay="100">
                    <div class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-lg transition">
                        <div class="h-48 bg-gradient-to-br from-green-500 to-green-600 flex items-center justify-center">
                            <i class="fas fa-money-bill-wave text-6xl text-white/50"></i>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-xl font-bold text-gray-800">APBDes</h3>
                                <i
                                    class="fas fa-arrow-right text-primary-600 opacity-0 group-hover:opacity-100 transition"></i>
                            </div>
                            <p class="text-gray-600">Anggaran Pendapatan dan Belanja Desa meliputi rincian pendapatan,
                                belanja, dan pembiayaan desa.</p>
                        </div>
                    </div>
                </a>

                <!-- IDM -->
                <a href="{{ route('infografis.idm') }}" class="group" data-aos="fade-up" data-aos-delay="200">
                    <div class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-lg transition">
                        <div class="h-48 bg-gradient-to-br from-purple-500 to-purple-600 flex items-center justify-center">
                            <i class="fas fa-chart-line text-6xl text-white/50"></i>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-xl font-bold text-gray-800">IDM</h3>
                                <i
                                    class="fas fa-arrow-right text-primary-600 opacity-0 group-hover:opacity-100 transition"></i>
                            </div>
                            <p class="text-gray-600">Indeks Desa Membangun (IDM) menunjukkan status dan tingkat perkembangan
                                desa.</p>
                        </div>
                    </div>
                </a>

                <!-- SDGs -->
                <a href="{{ route('infografis.sdgs') }}" class="group" data-aos="fade-up" data-aos-delay="300">
                    <div class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-lg transition">
                        <div class="h-48 bg-gradient-to-br from-orange-500 to-orange-600 flex items-center justify-center">
                            <i class="fas fa-globe text-6xl text-white/50"></i>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-xl font-bold text-gray-800">SDGs Desa</h3>
                                <i
                                    class="fas fa-arrow-right text-primary-600 opacity-0 group-hover:opacity-100 transition"></i>
                            </div>
                            <p class="text-gray-600">Sustainable Development Goals (SDGs) Desa dan capaian tujuan
                                pembangunan berkelanjutan.</p>
                        </div>
                    </div>
                </a>

                <!-- Stunting -->
                <a href="{{ route('infografis.stunting') }}" class="group" data-aos="fade-up" data-aos-delay="400">
                    <div class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-lg transition">
                        <div class="h-48 bg-gradient-to-br from-red-500 to-red-600 flex items-center justify-center">
                            <i class="fas fa-child text-6xl text-white/50"></i>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-xl font-bold text-gray-800">Data Stunting</h3>
                                <i
                                    class="fas fa-arrow-right text-primary-600 opacity-0 group-hover:opacity-100 transition"></i>
                            </div>
                            <p class="text-gray-600">Data dan upaya penanganan stunting di desa untuk kesehatan anak.</p>
                        </div>
                    </div>
                </a>

                <!-- Bansos -->
                <a href="{{ route('infografis.bansos') }}" class="group" data-aos="fade-up" data-aos-delay="500">
                    <div class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-lg transition">
                        <div class="h-48 bg-gradient-to-br from-pink-500 to-pink-600 flex items-center justify-center">
                            <i class="fas fa-hand-holding-heart text-6xl text-white/50"></i>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center justify-between mb-3">
                                <h3 class="text-xl font-bold text-gray-800">Bantuan Sosial</h3>
                                <i
                                    class="fas fa-arrow-right text-primary-600 opacity-0 group-hover:opacity-100 transition"></i>
                            </div>
                            <p class="text-gray-600">Data penerima bantuan sosial dan program-program kesejahteraan
                                masyarakat.</p>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Cek Bansos CTA -->
            <div class="mt-12 bg-gradient-to-r from-teal-500 to-teal-600 rounded-2xl p-8 text-white" data-aos="fade-up">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <div class="text-center md:text-left mb-6 md:mb-0">
                        <h3 class="text-2xl font-bold mb-2">Cek Status Penerima Bantuan Sosial</h3>
                        <p class="text-teal-100">Masukkan NIK untuk mengecek status penerimaan bantuan sosial Anda.</p>
                    </div>
                    <a href="{{ route('cek-bansos') }}"
                        class="px-8 py-3 bg-white text-teal-600 hover:bg-gray-100 font-semibold rounded-lg transition">
                        <i class="fas fa-search mr-2"></i>
                        Cek Sekarang
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

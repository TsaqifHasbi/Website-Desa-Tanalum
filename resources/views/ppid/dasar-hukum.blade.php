@extends('layouts.main')

@section('title', 'Dasar Hukum PPID - Desa Tanalum')

@section('content')
    <!-- Hero Section -->
    <section class="relative py-20 bg-gradient-to-r from-blue-600 to-blue-700">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="container mx-auto px-4 relative">
            <div class="text-center text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Dasar Hukum PPID</h1>
                <p class="text-xl text-blue-100 mb-4">Regulasi dan Peraturan Keterbukaan Informasi Publik</p>
                <!-- Breadcrumb -->
                <nav class="flex items-center justify-center text-sm">
                    <a href="{{ route('home') }}" class="text-blue-200 hover:text-white">Beranda</a>
                    <span class="mx-2 text-blue-300">/</span>
                    <a href="{{ route('ppid.index') }}" class="text-blue-200 hover:text-white">PPID</a>
                    <span class="mx-2 text-blue-300">/</span>
                    <span class="text-white">Dasar Hukum</span>
                </nav>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <!-- Undang-Undang -->
                <div class="bg-white rounded-xl shadow-sm p-8 mb-8">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-gavel text-blue-600 text-xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800">Undang-Undang</h2>
                    </div>

                    <div class="space-y-4">
                        <div class="p-4 bg-gray-50 rounded-lg border-l-4 border-blue-500">
                            <h4 class="font-semibold text-gray-800 mb-2">UU No. 14 Tahun 2008</h4>
                            <p class="text-gray-600 text-sm mb-2">Tentang Keterbukaan Informasi Publik</p>
                            <p class="text-gray-500 text-xs">
                                Undang-undang ini mengatur tentang hak setiap orang untuk memperoleh informasi publik,
                                kewajiban badan publik menyediakan dan melayani permintaan informasi, serta pembatasan
                                terhadap akses informasi.
                            </p>
                        </div>

                        <div class="p-4 bg-gray-50 rounded-lg border-l-4 border-blue-500">
                            <h4 class="font-semibold text-gray-800 mb-2">UU No. 6 Tahun 2014</h4>
                            <p class="text-gray-600 text-sm mb-2">Tentang Desa</p>
                            <p class="text-gray-500 text-xs">
                                Undang-undang ini mengatur tentang penyelenggaraan pemerintahan desa, pelaksanaan
                                pembangunan desa, pembinaan kemasyarakatan desa, dan pemberdayaan masyarakat desa.
                            </p>
                        </div>

                        <div class="p-4 bg-gray-50 rounded-lg border-l-4 border-blue-500">
                            <h4 class="font-semibold text-gray-800 mb-2">UU No. 25 Tahun 2009</h4>
                            <p class="text-gray-600 text-sm mb-2">Tentang Pelayanan Publik</p>
                            <p class="text-gray-500 text-xs">
                                Mengatur tentang prinsip-prinsip pelayanan publik yang harus dipenuhi oleh
                                penyelenggara pelayanan publik termasuk pemerintah desa.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Peraturan Pemerintah -->
                <div class="bg-white rounded-xl shadow-sm p-8 mb-8">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-green-100 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-landmark text-green-600 text-xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800">Peraturan Pemerintah</h2>
                    </div>

                    <div class="space-y-4">
                        <div class="p-4 bg-gray-50 rounded-lg border-l-4 border-green-500">
                            <h4 class="font-semibold text-gray-800 mb-2">PP No. 61 Tahun 2010</h4>
                            <p class="text-gray-600 text-sm mb-2">Tentang Pelaksanaan UU KIP</p>
                            <p class="text-gray-500 text-xs">
                                Peraturan pelaksanaan Undang-Undang Nomor 14 Tahun 2008 tentang Keterbukaan
                                Informasi Publik.
                            </p>
                        </div>

                        <div class="p-4 bg-gray-50 rounded-lg border-l-4 border-green-500">
                            <h4 class="font-semibold text-gray-800 mb-2">PP No. 43 Tahun 2014</h4>
                            <p class="text-gray-600 text-sm mb-2">Tentang Peraturan Pelaksanaan UU Desa</p>
                            <p class="text-gray-500 text-xs">
                                Peraturan pelaksanaan Undang-Undang Nomor 6 Tahun 2014 tentang Desa yang telah
                                diubah beberapa kali.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Peraturan Komisi Informasi -->
                <div class="bg-white rounded-xl shadow-sm p-8 mb-8">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-yellow-100 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-balance-scale text-yellow-600 text-xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800">Peraturan Komisi Informasi</h2>
                    </div>

                    <div class="space-y-4">
                        <div class="p-4 bg-gray-50 rounded-lg border-l-4 border-yellow-500">
                            <h4 class="font-semibold text-gray-800 mb-2">Perki No. 1 Tahun 2021</h4>
                            <p class="text-gray-600 text-sm mb-2">Tentang Standar Layanan Informasi Publik</p>
                            <p class="text-gray-500 text-xs">
                                Standar layanan dan prosedur penyelesaian sengketa informasi publik di
                                Komisi Informasi.
                            </p>
                        </div>

                        <div class="p-4 bg-gray-50 rounded-lg border-l-4 border-yellow-500">
                            <h4 class="font-semibold text-gray-800 mb-2">Perki No. 2 Tahun 2022</h4>
                            <p class="text-gray-600 text-sm mb-2">Tentang Tata Cara Penyelesaian Sengketa Informasi</p>
                            <p class="text-gray-500 text-xs">
                                Mengatur prosedur ajudikasi dan mediasi sengketa informasi publik.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Peraturan Daerah -->
                <div class="bg-white rounded-xl shadow-sm p-8 mb-8">
                    <div class="flex items-center mb-6">
                        <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-scroll text-purple-600 text-xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800">Peraturan Daerah</h2>
                    </div>

                    <div class="space-y-4">
                        <div class="p-4 bg-gray-50 rounded-lg border-l-4 border-purple-500">
                            <h4 class="font-semibold text-gray-800 mb-2">Perda Kabupaten Kutai Kartanegara</h4>
                            <p class="text-gray-600 text-sm mb-2">Tentang Keterbukaan Informasi Publik di Daerah</p>
                            <p class="text-gray-500 text-xs">
                                Peraturan daerah yang mengatur implementasi keterbukaan informasi publik
                                di tingkat kabupaten termasuk pemerintah desa.
                            </p>
                        </div>

                        <div class="p-4 bg-gray-50 rounded-lg border-l-4 border-purple-500">
                            <h4 class="font-semibold text-gray-800 mb-2">Perdes Desa Tanalum</h4>
                            <p class="text-gray-600 text-sm mb-2">Tentang Pembentukan PPID Desa</p>
                            <p class="text-gray-500 text-xs">
                                Peraturan Desa tentang pembentukan, tugas, dan fungsi PPID Desa Tanalum.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Informasi PPID -->
                <div class="bg-blue-50 rounded-xl p-8">
                    <div class="text-center">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-info-circle text-blue-600 text-2xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Informasi PPID Desa Tanalum</h3>
                        <p class="text-gray-600 mb-6">
                            PPID Desa Tanalum berkomitmen untuk memberikan pelayanan informasi publik yang
                            transparan, akuntabel, dan bertanggung jawab sesuai dengan peraturan perundang-undangan
                            yang berlaku.
                        </p>
                        <div class="flex flex-wrap justify-center gap-4">
                            <a href="{{ route('ppid.permohonan') }}"
                                class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Ajukan Permohonan
                            </a>
                            <a href="{{ route('ppid.index') }}"
                                class="inline-flex items-center px-6 py-3 border border-blue-600 text-blue-600 rounded-lg hover:bg-blue-50 transition-colors">
                                <i class="fas fa-folder-open mr-2"></i>
                                Lihat Dokumen
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

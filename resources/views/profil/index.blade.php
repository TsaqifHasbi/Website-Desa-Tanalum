@extends('layouts.app')

@section('title', 'Profil Desa')

@section('content')
    <!-- Hero Section -->
    <section class="relative py-20 bg-gradient-to-r from-primary-600 to-primary-700">
        <div class="container mx-auto px-4">
            <div class="text-center text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Profil Desa</h1>
                <p class="text-lg text-primary-100">{{ $profil->nama_desa ?? 'Desa Tanalum' }},
                    {{ $profil->kecamatan ?? 'Kec. Marang Kayu' }}</p>
            </div>
        </div>
    </section>

    <!-- Breadcrumb -->
    <div class="bg-white shadow-sm">
        <div class="container mx-auto px-4">
            <nav class="flex items-center space-x-2 py-4 text-sm">
                <a href="{{ route('home') }}" class="text-gray-500 hover:text-primary-600">Beranda</a>
                <span class="text-gray-400">/</span>
                <span class="text-primary-600 font-medium">Profil Desa</span>
            </nav>
        </div>
    </div>

    <!-- Content -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- About -->
                    <div class="bg-white rounded-2xl shadow-sm p-8" data-aos="fade-up">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Tentang {{ $profil->nama_desa ?? 'Desa Tanalum' }}
                        </h2>
                        @if ($profil->foto_kantor)
                            <img src="{{ Storage::url($profil->foto_kantor) }}" alt="Kantor Desa"
                                class="w-full rounded-xl mb-6">
                        @endif
                        <div class="prose max-w-none text-gray-600">
                            {!! $profil->deskripsi ??
                                '<p>Desa Tanalum merupakan salah satu desa yang terletak di Kecamatan Marang Kayu, Kabupaten Kutai Kartanegara, Provinsi Kalimantan Timur.</p>' !!}
                        </div>
                    </div>

                    <!-- Sejarah -->
                    @if ($profil->sejarah)
                        <div class="bg-white rounded-2xl shadow-sm p-8" data-aos="fade-up">
                            <h2 class="text-2xl font-bold text-gray-800 mb-6">Sejarah Desa</h2>
                            <div class="prose max-w-none text-gray-600">
                                {!! $profil->sejarah !!}
                            </div>
                            <a href="{{ route('profil.sejarah') }}"
                                class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium mt-4">
                                Baca Selengkapnya <i class="fas fa-arrow-right ml-2"></i>
                            </a>
                        </div>
                    @endif

                    <!-- Visi Misi -->
                    <div class="bg-white rounded-2xl shadow-sm p-8" data-aos="fade-up">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Visi & Misi</h2>

                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-primary-600 mb-3">Visi</h3>
                            <div class="bg-primary-50 rounded-xl p-4 text-gray-700">
                                {!! $profil->visi ?? '<p>Terwujudnya Desa Tanalum yang maju, mandiri, dan sejahtera</p>' !!}
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-semibold text-primary-600 mb-3">Misi</h3>
                            <div class="bg-gray-50 rounded-xl p-4 text-gray-700">
                                {!! $profil->misi ??
                                    '<ol><li>Meningkatkan kualitas pelayanan publik</li><li>Meningkatkan kesejahteraan masyarakat</li><li>Membangun infrastruktur desa</li></ol>' !!}
                            </div>
                        </div>

                        <a href="{{ route('profil.visi-misi') }}"
                            class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium mt-4">
                            Selengkapnya <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Info Desa -->
                    <div class="bg-white rounded-2xl shadow-sm p-6" data-aos="fade-left">
                        <h3 class="font-bold text-gray-800 mb-4">Informasi Desa</h3>
                        <div class="space-y-4">
                            <div class="flex items-start space-x-3">
                                <div
                                    class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-map-marker-alt text-primary-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Alamat</p>
                                    <p class="font-medium text-gray-800">
                                        {{ $profil->alamat ?? 'Desa Tanalum, Kec. Marang Kayu, Kab. Kutai Kartanegara' }}
                                    </p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div
                                    class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-phone text-primary-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Telepon</p>
                                    <p class="font-medium text-gray-800">{{ $profil->telepon ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div
                                    class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-envelope text-primary-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Email</p>
                                    <p class="font-medium text-gray-800">{{ $profil->email ?? '-' }}</p>
                                </div>
                            </div>
                            <div class="flex items-start space-x-3">
                                <div
                                    class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-id-card text-primary-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Kode Desa</p>
                                    <p class="font-medium text-gray-800">{{ $profil->kode_desa ?? '-' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Data Geografis -->
                    <div class="bg-white rounded-2xl shadow-sm p-6" data-aos="fade-left" data-aos-delay="100">
                        <h3 class="font-bold text-gray-800 mb-4">Data Geografis</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-gray-500">Luas Wilayah</span>
                                <span
                                    class="font-medium text-gray-800">{{ $profil->luas_wilayah ? number_format($profil->luas_wilayah, 2) . ' Km²' : '-' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Jumlah Dusun</span>
                                <span class="font-medium text-gray-800">{{ $profil->jumlah_dusun ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Jumlah RT</span>
                                <span class="font-medium text-gray-800">{{ $profil->jumlah_rt ?? '-' }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-500">Jumlah RW</span>
                                <span class="font-medium text-gray-800">{{ $profil->jumlah_rw ?? '-' }}</span>
                            </div>
                        </div>
                        <a href="{{ route('profil.peta') }}"
                            class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium mt-4 text-sm">
                            Lihat Detail Geografis <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>

                    <!-- Quick Links -->
                    <div class="bg-white rounded-2xl shadow-sm p-6" data-aos="fade-left" data-aos-delay="200">
                        <h3 class="font-bold text-gray-800 mb-4">Tautan Cepat</h3>
                        <div class="space-y-2">
                            <a href="{{ route('profil.sejarah') }}"
                                class="flex items-center p-3 rounded-lg hover:bg-primary-50 transition group">
                                <i class="fas fa-history text-primary-600 mr-3"></i>
                                <span class="group-hover:text-primary-600">Sejarah Desa</span>
                            </a>
                            <a href="{{ route('profil.visi-misi') }}"
                                class="flex items-center p-3 rounded-lg hover:bg-primary-50 transition group">
                                <i class="fas fa-bullseye text-primary-600 mr-3"></i>
                                <span class="group-hover:text-primary-600">Visi & Misi</span>
                            </a>
                            <a href="{{ route('profil.struktur') }}"
                                class="flex items-center p-3 rounded-lg hover:bg-primary-50 transition group">
                                <i class="fas fa-sitemap text-primary-600 mr-3"></i>
                                <span class="group-hover:text-primary-600">Struktur Organisasi</span>
                            </a>
                            <a href="{{ route('profil.peta') }}"
                                class="flex items-center p-3 rounded-lg hover:bg-primary-50 transition group">
                                <i class="fas fa-map text-primary-600 mr-3"></i>
                                <span class="group-hover:text-primary-600">Peta & Geografis</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Aparatur Section -->
    @if ($aparaturs->count() > 0)
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12" data-aos="fade-up">
                    <h2 class="text-3xl font-bold text-gray-800">Aparatur Desa</h2>
                    <p class="text-gray-600 mt-2">Perangkat Pemerintahan {{ $profil->nama_desa ?? 'Desa Tanalum' }}</p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                    @foreach ($aparaturs->take(8) as $index => $aparatur)
                        <div class="text-center" data-aos="fade-up" data-aos-delay="{{ $index * 50 }}">
                            <div
                                class="w-32 h-32 mx-auto rounded-full overflow-hidden mb-4 border-4 border-white shadow-lg">
                                @if ($aparatur->foto)
                                    <img src="{{ Storage::url($aparatur->foto) }}" alt="{{ $aparatur->nama }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-primary-100 flex items-center justify-center">
                                        <i class="fas fa-user text-3xl text-primary-400"></i>
                                    </div>
                                @endif
                            </div>
                            <h3 class="font-semibold text-gray-800">{{ $aparatur->nama }}</h3>
                            <p class="text-sm text-gray-500">{{ $aparatur->jabatan }}</p>
                        </div>
                    @endforeach
                </div>

                @if ($aparaturs->count() > 8)
                    <div class="text-center mt-10">
                        <a href="{{ route('profil.struktur') }}"
                            class="inline-flex items-center px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-lg transition">
                            Lihat Semua Aparatur
                            <i class="fas fa-arrow-right ml-2"></i>
                        </a>
                    </div>
                @endif
            </div>
        </section>
    @endif
@endsection

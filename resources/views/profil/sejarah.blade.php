@extends('layouts.app')

@section('title', 'Sejarah Desa')

@section('content')
    <!-- Hero Section -->
    <section class="relative py-20 bg-gradient-to-r from-primary-600 to-primary-700">
        <div class="container mx-auto px-4">
            <div class="text-center text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Sejarah Desa</h1>
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
                <span class="text-primary-600 font-medium">Sejarah</span>
            </nav>
        </div>
    </div>

    <!-- Content -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-2xl shadow-sm p-8 md:p-12" data-aos="fade-up">
                    @if ($profil->foto_kantor)
                        <img src="{{ Storage::url($profil->foto_kantor) }}" alt="Kantor Desa"
                            class="w-full rounded-xl mb-8">
                    @endif

                    <div class="prose prose-lg max-w-none text-gray-600">
                        @if ($profil->sejarah)
                            {!! $profil->sejarah !!}
                        @else
                            <p>Desa Tanalum merupakan salah satu desa yang terletak di Kecamatan Marang Kayu, Kabupaten
                                Kutai Kartanegara, Provinsi Kalimantan Timur.</p>

                            <p>Nama "Tanalum" berasal dari bahasa lokal yang memiliki makna mendalam bagi masyarakat
                                setempat. Desa ini memiliki sejarah panjang yang tak terpisahkan dari perkembangan wilayah
                                Kutai Kartanegara.</p>

                            <p>Sejak zaman dahulu, masyarakat desa hidup dari hasil pertanian, perkebunan, dan memanfaatkan
                                sumber daya alam yang melimpah di wilayah ini. Gotong royong dan kekeluargaan menjadi
                                nilai-nilai utama yang terus dijaga oleh warga desa hingga saat ini.</p>
                        @endif
                    </div>
                </div>

                <!-- Navigation -->
                <div class="flex flex-col sm:flex-row justify-between gap-4 mt-8">
                    <a href="{{ route('profil.index') }}"
                        class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-gray-700 hover:bg-gray-50 rounded-lg transition">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali ke Profil
                    </a>
                    <a href="{{ route('profil.visi-misi') }}"
                        class="inline-flex items-center justify-center px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white rounded-lg transition">
                        Visi & Misi
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

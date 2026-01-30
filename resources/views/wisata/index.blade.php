@extends('layouts.app')

@section('title', 'Wisata Desa')

@section('content')
    <!-- Hero Section -->
    <section class="relative py-20 bg-gradient-to-r from-primary-600 to-primary-700">
        <div class="container mx-auto px-4">
            <div class="text-center text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Wisata Desa</h1>
                <p class="text-lg text-primary-100">Jelajahi keindahan dan potensi wisata
                    {{ $profil->nama_desa ?? 'Desa Tanalum' }}</p>
            </div>
        </div>
    </section>

    <!-- Breadcrumb -->
    <div class="bg-white shadow-sm">
        <div class="container mx-auto px-4">
            <nav class="flex items-center space-x-2 py-4 text-sm">
                <a href="{{ route('home') }}" class="text-gray-500 hover:text-primary-600">Beranda</a>
                <span class="text-gray-400">/</span>
                <span class="text-primary-600 font-medium">Wisata</span>
            </nav>
        </div>
    </div>

    <!-- Content -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            @if ($wisatas->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach ($wisatas as $index => $wisata)
                        <article class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-lg transition group"
                            data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                            <a href="{{ route('wisata.show', $wisata->slug) }}">
                                <div class="aspect-video overflow-hidden relative">
                                    @if ($wisata->gambar)
                                        <img src="{{ Storage::url($wisata->gambar) }}" alt="{{ $wisata->nama }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                    @else
                                        <div
                                            class="w-full h-full bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center">
                                            <i class="fas fa-mountain text-4xl text-primary-400"></i>
                                        </div>
                                    @endif
                                    @if ($wisata->kategori)
                                        <span
                                            class="absolute top-3 left-3 px-3 py-1 bg-white/90 text-primary-700 text-xs font-medium rounded-full">
                                            {{ $wisata->kategori }}
                                        </span>
                                    @endif
                                </div>
                            </a>
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-primary-600 transition">
                                    <a href="{{ route('wisata.show', $wisata->slug) }}">{{ $wisata->nama }}</a>
                                </h3>
                                @if ($wisata->lokasi)
                                    <p class="text-sm text-gray-500 mb-3">
                                        <i class="fas fa-map-marker-alt mr-1"></i> {{ $wisata->lokasi }}
                                    </p>
                                @endif
                                <p class="text-gray-600 line-clamp-3">{{ Str::limit(strip_tags($wisata->deskripsi), 120) }}
                                </p>
                                <a href="{{ route('wisata.show', $wisata->slug) }}"
                                    class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium mt-4">
                                    Selengkapnya
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $wisatas->links() }}
                </div>
            @else
                <div class="text-center py-16 bg-white rounded-2xl shadow-sm">
                    <i class="fas fa-mountain text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Data Wisata</h3>
                    <p class="text-gray-500">Data wisata desa belum tersedia.</p>
                </div>
            @endif

            <!-- Potensi Section -->
            @if ($potensis->count() > 0)
                <div class="mt-16">
                    <div class="text-center mb-12" data-aos="fade-up">
                        <h2 class="text-3xl font-bold text-gray-800">Potensi Desa</h2>
                        <p class="text-gray-600 mt-2">Berbagai potensi unggulan yang dimiliki desa</p>
                    </div>

                    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach ($potensis as $index => $potensi)
                            <div class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-md transition" data-aos="fade-up"
                                data-aos-delay="{{ $index * 50 }}">
                                <div class="w-14 h-14 bg-primary-100 rounded-xl flex items-center justify-center mb-4">
                                    @if ($potensi->kategori && $potensi->kategori->icon)
                                        <i class="fas fa-{{ $potensi->kategori->icon }} text-2xl text-primary-600"></i>
                                    @else
                                        <i class="fas fa-star text-2xl text-primary-600"></i>
                                    @endif
                                </div>
                                <h3 class="font-bold text-gray-800 mb-2">{{ $potensi->nama }}</h3>
                                @if ($potensi->kategori)
                                    <span
                                        class="text-xs text-primary-600 font-medium">{{ $potensi->kategori->nama }}</span>
                                @endif
                                <p class="text-gray-600 text-sm mt-2 line-clamp-3">
                                    {{ Str::limit(strip_tags($potensi->deskripsi), 100) }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection

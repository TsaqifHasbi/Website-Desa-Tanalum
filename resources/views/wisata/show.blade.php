@extends('layouts.app')

@section('title', $wisata->nama)

@section('content')
    <!-- Hero Section -->
    <section class="relative h-[50vh] min-h-[400px]">
        @if ($wisata->gambar_utama)
            <img src="{{ Storage::url($wisata->gambar_utama) }}" alt="{{ $wisata->nama }}" class="w-full h-full object-cover">
        @else
            <div class="w-full h-full bg-gradient-to-br from-primary-600 to-primary-700"></div>
        @endif
        <div class="absolute inset-0 bg-black/50"></div>
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="text-center text-white px-4">
                @if ($wisata->kategori)
                    <span
                        class="inline-block px-4 py-1 bg-white/20 backdrop-blur rounded-full text-sm font-medium mb-4">{{ $wisata->kategori }}</span>
                @endif
                <h1 class="text-4xl md:text-5xl font-bold mb-4">{{ $wisata->nama }}</h1>
                @if ($wisata->lokasi)
                    <p class="text-lg text-white/80"><i class="fas fa-map-marker-alt mr-2"></i>{{ $wisata->lokasi }}</p>
                @endif
            </div>
        </div>
    </section>

    <!-- Breadcrumb -->
    <div class="bg-white shadow-sm">
        <div class="container mx-auto px-4">
            <nav class="flex items-center space-x-2 py-4 text-sm">
                <a href="{{ route('home') }}" class="text-gray-500 hover:text-primary-600">Beranda</a>
                <span class="text-gray-400">/</span>
                <a href="{{ route('wisata.index') }}" class="text-gray-500 hover:text-primary-600">Wisata</a>
                <span class="text-gray-400">/</span>
                <span class="text-primary-600 font-medium">{{ $wisata->nama }}</span>
            </nav>
        </div>
    </div>

    <!-- Content -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <article class="bg-white rounded-2xl shadow-sm p-8" data-aos="fade-up">
                        <div class="prose prose-lg max-w-none">
                            {!! $wisata->deskripsi !!}
                        </div>

                        <!-- Gallery -->
                        @if ($wisata->galeri && count($wisata->galeri) > 0)
                            <div class="mt-8 pt-8 border-t border-gray-100">
                                <h3 class="text-xl font-bold text-gray-800 mb-4">Galeri Foto</h3>
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                    @foreach ($wisata->galeri as $foto)
                                        <div class="aspect-square rounded-xl overflow-hidden">
                                            <img src="{{ Storage::url($foto) }}" alt="Galeri {{ $wisata->nama }}"
                                                class="w-full h-full object-cover hover:scale-110 transition duration-300">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Facilities -->
                        @if ($wisata->fasilitas && count($wisata->fasilitas) > 0)
                            <div class="mt-8 pt-8 border-t border-gray-100">
                                <h3 class="text-xl font-bold text-gray-800 mb-4">Fasilitas</h3>
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($wisata->fasilitas as $fasilitas)
                                        <span class="px-4 py-2 bg-primary-50 text-primary-700 rounded-lg text-sm">
                                            <i class="fas fa-check mr-1"></i> {{ $fasilitas }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </article>

                    <!-- Map -->
                    @if ($wisata->koordinat)
                        <div class="mt-6 bg-white rounded-2xl shadow-sm p-6" data-aos="fade-up">
                            <h3 class="text-xl font-bold text-gray-800 mb-4">Lokasi</h3>
                            <div class="aspect-video rounded-xl overflow-hidden">
                                <iframe src="https://maps.google.com/maps?q={{ $wisata->koordinat }}&z=15&output=embed"
                                    width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen>
                                </iframe>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Info Card -->
                    <div class="bg-white rounded-2xl shadow-sm p-6" data-aos="fade-left">
                        <h3 class="font-bold text-gray-800 mb-4">Informasi</h3>
                        <div class="space-y-4">
                            @if ($wisata->jam_buka)
                                <div class="flex items-start">
                                    <div
                                        class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                                        <i class="fas fa-clock text-primary-600"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Jam Operasional</p>
                                        <p class="font-medium text-gray-800">{{ $wisata->jam_buka }}</p>
                                    </div>
                                </div>
                            @endif
                            @if ($wisata->harga_tiket)
                                <div class="flex items-start">
                                    <div
                                        class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                                        <i class="fas fa-ticket-alt text-green-600"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Harga Tiket</p>
                                        <p class="font-medium text-gray-800">Rp
                                            {{ number_format($wisata->harga_tiket, 0, ',', '.') }}</p>
                                    </div>
                                </div>
                            @endif
                            @if ($wisata->kontak)
                                <div class="flex items-start">
                                    <div
                                        class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                                        <i class="fas fa-phone text-blue-600"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Kontak</p>
                                        <p class="font-medium text-gray-800">{{ $wisata->kontak }}</p>
                                    </div>
                                </div>
                            @endif
                        </div>

                        @if ($wisata->koordinat)
                            <a href="https://www.google.com/maps/search/?api=1&query={{ $wisata->koordinat }}"
                                target="_blank"
                                class="mt-6 w-full flex items-center justify-center px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition">
                                <i class="fas fa-directions mr-2"></i>
                                Petunjuk Arah
                            </a>
                        @endif
                    </div>

                    <!-- Related -->
                    @if ($relatedWisatas->count() > 0)
                        <div class="bg-white rounded-2xl shadow-sm p-6" data-aos="fade-left" data-aos-delay="100">
                            <h3 class="font-bold text-gray-800 mb-4">Wisata Lainnya</h3>
                            <div class="space-y-4">
                                @foreach ($relatedWisatas as $related)
                                    <a href="{{ route('wisata.show', $related->slug) }}" class="flex items-center group">
                                        <div class="w-16 h-16 rounded-lg overflow-hidden flex-shrink-0">
                                            @if ($related->gambar_utama)
                                                <img src="{{ Storage::url($related->gambar_utama) }}"
                                                    alt="{{ $related->nama }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full bg-primary-100 flex items-center justify-center">
                                                    <i class="fas fa-mountain text-primary-400"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="ml-3">
                                            <h4 class="font-medium text-gray-800 group-hover:text-primary-600 transition">
                                                {{ $related->nama }}</h4>
                                            <p class="text-sm text-gray-500">{{ $related->kategori ?? 'Wisata' }}</p>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
@endsection

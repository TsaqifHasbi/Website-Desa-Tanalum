@extends('layouts.app')

@section('title', $produk->nama)

@section('content')
    <!-- Breadcrumb -->
    <div class="bg-white shadow-sm">
        <div class="container mx-auto px-4">
            <nav class="flex items-center space-x-2 py-4 text-sm">
                <a href="{{ route('home') }}" class="text-gray-500 hover:text-primary-600">Beranda</a>
                <span class="text-gray-400">/</span>
                <a href="{{ route('belanja.index') }}" class="text-gray-500 hover:text-primary-600">Produk</a>
                <span class="text-gray-400">/</span>
                <span class="text-primary-600 font-medium line-clamp-1">{{ $produk->nama }}</span>
            </nav>
        </div>
    </div>

    <!-- Content -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="grid lg:grid-cols-2 gap-12">
                <!-- Product Images -->
                <div data-aos="fade-right">
                    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                        <div class="aspect-square" x-data="{ mainImage: '{{ $produk->gambar ? Storage::url($produk->gambar) : '' }}' }">
                            @if ($produk->gambar)
                                <img :src="mainImage" alt="{{ $produk->nama }}" class="w-full h-full object-cover">
                            @else
                                <div
                                    class="w-full h-full bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center">
                                    <i class="fas fa-box text-8xl text-primary-400"></i>
                                </div>
                            @endif
                        </div>

                        @if ($produk->galeri && count($produk->galeri) > 0)
                            <div class="p-4 grid grid-cols-4 gap-2">
                                <button @click="mainImage = '{{ Storage::url($produk->gambar) }}'"
                                    class="aspect-square rounded-lg overflow-hidden border-2 border-primary-500">
                                    <img src="{{ Storage::url($produk->gambar) }}" alt="{{ $produk->nama }}"
                                        class="w-full h-full object-cover">
                                </button>
                                @foreach ($produk->galeri as $img)
                                    <button @click="mainImage = '{{ Storage::url($img) }}'"
                                        class="aspect-square rounded-lg overflow-hidden border-2 border-transparent hover:border-primary-500 transition">
                                        <img src="{{ Storage::url($img) }}" alt="{{ $produk->nama }}"
                                            class="w-full h-full object-cover">
                                    </button>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Product Info -->
                <div data-aos="fade-left">
                    @if ($produk->kategori)
                        <a href="{{ route('belanja.index', ['kategori' => $produk->kategori->id]) }}"
                            class="inline-block px-3 py-1 bg-primary-100 text-primary-700 rounded-full text-sm font-medium mb-4 hover:bg-primary-200 transition">
                            {{ $produk->kategori->nama }}
                        </a>
                    @endif

                    <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">{{ $produk->nama }}</h1>

                    <p class="text-4xl font-bold text-primary-600 mb-6">{{ $produk->formatted_harga }}</p>

                    <!-- Stock & Status -->
                    <div class="flex items-center space-x-4 mb-6">
                        @if ($produk->stok > 0)
                            <span class="px-4 py-2 bg-green-100 text-green-700 rounded-lg font-medium">
                                <i class="fas fa-check-circle mr-1"></i> Stok Tersedia ({{ $produk->stok }})
                            </span>
                        @else
                            <span class="px-4 py-2 bg-red-100 text-red-700 rounded-lg font-medium">
                                <i class="fas fa-times-circle mr-1"></i> Stok Habis
                            </span>
                        @endif
                    </div>

                    <!-- Description -->
                    @if ($produk->deskripsi)
                        <div class="mb-6">
                            <h3 class="font-semibold text-gray-800 mb-2">Deskripsi</h3>
                            <div class="prose max-w-none text-gray-600">
                                {!! $produk->deskripsi !!}
                            </div>
                        </div>
                    @endif

                    <!-- Seller Info -->
                    <div class="bg-gray-50 rounded-xl p-6 mb-6">
                        <h3 class="font-semibold text-gray-800 mb-4">Informasi Penjual</h3>
                        <div class="space-y-3">
                            @if ($produk->penjual)
                                <div class="flex items-center">
                                    <i class="fas fa-store text-primary-600 w-6"></i>
                                    <span class="text-gray-600">{{ $produk->penjual }}</span>
                                </div>
                            @endif
                            @if ($produk->kontak)
                                <div class="flex items-center">
                                    <i class="fas fa-phone text-primary-600 w-6"></i>
                                    <span class="text-gray-600">{{ $produk->kontak }}</span>
                                </div>
                            @endif
                            @if ($produk->alamat)
                                <div class="flex items-start">
                                    <i class="fas fa-map-marker-alt text-primary-600 w-6 mt-1"></i>
                                    <span class="text-gray-600">{{ $produk->alamat }}</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        @if ($produk->kontak)
                            @php
                                $waNumber = preg_replace('/[^0-9]/', '', $produk->kontak);
                                if (substr($waNumber, 0, 1) === '0') {
                                    $waNumber = '62' . substr($waNumber, 1);
                                }
                                $waMessage = urlencode(
                                    "Halo, saya tertarik dengan produk *{$produk->nama}* yang dijual di website Desa Tanalum.\n\nApakah produk ini masih tersedia?",
                                );
                            @endphp
                            <a href="https://wa.me/{{ $waNumber }}?text={{ $waMessage }}" target="_blank"
                                class="flex-1 py-3 px-6 bg-green-500 hover:bg-green-600 text-white font-semibold rounded-lg transition flex items-center justify-center">
                                <i class="fab fa-whatsapp text-xl mr-2"></i>
                                Hubungi via WhatsApp
                            </a>
                        @endif
                        <button
                            onclick="navigator.share ? navigator.share({title: '{{ $produk->nama }}', url: window.location.href}) : navigator.clipboard.writeText(window.location.href).then(() => alert('Link berhasil disalin!'))"
                            class="py-3 px-6 border-2 border-gray-300 text-gray-700 hover:bg-gray-50 font-semibold rounded-lg transition flex items-center justify-center">
                            <i class="fas fa-share-alt mr-2"></i>
                            Bagikan
                        </button>
                    </div>
                </div>
            </div>

            <!-- Related Products -->
            @if ($relatedProduks->count() > 0)
                <div class="mt-16">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6" data-aos="fade-up">Produk Lainnya</h2>
                    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach ($relatedProduks as $index => $related)
                            <div class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-lg transition group"
                                data-aos="fade-up" data-aos-delay="{{ $index * 50 }}">
                                <a href="{{ route('belanja.show', $related->slug) }}">
                                    <div class="aspect-square overflow-hidden">
                                        @if ($related->gambar)
                                            <img src="{{ Storage::url($related->gambar) }}" alt="{{ $related->nama }}"
                                                class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                        @else
                                            <div
                                                class="w-full h-full bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center">
                                                <i class="fas fa-box text-3xl text-primary-400"></i>
                                            </div>
                                        @endif
                                    </div>
                                </a>
                                <div class="p-4">
                                    <h3 class="font-semibold text-gray-800 line-clamp-2">
                                        <a href="{{ route('belanja.show', $related->slug) }}"
                                            class="hover:text-primary-600 transition">{{ $related->nama }}</a>
                                    </h3>
                                    <p class="text-primary-600 font-bold mt-2">{{ $related->formatted_harga }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection

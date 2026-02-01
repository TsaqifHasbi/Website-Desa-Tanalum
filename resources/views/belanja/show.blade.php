@extends('layouts.public')

@section('title', $produk->nama . ' - Belanja Desa Tanalum')

@section('content')
    <!-- Breadcrumb -->
    <section class="py-4 bg-gray-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <nav class="flex" aria-label="Breadcrumb">
                <ol class="flex items-center space-x-2 text-sm">
                    <li>
                        <a href="{{ route('home') }}" class="text-gray-500 hover:text-orange-600">
                            <i class="fas fa-home"></i>
                        </a>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2 text-xs"></i>
                        <a href="{{ route('belanja.index') }}" class="text-gray-500 hover:text-orange-600">Belanja</a>
                    </li>
                    @if ($produk->kategori)
                        <li class="flex items-center">
                            <i class="fas fa-chevron-right text-gray-400 mx-2 text-xs"></i>
                            <a href="{{ route('belanja.kategori', $produk->kategori->slug) }}"
                                class="text-gray-500 hover:text-orange-600">
                                {{ $produk->kategori->nama }}
                            </a>
                        </li>
                    @endif
                    <li class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2 text-xs"></i>
                        <span class="text-gray-700 font-medium">{{ Str::limit($produk->nama, 30) }}</span>
                    </li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Product Detail -->
    <section class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">

                <!-- Product Images -->
                <div>
                    <!-- Main Image -->
                    <div class="relative rounded-2xl overflow-hidden bg-gray-100 mb-4" x-data="{ activeImage: '{{ $produk->gambar_utama ? Storage::url($produk->gambar_utama) : '' }}' }">
                        @if ($produk->gambar_utama)
                            <img :src="activeImage" alt="{{ $produk->nama }}"
                                class="w-full h-auto max-h-96 object-contain mx-auto">
                        @else
                            <div
                                class="w-full h-64 flex items-center justify-center bg-gradient-to-br from-orange-100 to-orange-200">
                                <i class="fas fa-box text-orange-300 text-6xl"></i>
                            </div>
                        @endif

                        <!-- Badges -->
                        <div class="absolute top-4 left-4 flex flex-col gap-2">
                            @if ($produk->is_featured)
                                <span class="px-3 py-1 bg-yellow-500 text-white text-sm font-medium rounded-lg shadow">
                                    <i class="fas fa-star mr-1"></i>Produk Unggulan
                                </span>
                            @endif
                            @if ($produk->harga_diskon && $produk->harga_diskon < $produk->harga)
                                <span class="px-3 py-1 bg-red-500 text-white text-sm font-medium rounded-lg shadow">
                                    Diskon
                                </span>
                            @endif
                        </div>
                    </div>

                    <!-- Thumbnail Images -->
                    @if ($produk->galeri && count($produk->galeri) > 0)
                        <div class="grid grid-cols-5 gap-2">
                            <button @click="activeImage = '{{ Storage::url($produk->gambar_utama) }}'"
                                class="aspect-square rounded-lg overflow-hidden border-2 border-orange-500 hover:opacity-80 transition">
                                <img src="{{ Storage::url($produk->gambar_utama) }}" alt="{{ $produk->nama }}"
                                    class="w-full h-full object-cover">
                            </button>
                            @foreach ($produk->galeri as $galeri)
                                <button @click="activeImage = '{{ Storage::url($galeri) }}'"
                                    class="aspect-square rounded-lg overflow-hidden border-2 border-transparent hover:border-orange-500 transition">
                                    <img src="{{ Storage::url($galeri) }}" alt="{{ $produk->nama }}"
                                        class="w-full h-full object-cover">
                                </button>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Product Info -->
                <div>
                    @if ($produk->kategori)
                        <span
                            class="inline-block px-3 py-1 bg-orange-100 text-orange-600 rounded-full text-sm font-medium mb-3">
                            {{ $produk->kategori->nama }}
                        </span>
                    @endif

                    <h1 class="text-3xl font-bold text-gray-800 mb-4">{{ $produk->nama }}</h1>

                    <!-- Price -->
                    <div class="mb-6">
                        @if ($produk->harga_diskon && $produk->harga_diskon < $produk->harga)
                            <div class="flex items-center gap-3">
                                <span class="text-3xl font-bold text-orange-600">
                                    Rp {{ number_format($produk->harga_diskon, 0, ',', '.') }}
                                </span>
                                <span class="text-xl text-gray-400 line-through">
                                    Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                </span>
                            </div>
                            <p class="text-sm text-green-600 mt-1">
                                <i class="fas fa-tags mr-1"></i>
                                Hemat Rp {{ number_format($produk->harga - $produk->harga_diskon, 0, ',', '.') }}
                            </p>
                        @else
                            <span class="text-3xl font-bold text-orange-600">
                                Rp {{ number_format($produk->harga, 0, ',', '.') }}
                            </span>
                        @endif
                        @if ($produk->satuan)
                            <span class="text-gray-500 ml-2">/ {{ $produk->satuan }}</span>
                        @endif
                    </div>

                    <!-- Description -->
                    @if ($produk->deskripsi)
                        <div class="prose prose-sm max-w-none text-gray-600 mb-6">
                            {!! $produk->deskripsi !!}
                        </div>
                    @endif

                    <!-- Product Details -->
                    <div class="bg-gray-50 rounded-xl p-6 mb-6">
                        <h3 class="font-semibold text-gray-800 mb-4">Detail Produk</h3>
                        <div class="grid grid-cols-2 gap-4 text-sm">
                            <div>
                                <span class="text-gray-500">Stok</span>
                                <p class="font-medium text-gray-800">
                                    @if ($produk->stok > 10)
                                        <span class="text-green-600">Tersedia ({{ $produk->stok }})</span>
                                    @elseif($produk->stok > 0)
                                        <span class="text-yellow-600">Stok Terbatas ({{ $produk->stok }})</span>
                                    @else
                                        <span class="text-red-600">Habis</span>
                                    @endif
                                </p>
                            </div>
                            @if ($produk->satuan)
                                <div>
                                    <span class="text-gray-500">Satuan</span>
                                    <p class="font-medium text-gray-800">{{ $produk->satuan }}</p>
                                </div>
                            @endif
                            @if ($produk->rating)
                                <div>
                                    <span class="text-gray-500">Rating</span>
                                    <p class="font-medium text-gray-800">
                                        <i class="fas fa-star text-yellow-500"></i>
                                        {{ number_format($produk->rating, 1) }}
                                        @if ($produk->jumlah_rating)
                                            ({{ $produk->jumlah_rating }} ulasan)
                                        @endif
                                    </p>
                                </div>
                            @endif
                            @if ($produk->views)
                                <div>
                                    <span class="text-gray-500">Dilihat</span>
                                    <p class="font-medium text-gray-800">{{ number_format($produk->views) }} kali</p>
                                </div>
                            @endif
                            @if ($produk->kategori)
                                <div>
                                    <span class="text-gray-500">Kategori</span>
                                    <p class="font-medium text-gray-800">{{ $produk->kategori->nama }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Seller Info -->
                    <div class="border border-gray-200 rounded-xl p-6 mb-6">
                        <h3 class="font-semibold text-gray-800 mb-4">Informasi Penjual</h3>
                        <div class="flex items-center">
                            <div class="w-12 h-12 rounded-full bg-orange-100 flex items-center justify-center mr-4">
                                <i class="fas fa-store text-orange-500 text-xl"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800">{{ $produk->pemilik }}</p>
                                <p class="text-sm text-gray-500">
                                    <i class="fas fa-map-marker-alt mr-1"></i>
                                    {{ $produk->alamat_pemilik ?? 'Desa Tanalum, Marang Kayu' }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        @if ($produk->kontak_pemilik)
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $produk->kontak_pemilik) }}?text={{ urlencode('Halo, saya tertarik dengan produk ' . $produk->nama . ' di Website Desa Tanalum') }}"
                                target="_blank"
                                class="flex-1 inline-flex items-center justify-center px-6 py-4 bg-green-600 text-white rounded-xl font-semibold hover:bg-green-700 transition-colors">
                                <i class="fab fa-whatsapp mr-2 text-xl"></i>
                                Pesan via WhatsApp
                            </a>
                        @endif

                        <button
                            class="px-6 py-4 border-2 border-orange-600 text-orange-600 rounded-xl font-semibold hover:bg-orange-50 transition-colors">
                            <i class="far fa-heart mr-2"></i>
                            Simpan
                        </button>

                        <button onclick="shareProduct()"
                            class="px-6 py-4 border-2 border-gray-300 text-gray-600 rounded-xl font-semibold hover:bg-gray-50 transition-colors">
                            <i class="fas fa-share-alt mr-2"></i>
                            Bagikan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Products -->
    @if ($relatedProducts && $relatedProducts->count() > 0)
        <section class="py-12 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h2 class="text-2xl font-bold text-gray-800 mb-8">Produk Serupa</h2>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    @foreach ($relatedProducts as $related)
                        <article class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-lg transition-all group">
                            <div class="relative aspect-square overflow-hidden">
                                @if ($related->gambar_utama)
                                    <img src="{{ Storage::url($related->gambar_utama) }}" alt="{{ $related->nama }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
                                @else
                                    <div
                                        class="w-full h-full bg-gradient-to-br from-orange-100 to-orange-200 flex items-center justify-center">
                                        <i class="fas fa-box text-orange-300 text-3xl"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="p-4">
                                <h3
                                    class="font-semibold text-gray-800 line-clamp-2 group-hover:text-orange-600 transition-colors">
                                    <a href="{{ route('belanja.show', $related->slug) }}">{{ $related->nama }}</a>
                                </h3>
                                <p class="text-lg font-bold text-orange-600 mt-2">
                                    Rp {{ number_format($related->harga, 0, ',', '.') }}
                                </p>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
@endsection

@push('scripts')
    <script>
        function shareProduct() {
            if (navigator.share) {
                navigator.share({
                    title: '{{ $produk->nama }}',
                    text: 'Lihat produk {{ $produk->nama }} di Website Desa Tanalum',
                    url: window.location.href
                });
            } else {
                // Fallback: copy to clipboard
                navigator.clipboard.writeText(window.location.href);
                alert('Link berhasil disalin!');
            }
        }
    </script>
@endpush

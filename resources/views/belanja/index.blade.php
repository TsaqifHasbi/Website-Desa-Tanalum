@extends('layouts.main')

@section('title', 'Beli Dari Desa - Produk UMKM Desa Tanalum')

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-r from-green-600 to-green-700 text-white py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl md:text-5xl font-bold text-green-300 mb-2">Beli Dari Desa</h1>
            <p class="text-lg text-green-100">
                Layanan yang disediakan promosi produk UMKM desa sehingga mampu meningkatkan perekonomian masyarakat desa
            </p>
        </div>
    </section>

    <!-- Products Grid -->
    <section class="py-8 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if (isset($produks) && $produks->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">
                    @foreach ($produks as $produk)
                        <article class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-lg transition group">
                            <a href="{{ route('belanja.show', $produk->slug) }}" class="block">
                                <div class="aspect-square overflow-hidden">
                                    @if ($produk->gambar_utama)
                                        <img src="{{ Storage::url($produk->gambar_utama) }}" alt="{{ $produk->nama }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                    @else
                                        <div
                                            class="w-full h-full bg-gradient-to-br from-green-100 to-green-200 flex items-center justify-center">
                                            <i class="fas fa-shopping-bag text-4xl text-green-400"></i>
                                        </div>
                                    @endif
                                </div>
                            </a>
                            <div class="p-4">
                                <h3 class="font-medium text-gray-800 mb-2 line-clamp-1">
                                    <a href="{{ route('belanja.show', $produk->slug) }}" class="hover:text-green-600">
                                        {{ $produk->nama }}
                                    </a>
                                </h3>
                                <!-- Rating Stars -->
                                <div class="flex items-center mb-2">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i
                                            class="fas fa-star text-sm {{ $i <= ($produk->rating ?? 0) ? 'text-yellow-400' : 'text-gray-300' }}"></i>
                                    @endfor
                                </div>
                                <!-- Price -->
                                <p class="text-lg font-bold text-green-600">
                                    Rp{{ number_format($produk->harga ?? 0, 0, ',', '.') }}
                                </p>
                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8 flex justify-center">
                    {{ $produks->links() }}
                </div>
            @else
                <div class="text-center py-16 bg-white rounded-2xl shadow-sm">
                    <i class="fas fa-shopping-bag text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Produk</h3>
                    <p class="text-gray-500">Produk UMKM desa belum tersedia.</p>
                </div>
            @endif
        </div>
    </section>
@endsection

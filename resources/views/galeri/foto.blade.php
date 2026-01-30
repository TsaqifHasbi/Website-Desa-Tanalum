@extends('layouts.main')

@section('title', 'Galeri Foto - Desa Tanalum')

@section('content')
    <!-- Hero Section -->
    <section class="relative py-16 bg-gradient-to-r from-green-600 to-green-700">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="container mx-auto px-4 relative">
            <div class="text-center text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Galeri Foto</h1>
                <p class="text-xl text-green-100 mb-4">Dokumentasi Kegiatan dan Momen Desa Tanalum</p>
                <!-- Breadcrumb -->
                <nav class="flex items-center justify-center text-sm">
                    <a href="{{ route('home') }}" class="text-green-200 hover:text-white">Beranda</a>
                    <span class="mx-2 text-green-300">/</span>
                    <a href="{{ route('galeri.index') }}" class="text-green-200 hover:text-white">Galeri</a>
                    <span class="mx-2 text-green-300">/</span>
                    <span class="text-white">Foto</span>
                </nav>
            </div>
        </div>
    </section>

    <!-- Tab Navigation -->
    <section class="bg-white border-b sticky top-0 z-40">
        <div class="container mx-auto px-4">
            <div class="flex justify-center">
                <a href="{{ route('galeri.index') }}"
                    class="px-6 py-4 text-gray-600 hover:text-green-600 font-medium border-b-2 border-transparent hover:border-green-600 transition-colors">
                    Semua
                </a>
                <a href="{{ route('galeri.foto') }}"
                    class="px-6 py-4 text-green-600 font-medium border-b-2 border-green-600">
                    Foto
                </a>
                <a href="{{ route('galeri.video') }}"
                    class="px-6 py-4 text-gray-600 hover:text-green-600 font-medium border-b-2 border-transparent hover:border-green-600 transition-colors">
                    Video
                </a>
            </div>
        </div>
    </section>

    <!-- Gallery Grid -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            @if (isset($galeris) && $galeris->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" x-data="{ lightbox: null }">
                    @foreach ($galeris as $galeri)
                        <div class="group relative aspect-square rounded-xl overflow-hidden cursor-pointer"
                            @click="lightbox = {{ $loop->index }}">
                            <img src="{{ Storage::url($galeri->file_path) }}" alt="{{ $galeri->judul }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity">
                                <div class="absolute bottom-0 left-0 right-0 p-4">
                                    <h4 class="text-white font-medium text-sm line-clamp-2">{{ $galeri->judul }}</h4>
                                    <p class="text-gray-300 text-xs mt-1">{{ $galeri->created_at->format('d M Y') }}</p>
                                </div>
                            </div>
                            <div
                                class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity">
                                <div class="w-12 h-12 bg-white/90 rounded-full flex items-center justify-center">
                                    <i class="fas fa-search-plus text-green-600"></i>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <!-- Lightbox -->
                    <div x-show="lightbox !== null" x-cloak
                        class="fixed inset-0 bg-black/90 z-50 flex items-center justify-center p-4"
                        @keydown.escape.window="lightbox = null" @click.self="lightbox = null">
                        <button @click="lightbox = null" class="absolute top-4 right-4 text-white hover:text-gray-300">
                            <i class="fas fa-times text-2xl"></i>
                        </button>
                        <button @click="lightbox = lightbox > 0 ? lightbox - 1 : {{ $galeris->count() - 1 }}"
                            class="absolute left-4 text-white hover:text-gray-300">
                            <i class="fas fa-chevron-left text-3xl"></i>
                        </button>
                        <button @click="lightbox = lightbox < {{ $galeris->count() - 1 }} ? lightbox + 1 : 0"
                            class="absolute right-4 text-white hover:text-gray-300">
                            <i class="fas fa-chevron-right text-3xl"></i>
                        </button>

                        @foreach ($galeris as $galeri)
                            <div x-show="lightbox === {{ $loop->index }}" class="max-w-4xl max-h-[80vh]">
                                <img src="{{ Storage::url($galeri->file_path) }}" alt="{{ $galeri->judul }}"
                                    class="max-w-full max-h-[70vh] object-contain">
                                <div class="text-center mt-4">
                                    <h4 class="text-white font-medium">{{ $galeri->judul }}</h4>
                                    @if ($galeri->deskripsi)
                                        <p class="text-gray-400 text-sm mt-1">{{ $galeri->deskripsi }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $galeris->links() }}
                </div>
            @else
                <div class="text-center py-16">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-image text-gray-400 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Belum Ada Foto</h3>
                    <p class="text-gray-600">Galeri foto belum tersedia.</p>
                </div>
            @endif
        </div>
    </section>
@endsection

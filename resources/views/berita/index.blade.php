@extends('layouts.main')

@section('title', 'Berita Desa')

@section('content')
    <!-- Hero Section -->
    <section class="relative py-12 bg-gradient-to-r from-green-600 to-green-700">
        <div class="container mx-auto px-4">
            <div class="text-white">
                <h1 class="text-4xl md:text-5xl font-bold text-green-300 mb-2">Berita Desa</h1>
                <p class="text-lg text-green-100">Menyajikan informasi terbaru tentang peristiwa, berita terkini, dan
                    artikel-artikel jurnalistik dari {{ $profil->nama_desa ?? 'Desa Tanalum' }}</p>
            </div>
        </div>
    </section>

    <!-- Content -->
    <section class="py-8">
        <div class="container mx-auto px-4">
            <!-- Berita Grid -->
            @if ($beritas->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($beritas as $index => $berita)
                        <article class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-lg transition group">
                            <a href="{{ route('berita.show', $berita->slug) }}" class="block relative">
                                <div class="aspect-[4/3] overflow-hidden">
                                    @if ($berita->gambar_utama)
                                        <img src="{{ Storage::url($berita->gambar_utama) }}" alt="{{ $berita->judul }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                    @else
                                        <div
                                            class="w-full h-full bg-gradient-to-br from-green-100 to-green-200 flex items-center justify-center">
                                            <i class="fas fa-newspaper text-4xl text-green-400"></i>
                                        </div>
                                    @endif
                                </div>
                                <!-- Date Badge -->
                                <div
                                    class="absolute bottom-4 right-4 bg-green-600 text-white text-center rounded-lg px-3 py-2 shadow-lg">
                                    <div class="text-xs font-medium">
                                        {{ $berita->published_at ? $berita->published_at->format('d M') : $berita->created_at->format('d M') }}
                                    </div>
                                    <div class="text-lg font-bold">
                                        {{ $berita->published_at ? $berita->published_at->format('Y') : $berita->created_at->format('Y') }}
                                    </div>
                                </div>
                            </a>
                            <div class="p-5">
                                <h3
                                    class="text-lg font-bold text-gray-800 mb-2 line-clamp-2 group-hover:text-green-600 transition uppercase">
                                    <a href="{{ route('berita.show', $berita->slug) }}">{{ $berita->judul }}</a>
                                </h3>
                                <p class="text-gray-600 text-sm line-clamp-3 mb-4">
                                    {{ $berita->ringkasan ?? Str::limit(strip_tags($berita->konten), 100) }}
                                </p>
                                <div class="flex items-center justify-between text-xs text-gray-500 pt-3 border-t">
                                    <div class="flex items-center">
                                        <i class="fas fa-user mr-1"></i>
                                        <span>{{ $berita->user->name ?? 'Administrator' }}</span>
                                    </div>
                                    <div class="flex items-center">
                                        <i class="fas fa-eye mr-1"></i>
                                        <span>Dilihat {{ $berita->views ?? 0 }} kali</span>
                                    </div>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8 flex justify-center">
                    {{ $beritas->links() }}
                </div>
            @else
                <div class="text-center py-16 bg-white rounded-2xl shadow-sm">
                    <i class="fas fa-newspaper text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Berita</h3>
                    <p class="text-gray-500">Berita desa belum tersedia.</p>
                </div>
            @endif
        </div>
    </section>
@endsection

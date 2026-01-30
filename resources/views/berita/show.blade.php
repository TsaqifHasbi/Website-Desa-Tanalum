@extends('layouts.app')

@section('title', $berita->judul)

@section('meta')
    <meta name="description" content="{{ $berita->ringkasan ?? Str::limit(strip_tags($berita->konten), 160) }}">
    <meta property="og:title" content="{{ $berita->judul }}">
    <meta property="og:description" content="{{ $berita->ringkasan ?? Str::limit(strip_tags($berita->konten), 160) }}">
    @if ($berita->gambar_utama)
        <meta property="og:image" content="{{ Storage::url($berita->gambar_utama) }}">
    @endif
@endsection

@section('content')
    <!-- Breadcrumb -->
    <div class="bg-white shadow-sm">
        <div class="container mx-auto px-4">
            <nav class="flex items-center space-x-2 py-4 text-sm">
                <a href="{{ route('home') }}" class="text-gray-500 hover:text-primary-600">Beranda</a>
                <span class="text-gray-400">/</span>
                <a href="{{ route('berita.index') }}" class="text-gray-500 hover:text-primary-600">Berita</a>
                <span class="text-gray-400">/</span>
                <span class="text-primary-600 font-medium line-clamp-1">{{ $berita->judul }}</span>
            </nav>
        </div>
    </div>

    <!-- Content -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="grid lg:grid-cols-4 gap-8">
                <!-- Main Content -->
                <article class="lg:col-span-3">
                    <div class="bg-white rounded-2xl shadow-sm overflow-hidden" data-aos="fade-up">
                        <!-- Featured Image -->
                        @if ($berita->gambar_utama)
                            <img src="{{ Storage::url($berita->gambar_utama) }}" alt="{{ $berita->judul }}"
                                class="w-full aspect-video object-cover">
                        @endif

                        <div class="p-8">
                            <!-- Meta -->
                            <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500 mb-4">
                                <span><i class="far fa-calendar mr-1"></i>
                                    {{ $berita->published_at ? $berita->published_at->format('d F Y') : $berita->created_at->format('d F Y') }}</span>
                                @if ($berita->kategori)
                                    <a href="{{ route('berita.index', ['kategori' => $berita->kategori->id]) }}"
                                        class="px-3 py-1 bg-primary-100 text-primary-700 rounded-full text-xs font-medium hover:bg-primary-200 transition">
                                        {{ $berita->kategori->nama }}
                                    </a>
                                @endif
                                @if ($berita->author)
                                    <span><i class="far fa-user mr-1"></i> {{ $berita->author->name }}</span>
                                @endif
                                <span><i class="far fa-eye mr-1"></i> {{ $berita->views ?? 0 }}x dibaca</span>
                            </div>

                            <!-- Title -->
                            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6">{{ $berita->judul }}</h1>

                            <!-- Content -->
                            <div class="prose prose-lg max-w-none text-gray-600">
                                {!! $berita->konten !!}
                            </div>

                            <!-- Tags -->
                            @if ($berita->tags && count($berita->tags) > 0)
                                <div class="mt-8 pt-6 border-t border-gray-100">
                                    <div class="flex flex-wrap items-center gap-2">
                                        <span class="text-gray-500"><i class="fas fa-tags mr-1"></i> Tags:</span>
                                        @foreach ($berita->tags as $tag)
                                            <a href="{{ route('berita.index', ['tag' => $tag]) }}"
                                                class="px-3 py-1 bg-gray-100 hover:bg-primary-100 hover:text-primary-600 text-gray-600 text-sm rounded-full transition">
                                                {{ $tag }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @endif

                            <!-- Share -->
                            <div class="mt-8 pt-6 border-t border-gray-100">
                                <div class="flex items-center space-x-4">
                                    <span class="text-gray-500">Bagikan:</span>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}"
                                        target="_blank"
                                        class="w-10 h-10 bg-blue-600 text-white rounded-lg flex items-center justify-center hover:bg-blue-700 transition">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($berita->judul) }}"
                                        target="_blank"
                                        class="w-10 h-10 bg-sky-500 text-white rounded-lg flex items-center justify-center hover:bg-sky-600 transition">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a href="https://wa.me/?text={{ urlencode($berita->judul . ' ' . request()->url()) }}"
                                        target="_blank"
                                        class="w-10 h-10 bg-green-500 text-white rounded-lg flex items-center justify-center hover:bg-green-600 transition">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                    <button
                                        onclick="navigator.clipboard.writeText('{{ request()->url() }}'); alert('Link berhasil disalin!');"
                                        class="w-10 h-10 bg-gray-500 text-white rounded-lg flex items-center justify-center hover:bg-gray-600 transition">
                                        <i class="fas fa-link"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation -->
                    <div class="flex flex-col sm:flex-row justify-between gap-4 mt-8">
                        @if ($prevBerita)
                            <a href="{{ route('berita.show', $prevBerita->slug) }}"
                                class="flex-1 p-4 bg-white rounded-xl shadow-sm hover:shadow-md transition group">
                                <div class="flex items-center text-gray-500 text-sm mb-2">
                                    <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition"></i>
                                    Sebelumnya
                                </div>
                                <p class="font-medium text-gray-800 line-clamp-1">{{ $prevBerita->judul }}</p>
                            </a>
                        @else
                            <div></div>
                        @endif
                        @if ($nextBerita)
                            <a href="{{ route('berita.show', $nextBerita->slug) }}"
                                class="flex-1 p-4 bg-white rounded-xl shadow-sm hover:shadow-md transition group text-right">
                                <div class="flex items-center justify-end text-gray-500 text-sm mb-2">
                                    Selanjutnya
                                    <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition"></i>
                                </div>
                                <p class="font-medium text-gray-800 line-clamp-1">{{ $nextBerita->judul }}</p>
                            </a>
                        @endif
                    </div>

                    <!-- Related Posts -->
                    @if ($relatedBeritas->count() > 0)
                        <div class="mt-12">
                            <h2 class="text-2xl font-bold text-gray-800 mb-6">Berita Terkait</h2>
                            <div class="grid md:grid-cols-3 gap-6">
                                @foreach ($relatedBeritas as $related)
                                    <article
                                        class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition group">
                                        <a href="{{ route('berita.show', $related->slug) }}">
                                            <div class="aspect-video overflow-hidden">
                                                @if ($related->gambar_utama)
                                                    <img src="{{ Storage::url($related->gambar_utama) }}"
                                                        alt="{{ $related->judul }}"
                                                        class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                                @else
                                                    <div
                                                        class="w-full h-full bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center">
                                                        <i class="fas fa-newspaper text-3xl text-primary-400"></i>
                                                    </div>
                                                @endif
                                            </div>
                                        </a>
                                        <div class="p-4">
                                            <p class="text-xs text-gray-500 mb-2">
                                                {{ $related->published_at ? $related->published_at->format('d M Y') : $related->created_at->format('d M Y') }}
                                            </p>
                                            <h3
                                                class="font-semibold text-gray-800 line-clamp-2 group-hover:text-primary-600 transition">
                                                <a
                                                    href="{{ route('berita.show', $related->slug) }}">{{ $related->judul }}</a>
                                            </h3>
                                        </div>
                                    </article>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </article>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Author -->
                    @if ($berita->author)
                        <div class="bg-white rounded-2xl shadow-sm p-6" data-aos="fade-left">
                            <h3 class="font-bold text-gray-800 mb-4">Penulis</h3>
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-user text-primary-600"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $berita->author->name }}</p>
                                    <p class="text-sm text-gray-500">{{ ucfirst($berita->author->role) }}</p>
                                </div>
                            </div>
                        </div>
                    @endif

                    <!-- Berita Populer -->
                    @if ($beritaPopuler->count() > 0)
                        <div class="bg-white rounded-2xl shadow-sm p-6" data-aos="fade-left" data-aos-delay="100">
                            <h3 class="font-bold text-gray-800 mb-4">Berita Populer</h3>
                            <div class="space-y-4">
                                @foreach ($beritaPopuler as $index => $popular)
                                    <a href="{{ route('berita.show', $popular->slug) }}"
                                        class="flex items-start space-x-3 group">
                                        <span
                                            class="w-8 h-8 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center flex-shrink-0 font-bold text-sm">{{ $index + 1 }}</span>
                                        <div>
                                            <h4
                                                class="text-sm font-medium text-gray-800 group-hover:text-primary-600 transition line-clamp-2">
                                                {{ $popular->judul }}</h4>
                                            <p class="text-xs text-gray-500 mt-1">{{ $popular->views ?? 0 }}x dibaca</p>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Back to List -->
                    <div class="bg-white rounded-2xl shadow-sm p-6" data-aos="fade-left" data-aos-delay="200">
                        <a href="{{ route('berita.index') }}"
                            class="flex items-center justify-center w-full py-3 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali ke Daftar Berita
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

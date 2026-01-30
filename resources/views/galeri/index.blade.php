@extends('layouts.app')

@section('title', 'Galeri')

@section('content')
    <!-- Hero Section -->
    <section class="relative py-20 bg-gradient-to-r from-primary-600 to-primary-700">
        <div class="container mx-auto px-4">
            <div class="text-center text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Galeri Desa</h1>
                <p class="text-lg text-primary-100">Dokumentasi kegiatan dan potensi
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
                <span class="text-primary-600 font-medium">Galeri</span>
            </nav>
        </div>
    </div>

    <!-- Content -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <!-- Filter -->
            <div class="flex flex-wrap justify-center gap-2 mb-12" data-aos="fade-up">
                <a href="{{ route('galeri.index') }}"
                    class="px-6 py-2 rounded-lg font-medium transition {{ !request('kategori') && !request('tipe') ? 'bg-primary-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-100' }}">
                    Semua
                </a>
                <a href="{{ route('galeri.index', ['tipe' => 'foto']) }}"
                    class="px-6 py-2 rounded-lg font-medium transition {{ request('tipe') == 'foto' ? 'bg-primary-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-100' }}">
                    <i class="fas fa-image mr-2"></i> Foto
                </a>
                <a href="{{ route('galeri.index', ['tipe' => 'video']) }}"
                    class="px-6 py-2 rounded-lg font-medium transition {{ request('tipe') == 'video' ? 'bg-primary-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-100' }}">
                    <i class="fas fa-video mr-2"></i> Video
                </a>
                @foreach ($kategoris as $kategori)
                    <a href="{{ route('galeri.index', ['kategori' => $kategori]) }}"
                        class="px-6 py-2 rounded-lg font-medium transition {{ request('kategori') == $kategori ? 'bg-primary-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-100' }}">
                        {{ $kategori }}
                    </a>
                @endforeach
            </div>

            @if ($galeris->count() > 0)
                <!-- Gallery Grid -->
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" x-data="{
                    lightbox: false,
                    currentImage: '',
                    currentTitle: '',
                    currentIndex: 0,
                    images: {{ json_encode($galeris->where('tipe', 'foto')->map(fn($g) => ['url' => Storage::url($g->file_path), 'title' => $g->judul])->values()) }},
                    openLightbox(url, title, index) {
                        this.currentImage = url;
                        this.currentTitle = title;
                        this.currentIndex = index;
                        this.lightbox = true;
                    },
                    next() {
                        this.currentIndex = (this.currentIndex + 1) % this.images.length;
                        this.currentImage = this.images[this.currentIndex].url;
                        this.currentTitle = this.images[this.currentIndex].title;
                    },
                    prev() {
                        this.currentIndex = this.currentIndex === 0 ? this.images.length - 1 : this.currentIndex - 1;
                        this.currentImage = this.images[this.currentIndex].url;
                        this.currentTitle = this.images[this.currentIndex].title;
                    }
                }">
                    @php $fotoIndex = 0; @endphp
                    @foreach ($galeris as $index => $galeri)
                        <div class="group relative aspect-square overflow-hidden rounded-xl bg-gray-100" data-aos="fade-up"
                            data-aos-delay="{{ ($index % 8) * 50 }}">
                            @if ($galeri->tipe === 'foto')
                                <img src="{{ Storage::url($galeri->file_path) }}" alt="{{ $galeri->judul }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/40 transition flex items-center justify-center cursor-pointer"
                                    @click="openLightbox('{{ Storage::url($galeri->file_path) }}', '{{ $galeri->judul }}', {{ $fotoIndex }})">
                                    <div class="opacity-0 group-hover:opacity-100 transition text-white text-center px-4">
                                        <i class="fas fa-expand text-3xl mb-2"></i>
                                        <p class="font-medium line-clamp-2">{{ $galeri->judul }}</p>
                                    </div>
                                </div>
                                @php $fotoIndex++; @endphp
                            @else
                                @if ($galeri->youtube_url)
                                    <a href="{{ $galeri->youtube_url }}" target="_blank" class="block w-full h-full">
                                        <img src="https://img.youtube.com/vi/{{ $galeri->youtube_video_id }}/maxresdefault.jpg"
                                            alt="{{ $galeri->judul }}"
                                            class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                                        <div
                                            class="absolute inset-0 bg-black/30 group-hover:bg-black/50 transition flex items-center justify-center">
                                            <div class="w-16 h-16 bg-red-600 rounded-full flex items-center justify-center">
                                                <i class="fas fa-play text-white text-xl ml-1"></i>
                                            </div>
                                        </div>
                                    </a>
                                @elseif($galeri->file_path)
                                    <video class="w-full h-full object-cover">
                                        <source src="{{ Storage::url($galeri->file_path) }}" type="video/mp4">
                                    </video>
                                    <div class="absolute inset-0 bg-black/30 flex items-center justify-center">
                                        <div class="w-16 h-16 bg-white/90 rounded-full flex items-center justify-center">
                                            <i class="fas fa-play text-gray-800 text-xl ml-1"></i>
                                        </div>
                                    </div>
                                @endif
                            @endif

                            @if ($galeri->kategori)
                                <div class="absolute top-2 left-2">
                                    <span
                                        class="px-2 py-1 bg-white/90 text-gray-700 text-xs font-medium rounded">{{ $galeri->kategori }}</span>
                                </div>
                            @endif
                        </div>
                    @endforeach

                    <!-- Lightbox -->
                    <div x-show="lightbox" x-cloak @keydown.escape.window="lightbox = false"
                        @keydown.arrow-right.window="next()" @keydown.arrow-left.window="prev()"
                        class="fixed inset-0 bg-black/90 z-50 flex items-center justify-center p-4">
                        <button @click="lightbox = false"
                            class="absolute top-4 right-4 text-white text-3xl hover:text-gray-300 transition">
                            <i class="fas fa-times"></i>
                        </button>
                        <button @click="prev()" class="absolute left-4 text-white text-3xl hover:text-gray-300 transition">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button @click="next()" class="absolute right-4 text-white text-3xl hover:text-gray-300 transition">
                            <i class="fas fa-chevron-right"></i>
                        </button>
                        <div class="max-w-5xl max-h-[90vh]">
                            <img :src="currentImage" :alt="currentTitle"
                                class="max-w-full max-h-[80vh] object-contain">
                            <p x-text="currentTitle" class="text-white text-center mt-4 text-lg"></p>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $galeris->withQueryString()->links() }}
                </div>
            @else
                <div class="text-center py-16 bg-white rounded-2xl shadow-sm">
                    <i class="fas fa-images text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">Tidak Ada Galeri</h3>
                    <p class="text-gray-500">
                        @if (request('kategori') || request('tipe'))
                            Tidak ditemukan galeri yang sesuai dengan filter Anda.
                        @else
                            Belum ada foto atau video yang diunggah.
                        @endif
                    </p>
                </div>
            @endif
        </div>
    </section>
@endsection

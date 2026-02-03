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
                    <a href="{{ route('galeri.index', ['kategori' => $kategori->slug]) }}"
                        class="px-6 py-2 rounded-lg font-medium transition {{ request('kategori') == $kategori->slug ? 'bg-primary-600 text-white' : 'bg-white text-gray-700 hover:bg-gray-100' }}">
                        {{ $kategori->nama }}
                    </a>
                @endforeach
            </div>

            @if ($galeris->count() > 0)
                <!-- Gallery Grid -->
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" x-data="{
                    lightbox: false,
                    currentMedia: null,
                    currentIndex: 0,
                    mediaList: {{ json_encode($galeris->map(fn($g) => [
                        'type' => $g->tipe,
                        'url' => $g->tipe === 'foto' ? Storage::url($g->file_path) : ($g->is_youtube ? $g->youtube_embed_url : Storage::url($g->file_path)),
                        'title' => $g->judul,
                        'is_youtube' => $g->is_youtube
                    ])->values()) }},
                    openLightbox(index) {
                        this.currentIndex = index;
                        this.currentMedia = this.mediaList[index];
                        this.lightbox = true;
                    },
                    next() {
                        this.currentIndex = (this.currentIndex + 1) % this.mediaList.length;
                        this.currentMedia = this.mediaList[this.currentIndex];
                    },
                    prev() {
                        this.currentIndex = this.currentIndex === 0 ? this.mediaList.length - 1 : this.currentIndex - 1;
                        this.currentMedia = this.mediaList[this.currentIndex];
                    }
                }">
                    @foreach ($galeris as $index => $galeri)
                        <div class="group relative aspect-square overflow-hidden rounded-xl bg-gray-100" data-aos="fade-up"
                            data-aos-delay="{{ ($index % 8) * 50 }}">
                            
                            <!-- Thumbnail with Fallback -->
                            <div class="w-full h-full bg-gray-200 flex items-center justify-center overflow-hidden">
                                @if($galeri->tipe === 'video' && !$galeri->thumbnail && !$galeri->is_youtube)
                                    <video class="w-full h-full object-cover group-hover:scale-110 transition duration-300" 
                                           preload="metadata" 
                                           muted 
                                           playsinline
                                           onmouseover="this.play()" 
                                           onmouseout="this.pause(); this.currentTime=0.1;">
                                        <source src="{{ $galeri->file_url }}#t=0.1" type="video/mp4">
                                    </video>
                                @else
                                    <img src="{{ $galeri->thumbnail_url }}" alt="{{ $galeri->judul }}"
                                        class="w-full h-full object-cover group-hover:scale-110 transition duration-300"
                                        @if($galeri->is_youtube)
                                            onerror="if(!this.src.includes('0.jpg')){ this.src='https://img.youtube.com/vi/{{ $galeri->youtube_video_id }}/0.jpg' } else { this.style.display='none'; this.nextElementSibling.style.display='flex'; }"
                                        @else
                                            onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';"
                                        @endif
                                    >
                                    <div class="hidden flex-col items-center justify-center text-gray-400 p-4">
                                        <i class="fas {{ $galeri->tipe === 'foto' ? 'fa-image' : 'fa-play-circle' }} text-4xl mb-2"></i>
                                        <span class="text-[10px] text-center uppercase font-bold">{{ $galeri->tipe === 'foto' ? 'Foto' : 'Video' }}</span>
                                    </div>
                                @endif
                            </div>
                            
                            <!-- Overlay -->
                            <div class="absolute inset-0 bg-black/0 group-hover:bg-black/50 transition flex items-center justify-center cursor-pointer"
                                @click="openLightbox({{ $index }})">
                                <div class="opacity-0 group-hover:opacity-100 transition text-white text-center px-4">
                                    @if($galeri->tipe === 'foto')
                                        <i class="fas fa-expand text-3xl mb-2"></i>
                                    @else
                                        <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-2 backdrop-blur-sm">
                                            <i class="fas fa-play text-xl ml-1"></i>
                                        </div>
                                    @endif
                                    <p class="font-medium line-clamp-2 text-sm">{{ $galeri->judul }}</p>
                                </div>
                            </div>

                            <!-- Badges -->
                            <div class="absolute top-2 left-2">
                                @if($galeri->tipe === 'video')
                                    <span class="inline-flex items-center px-2 py-1 bg-red-600 text-white text-[10px] font-bold rounded shadow-sm uppercase tracking-wider">
                                        <i class="fas fa-video mr-1"></i> Video
                                    </span>
                                @endif
                            </div>
                            <div class="absolute top-2 right-2">
                                @if ($galeri->kategori)
                                    <span class="inline-flex items-center px-2 py-1 bg-black/50 text-white text-[10px] font-bold rounded shadow-sm uppercase tracking-wider backdrop-blur-sm">
                                        {{ $galeri->kategori->nama }}
                                    </span>
                                @endif
                            </div>
                        </div>
                    @endforeach

                    <!-- Lightbox -->
                    <div x-show="lightbox" 
                        x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0"
                        x-transition:enter-end="opacity-100"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0"
                        x-cloak 
                        @keydown.escape.window="lightbox = false; currentMedia = null"
                        class="fixed inset-0 bg-black/95 z-[999] flex flex-col items-center justify-center p-4 md:p-10"
                        @click.self="lightbox = false; currentMedia = null">
                        
                        <!-- Close Button -->
                        <button @click="lightbox = false; currentMedia = null"
                            class="absolute top-6 right-6 text-white/70 hover:text-white text-3xl transition-colors z-[1000]">
                            <i class="fas fa-times"></i>
                        </button>

                        <!-- Navigation Buttons -->
                        <button @click="prev()" x-show="mediaList.length > 1"
                            class="absolute left-4 md:left-8 text-white/30 hover:text-white text-4xl transition-all z-50 p-4">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button @click="next()" x-show="mediaList.length > 1"
                            class="absolute right-4 md:right-8 text-white/30 hover:text-white text-4xl transition-all z-50 p-4">
                            <i class="fas fa-chevron-right"></i>
                        </button>

                        <!-- Media Content -->
                        <div class="w-full max-w-5xl h-full flex flex-col items-center justify-center" @click.stop>
                            <div class="relative w-full h-full flex items-center justify-center">
                                <!-- Image Display -->
                                <template x-if="currentMedia && currentMedia.type === 'foto'">
                                    <img :src="currentMedia.url" :alt="currentMedia.title"
                                        class="max-w-full max-h-full object-contain rounded shadow-2xl">
                                </template>

                                <!-- Video Display (YouTube) -->
                                <template x-if="currentMedia && currentMedia.type === 'video' && currentMedia.is_youtube">
                                    <div class="w-full aspect-video bg-black shadow-2xl rounded-xl overflow-hidden ring-1 ring-white/10">
                                        <iframe :src="currentMedia.url" class="w-full h-full" frameborder="0" 
                                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                            allowfullscreen></iframe>
                                    </div>
                                </template>

                                <!-- Video Display (Local) -->
                                <template x-if="currentMedia && currentMedia.type === 'video' && !currentMedia.is_youtube">
                                    <video :src="currentMedia.url" controls autoplay class="max-w-full max-h-full rounded shadow-2xl bg-black">
                                        Your browser does not support the video tag.
                                    </video>
                                </template>
                            </div>

                            <!-- Caption -->
                            <div class="w-full text-center mt-6">
                                <h3 x-text="currentMedia ? currentMedia.title : ''" class="text-white text-xl md:text-2xl font-bold tracking-tight"></h3>
                                <p class="text-gray-400 text-sm mt-2 font-medium" x-show="mediaList.length > 1" x-text="(currentIndex + 1) + ' / ' + mediaList.length"></p>
                            </div>
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

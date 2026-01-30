@extends('layouts.main')

@section('title', 'Galeri Video - Desa Tanalum')

@section('content')
    <!-- Hero Section -->
    <section class="relative py-16 bg-gradient-to-r from-green-600 to-green-700">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="container mx-auto px-4 relative">
            <div class="text-center text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Galeri Video</h1>
                <p class="text-xl text-green-100 mb-4">Video Dokumentasi Kegiatan Desa Tanalum</p>
                <!-- Breadcrumb -->
                <nav class="flex items-center justify-center text-sm">
                    <a href="{{ route('home') }}" class="text-green-200 hover:text-white">Beranda</a>
                    <span class="mx-2 text-green-300">/</span>
                    <a href="{{ route('galeri.index') }}" class="text-green-200 hover:text-white">Galeri</a>
                    <span class="mx-2 text-green-300">/</span>
                    <span class="text-white">Video</span>
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
                    class="px-6 py-4 text-gray-600 hover:text-green-600 font-medium border-b-2 border-transparent hover:border-green-600 transition-colors">
                    Foto
                </a>
                <a href="{{ route('galeri.video') }}"
                    class="px-6 py-4 text-green-600 font-medium border-b-2 border-green-600">
                    Video
                </a>
            </div>
        </div>
    </section>

    <!-- Video Grid -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            @if (isset($videos) && $videos->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($videos as $video)
                        <div class="bg-white rounded-xl shadow-sm overflow-hidden group">
                            <div class="relative aspect-video">
                                @if ($video->youtube_id)
                                    <img src="https://img.youtube.com/vi/{{ $video->youtube_id }}/maxresdefault.jpg"
                                        alt="{{ $video->judul }}" class="w-full h-full object-cover">
                                    <a href="https://www.youtube.com/watch?v={{ $video->youtube_id }}" target="_blank"
                                        class="absolute inset-0 flex items-center justify-center bg-black/30 group-hover:bg-black/50 transition-colors">
                                        <div class="w-16 h-16 bg-red-600 rounded-full flex items-center justify-center">
                                            <i class="fas fa-play text-white text-xl ml-1"></i>
                                        </div>
                                    </a>
                                @elseif($video->file_path)
                                    <video class="w-full h-full object-cover"
                                        poster="{{ $video->thumbnail ? Storage::url($video->thumbnail) : '' }}">
                                        <source src="{{ Storage::url($video->file_path) }}" type="video/mp4">
                                    </video>
                                    <button onclick="this.previousElementSibling.play(); this.style.display='none';"
                                        class="absolute inset-0 flex items-center justify-center bg-black/30 group-hover:bg-black/50 transition-colors">
                                        <div class="w-16 h-16 bg-green-600 rounded-full flex items-center justify-center">
                                            <i class="fas fa-play text-white text-xl ml-1"></i>
                                        </div>
                                    </button>
                                @else
                                    <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                        <i class="fas fa-video text-gray-400 text-4xl"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="p-4">
                                <h4 class="font-semibold text-gray-800 line-clamp-2 mb-2">{{ $video->judul }}</h4>
                                <p class="text-sm text-gray-500">{{ $video->created_at->format('d M Y') }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $videos->links() }}
                </div>
            @else
                <div class="text-center py-16">
                    <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-video text-gray-400 text-3xl"></i>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Belum Ada Video</h3>
                    <p class="text-gray-600">Galeri video belum tersedia.</p>
                </div>
            @endif
        </div>
    </section>
@endsection

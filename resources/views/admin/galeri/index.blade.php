@extends('layouts.admin')

@section('title', 'Manajemen Galeri')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Galeri</h1>
                <p class="text-gray-600">Kelola foto dan video desa</p>
            </div>
            <a href="{{ route('admin.galeri.create') }}"
                class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition">
                <i class="fas fa-plus mr-2"></i>
                Tambah Galeri
            </a>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <form action="{{ route('admin.galeri.index') }}" method="GET" class="grid md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Cari</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Judul galeri..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tipe</label>
                    <select name="tipe"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                        <option value="">Semua Tipe</option>
                        <option value="foto" {{ request('tipe') == 'foto' ? 'selected' : '' }}>Foto</option>
                        <option value="video" {{ request('tipe') == 'video' ? 'selected' : '' }}>Video</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                    <select name="kategori"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                        <option value="">Semua Kategori</option>
                        @foreach ($kategoris ?? [] as $kategori)
                            <option value="{{ $kategori }}" {{ request('kategori') == $kategori ? 'selected' : '' }}>
                                {{ $kategori }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex items-end gap-2">
                    <button type="submit"
                        class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition">
                        <i class="fas fa-search mr-1"></i> Filter
                    </button>
                    <a href="{{ route('admin.galeri.index') }}"
                        class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Gallery Grid -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 border border-green-200 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if ($galeris->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach ($galeris as $galeri)
                        <div class="group relative bg-gray-100 rounded-xl overflow-hidden aspect-square">
                            @if ($galeri->tipe == 'foto')
                                <img src="{{ $galeri->file_path ? Storage::url($galeri->file_path) : asset('img/placeholder.jpg') }}"
                                    alt="{{ $galeri->judul }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gray-800">
                                    @if($galeri->is_youtube)
                                        <img src="https://img.youtube.com/vi/{{ $galeri->youtube_video_id }}/hqdefault.jpg" 
                                             alt="{{ $galeri->judul }}" class="w-full h-full object-cover opacity-60">
                                    @elseif($galeri->thumbnail)
                                        <img src="{{ Storage::url($galeri->thumbnail) }}" 
                                             alt="{{ $galeri->judul }}" class="w-full h-full object-cover">
                                    @elseif($galeri->file_path)
                                        <video class="w-full h-full object-cover opacity-60" preload="metadata">
                                            <source src="{{ Storage::url($galeri->file_path) }}#t=0.1" type="video/mp4">
                                        </video>
                                    @endif
                                    
                                    <!-- Play Icon Overlay -->
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <div class="w-12 h-12 bg-white/20 rounded-full flex items-center justify-center backdrop-blur-sm">
                                            <i class="fas fa-play text-xl text-white ml-1"></i>
                                        </div>
                                    </div>
                                </div>
                            @endif

                            <!-- Overlay -->
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <div class="absolute bottom-0 left-0 right-0 p-4">
                                    <h4 class="text-white font-medium text-sm line-clamp-2 mb-2">{{ $galeri->judul }}</h4>
                                    <div class="flex items-center justify-between">
                                        <span class="text-white/70 text-xs">
                                            @if ($galeri->tipe == 'foto')
                                                <i class="fas fa-image mr-1"></i>
                                            @else
                                                <i class="fas fa-video mr-1"></i>
                                            @endif
                                            {{ ucfirst($galeri->tipe) }}
                                        </span>
                                        <div class="flex items-center gap-1">
                                            <a href="{{ route('admin.galeri.edit', $galeri->id) }}"
                                                class="p-2 bg-white/20 hover:bg-white/30 rounded-lg text-white transition"
                                                title="Edit">
                                                <i class="fas fa-edit text-sm"></i>
                                            </a>
                                            <form action="{{ route('admin.galeri.destroy', $galeri->id) }}" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus galeri ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit"
                                                    class="p-2 bg-red-500/80 hover:bg-red-600 rounded-lg text-white transition"
                                                    title="Hapus">
                                                    <i class="fas fa-trash text-sm"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Status Badge -->
                            @if (!$galeri->is_active)
                                <div class="absolute top-2 left-2">
                                    <span
                                        class="px-2 py-1 bg-yellow-500 text-white text-xs font-medium rounded">Draft</span>
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    {{ $galeris->withQueryString()->links() }}
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-images text-5xl text-gray-300 mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-600 mb-2">Belum Ada Galeri</h3>
                    <p class="text-gray-500 mb-4">Mulai dengan menambahkan foto atau video pertama.</p>
                    <a href="{{ route('admin.galeri.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Galeri
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection

@extends('layouts.admin')

@section('title', 'Sejarah Desa')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Sejarah Desa</h1>
            <p class="text-gray-600">Kelola konten sejarah desa: Cerita Rakyat dan Riwayat Kepemimpinan</p>
        </div>

        <!-- Tabs -->
        <div x-data="{ activeTab: 'cerita-rakyat' }">
            <div class="bg-white rounded-xl shadow-sm">
                <!-- Tab Navigation -->
                <div class="border-b border-gray-200">
                    <nav class="flex overflow-x-auto">
                        <button type="button" @click="activeTab = 'cerita-rakyat'"
                            :class="activeTab === 'cerita-rakyat' ? 'border-primary-500 text-primary-600' :
                                'border-transparent text-gray-500 hover:text-gray-700'"
                            class="px-6 py-4 text-sm font-medium border-b-2 whitespace-nowrap transition">
                            <i class="fas fa-book-reader mr-2"></i> Cerita Rakyat
                        </button>
                        <button type="button" @click="activeTab = 'kepala-desa'"
                            :class="activeTab === 'kepala-desa' ? 'border-primary-500 text-primary-600' :
                                'border-transparent text-gray-500 hover:text-gray-700'"
                            class="px-6 py-4 text-sm font-medium border-b-2 whitespace-nowrap transition">
                            <i class="fas fa-user-tie mr-2"></i> Riwayat Kepemimpinan
                        </button>
                    </nav>
                </div>

                <!-- Tab Content -->
                <div class="p-6">
                    <!-- Cerita Rakyat -->
                    <div x-show="activeTab === 'cerita-rakyat'" class="space-y-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">Cerita Rakyat - Cikal Bakal Desa Tanalum</h3>
                                <p class="text-sm text-gray-600">Kelola cerita rakyat dan legenda desa</p>
                            </div>
                            <a href="{{ route('admin.sejarah.cerita.create') }}"
                                class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition">
                                <i class="fas fa-plus mr-2"></i>
                                Tambah Cerita
                            </a>
                        </div>

                        <!-- Cerita List -->
                        <div class="space-y-4">
                            @forelse($ceritaRakyat ?? [] as $cerita)
                                <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                                    @if($cerita->gambar_utama)
                                        <div class="w-24 h-20 rounded-lg overflow-hidden bg-gray-200 flex-shrink-0">
                                            <img src="{{ Storage::url($cerita->gambar_utama) }}" alt="{{ $cerita->judul }}"
                                                class="w-full h-full object-cover">
                                        </div>
                                    @else
                                        <div class="w-24 h-20 rounded-lg bg-primary-100 flex items-center justify-center flex-shrink-0">
                                            <i class="fas fa-book text-2xl text-primary-600"></i>
                                        </div>
                                    @endif
                                    <div class="flex-1 min-w-0">
                                        <h4 class="font-semibold text-gray-800">{{ $cerita->judul }}</h4>
                                        <p class="text-sm text-gray-600 line-clamp-2 mt-1">
                                            {{ Str::limit(strip_tags($cerita->konten), 150) }}
                                        </p>
                                        <div class="flex items-center gap-3 mt-2">
                                            @if($cerita->is_active)
                                                <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-full">Aktif</span>
                                            @else
                                                <span class="px-2 py-1 bg-gray-100 text-gray-700 text-xs font-medium rounded-full">Nonaktif</span>
                                            @endif
                                            <span class="text-sm text-gray-500">Urutan: {{ $cerita->urutan }}</span>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('admin.sejarah.cerita.edit', $cerita) }}"
                                            class="p-2 text-gray-500 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.sejarah.cerita.destroy', $cerita) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus cerita ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition"
                                                title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <div class="text-center py-12">
                                    <i class="fas fa-book-reader text-4xl text-gray-300 mb-3"></i>
                                    <p class="text-gray-500">Belum ada cerita rakyat.</p>
                                    <a href="{{ route('admin.sejarah.cerita.create') }}"
                                        class="inline-flex items-center mt-4 text-primary-600 hover:text-primary-700">
                                        <i class="fas fa-plus mr-1"></i> Tambah cerita pertama
                                    </a>
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <!-- Kepala Desa -->
                    <div x-show="activeTab === 'kepala-desa'" class="space-y-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">Tanalum dalam Riwayat Kepemerintahan</h3>
                                <p class="text-sm text-gray-600">Daftar kepala desa dari tahun ke tahun</p>
                            </div>
                            <a href="{{ route('admin.sejarah.kepala.create') }}"
                                class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition">
                                <i class="fas fa-plus mr-2"></i>
                                Tambah Kepala Desa
                            </a>
                        </div>

                        <!-- Kepala Desa List -->
                        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                            @forelse($kepalaDesa ?? [] as $kepala)
                                <div class="bg-gray-50 rounded-xl p-4 hover:bg-gray-100 transition">
                                    <div class="flex items-start gap-4">
                                        @if($kepala->foto)
                                            <div class="w-20 h-24 rounded-lg overflow-hidden bg-gray-200 flex-shrink-0">
                                                <img src="{{ Storage::url($kepala->foto) }}" alt="{{ $kepala->nama }}"
                                                    class="w-full h-full object-cover">
                                            </div>
                                        @else
                                            <div class="w-20 h-24 rounded-lg bg-primary-100 flex items-center justify-center flex-shrink-0">
                                                <i class="fas fa-user text-2xl text-primary-600"></i>
                                            </div>
                                        @endif
                                        <div class="flex-1 min-w-0">
                                            <h4 class="font-semibold text-gray-800">{{ $kepala->nama }}</h4>
                                            <p class="text-sm text-primary-600 font-medium mt-1">
                                                {{ $kepala->periode }}
                                            </p>
                                            @if($kepala->keterangan)
                                                <p class="text-xs text-gray-500 mt-1 line-clamp-2">
                                                    {{ $kepala->keterangan }}
                                                </p>
                                            @endif
                                            @if($kepala->is_active)
                                                <span class="inline-flex mt-2 px-2 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-full">Aktif</span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-end gap-2 mt-3 pt-3 border-t border-gray-200">
                                        <a href="{{ route('admin.sejarah.kepala.edit', $kepala) }}"
                                            class="p-2 text-gray-500 hover:text-primary-600 hover:bg-white rounded-lg transition"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.sejarah.kepala.destroy', $kepala) }}" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus data kepala desa ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-gray-500 hover:text-red-600 hover:bg-white rounded-lg transition"
                                                title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            @empty
                                <div class="md:col-span-2 lg:col-span-3 text-center py-12">
                                    <i class="fas fa-user-tie text-4xl text-gray-300 mb-3"></i>
                                    <p class="text-gray-500">Belum ada data kepala desa.</p>
                                    <a href="{{ route('admin.sejarah.kepala.create') }}"
                                        class="inline-flex items-center mt-4 text-primary-600 hover:text-primary-700">
                                        <i class="fas fa-plus mr-1"></i> Tambah kepala desa pertama
                                    </a>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

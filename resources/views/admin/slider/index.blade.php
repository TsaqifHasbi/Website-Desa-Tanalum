@extends('layouts.admin')

@section('title', 'Manajemen Slider')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Slider Beranda</h1>
                <p class="text-gray-600">Kelola gambar slider halaman utama</p>
            </div>
            <a href="{{ route('admin.slider.create') }}"
                class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition">
                <i class="fas fa-plus mr-2"></i>
                Tambah Slider
            </a>
        </div>

        <!-- Sliders List -->
        <div class="bg-white rounded-xl shadow-sm">
            @if (session('success'))
                <div class="m-6 p-4 bg-green-100 border border-green-200 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if ($sliders->count() > 0)
                <div class="divide-y divide-gray-200" x-data="{ draggedItem: null }">
                    @foreach ($sliders as $slider)
                        <div class="p-6 flex flex-col md:flex-row md:items-center gap-4 hover:bg-gray-50 transition"
                            draggable="true">
                            <!-- Order Handle -->
                            <div class="flex items-center gap-3">
                                <div class="cursor-move text-gray-400 hover:text-gray-600">
                                    <i class="fas fa-grip-vertical text-lg"></i>
                                </div>
                                <span
                                    class="w-8 h-8 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center font-bold text-sm">
                                    {{ $slider->urutan ?? $loop->iteration }}
                                </span>
                            </div>

                            <!-- Image Preview -->
                            <div class="w-full md:w-48 h-28 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
                                @if ($slider->gambar)
                                    <img src="{{ Storage::url($slider->gambar) }}" alt="{{ $slider->judul }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <i class="fas fa-image text-3xl text-gray-300"></i>
                                    </div>
                                @endif
                            </div>

                            <!-- Content -->
                            <div class="flex-grow">
                                <h3 class="font-semibold text-gray-800">{{ $slider->judul ?? 'Tanpa Judul' }}</h3>
                                @if ($slider->deskripsi)
                                    <p class="text-gray-500 text-sm mt-1 line-clamp-2">{{ $slider->deskripsi }}</p>
                                @endif
                                @if ($slider->link)
                                    <a href="{{ $slider->link }}" target="_blank"
                                        class="text-primary-600 text-sm hover:underline mt-1 inline-block">
                                        <i class="fas fa-external-link-alt mr-1"></i> {{ Str::limit($slider->link, 40) }}
                                    </a>
                                @endif
                            </div>

                            <!-- Status -->
                            <div class="flex items-center gap-4">
                                @if ($slider->is_active)
                                    <span
                                        class="px-3 py-1 bg-green-100 text-green-700 text-sm font-medium rounded-full">Aktif</span>
                                @else
                                    <span
                                        class="px-3 py-1 bg-gray-100 text-gray-600 text-sm font-medium rounded-full">Nonaktif</span>
                                @endif
                            </div>

                            <!-- Actions -->
                            <div class="flex items-center gap-2">
                                <a href="{{ route('admin.slider.edit', $slider->id) }}"
                                    class="p-2 text-gray-500 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition"
                                    title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.slider.destroy', $slider->id) }}" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus slider ini?')">
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
                    @endforeach
                </div>

                <div class="p-4 bg-gray-50 border-t border-gray-200 rounded-b-xl">
                    <p class="text-sm text-gray-500">
                        <i class="fas fa-info-circle mr-1"></i>
                        Seret untuk mengubah urutan slider. Slider dengan urutan lebih kecil akan tampil lebih dulu.
                    </p>
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-images text-5xl text-gray-300 mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-600 mb-2">Belum Ada Slider</h3>
                    <p class="text-gray-500 mb-4">Tambahkan gambar slider untuk halaman beranda.</p>
                    <a href="{{ route('admin.slider.create') }}"
                        class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Slider
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection

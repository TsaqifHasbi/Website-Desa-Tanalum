@extends('layouts.admin')

@section('title', isset($berita) ? 'Edit Berita' : 'Tambah Berita')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">{{ isset($berita) ? 'Edit Berita' : 'Tambah Berita' }}</h1>
                <p class="text-gray-600">{{ isset($berita) ? 'Perbarui konten berita' : 'Buat berita atau artikel baru' }}
                </p>
            </div>
            <a href="{{ route('admin.berita.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>

        <!-- Form -->
        <form action="{{ isset($berita) ? route('admin.berita.update', $berita->id) : route('admin.berita.store') }}"
            method="POST" enctype="multipart/form-data">
            @csrf
            @if (isset($berita))
                @method('PUT')
            @endif

            <div class="grid lg:grid-cols-3 gap-6">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <!-- Judul -->
                        <div class="mb-6">
                            <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul Berita
                                *</label>
                            <input type="text" name="judul" id="judul"
                                value="{{ old('judul', $berita->judul ?? '') }}" required
                                class="w-full px-4 py-3 text-lg border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('judul') border-red-500 @enderror"
                                placeholder="Masukkan judul berita">
                            @error('judul')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Konten -->
                        <div>
                            <label for="konten" class="block text-sm font-medium text-gray-700 mb-1">Konten *</label>
                            <textarea name="konten" id="konten" rows="20"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('konten') border-red-500 @enderror"
                                placeholder="Tulis konten berita di sini...">{{ old('konten', $berita->konten ?? '') }}</textarea>
                            @error('konten')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            <p class="mt-1 text-sm text-gray-500">Anda dapat menggunakan format HTML untuk konten</p>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Publish -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h3 class="font-semibold text-gray-800 mb-4">Publikasi</h3>

                        <div class="space-y-4">
                            <div>
                                <label class="flex items-center">
                                    <input type="checkbox" name="is_published" value="1"
                                        {{ old('is_published', $berita->is_published ?? true) ? 'checked' : '' }}
                                        class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-2 text-gray-700">Publikasikan</span>
                                </label>
                            </div>

                            <div>
                                <label for="published_at" class="block text-sm font-medium text-gray-700 mb-1">Tanggal
                                    Publikasi</label>
                                <input type="datetime-local" name="published_at" id="published_at"
                                    value="{{ old('published_at', isset($berita->published_at) ? $berita->published_at->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')) }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                            </div>
                        </div>

                        <div class="mt-6 pt-4 border-t border-gray-200">
                            <button type="submit"
                                class="w-full px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition">
                                <i class="fas fa-save mr-2"></i>
                                {{ isset($berita) ? 'Update Berita' : 'Simpan Berita' }}
                            </button>
                        </div>
                    </div>

                    <!-- Kategori -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h3 class="font-semibold text-gray-800 mb-4">Kategori</h3>
                        <input type="text" name="kategori" id="kategori"
                            value="{{ old('kategori', $berita->kategori ?? '') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                            placeholder="Contoh: Pengumuman, Kegiatan" list="kategori-list">
                        <datalist id="kategori-list">
                            @foreach ($kategoris ?? [] as $kat)
                                <option value="{{ $kat }}">
                            @endforeach
                        </datalist>
                    </div>

                    <!-- Featured Image -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h3 class="font-semibold text-gray-800 mb-4">Gambar Utama</h3>

                        <div x-data="{ preview: '{{ isset($berita) && $berita->gambar ? Storage::url($berita->gambar) : '' }}' }">
                            <div class="aspect-video rounded-lg overflow-hidden bg-gray-100 mb-3" x-show="preview">
                                <img :src="preview" class="w-full h-full object-cover">
                            </div>

                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-primary-500 transition cursor-pointer"
                                onclick="document.getElementById('gambar').click()" x-show="!preview">
                                <i class="fas fa-image text-3xl text-gray-400 mb-2"></i>
                                <p class="text-sm text-gray-600">Klik untuk upload gambar</p>
                                <p class="text-xs text-gray-400 mt-1">JPG, PNG (Maks. 5MB)</p>
                            </div>

                            <input type="file" name="gambar" id="gambar" accept="image/*" class="hidden"
                                @change="preview = URL.createObjectURL($event.target.files[0])">

                            <button type="button" x-show="preview"
                                @click="preview = ''; document.getElementById('gambar').value = ''"
                                class="mt-2 text-sm text-red-600 hover:text-red-700">
                                <i class="fas fa-times mr-1"></i> Hapus gambar
                            </button>

                            @error('gambar')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Tags -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h3 class="font-semibold text-gray-800 mb-4">Tags</h3>
                        <input type="text" name="tags" id="tags"
                            value="{{ old('tags', isset($berita->tags) && is_array($berita->tags) ? implode(', ', $berita->tags) : '') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                            placeholder="Tag1, Tag2, Tag3">
                        <p class="mt-1 text-sm text-gray-500">Pisahkan dengan koma</p>
                    </div>

                    <!-- Author -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h3 class="font-semibold text-gray-800 mb-4">Penulis</h3>
                        <input type="text" name="penulis" id="penulis"
                            value="{{ old('penulis', $berita->penulis ?? (auth()->user()->name ?? 'Admin')) }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
    <script>
        // Optional: Add a simple WYSIWYG or enable TinyMCE/CKEditor for konten field
    </script>
@endpush

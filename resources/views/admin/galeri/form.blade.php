@extends('layouts.admin')

@section('title', isset($galeri) ? 'Edit Galeri' : 'Tambah Galeri')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">{{ isset($galeri) ? 'Edit Galeri' : 'Tambah Galeri' }}</h1>
                <p class="text-gray-600">{{ isset($galeri) ? 'Perbarui data galeri' : 'Upload foto atau video baru' }}</p>
            </div>
            <a href="{{ route('admin.galeri.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-xl shadow-sm">
            <form action="{{ isset($galeri) ? route('admin.galeri.update', $galeri->id) : route('admin.galeri.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($galeri))
                    @method('PUT')
                @endif

                <div class="p-6 space-y-6">
                    <!-- Tipe -->
                    <div x-data="{ tipe: '{{ old('tipe', $galeri->tipe ?? 'foto') }}' }">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Media *</label>
                        <div class="flex gap-4">
                            <label class="flex items-center">
                                <input type="radio" name="tipe" value="foto" x-model="tipe"
                                    class="w-4 h-4 text-primary-600 border-gray-300 focus:ring-primary-500">
                                <span class="ml-2 text-gray-700"><i class="fas fa-image mr-1"></i> Foto</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="tipe" value="video" x-model="tipe"
                                    class="w-4 h-4 text-primary-600 border-gray-300 focus:ring-primary-500">
                                <span class="ml-2 text-gray-700"><i class="fas fa-video mr-1"></i> Video</span>
                            </label>
                        </div>
                        @error('tipe')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Judul -->
                        <div>
                            <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul *</label>
                            <input type="text" name="judul" id="judul"
                                value="{{ old('judul', $galeri->judul ?? '') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('judul') border-red-500 @enderror"
                                placeholder="Masukkan judul galeri">
                            @error('judul')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kategori -->
                        <div>
                            <label for="kategori" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                            <input type="text" name="kategori" id="kategori"
                                value="{{ old('kategori', $galeri->kategori ?? '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                placeholder="Contoh: Kegiatan, Wisata, dll" list="kategori-list">
                            <datalist id="kategori-list">
                                @foreach ($kategoris ?? [] as $kat)
                                    <option value="{{ $kat }}">
                                @endforeach
                            </datalist>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="3"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                            placeholder="Keterangan singkat tentang galeri ini">{{ old('deskripsi', $galeri->deskripsi ?? '') }}</textarea>
                    </div>

                    <!-- File Upload -->
                    <div x-data="{
                        preview: '{{ isset($galeri) && $galeri->file ? Storage::url($galeri->file) : '' }}',
                        tipe: '{{ old('tipe', $galeri->tipe ?? 'foto') }}'
                    }">
                        <label class="block text-sm font-medium text-gray-700 mb-1">File Media
                            {{ isset($galeri) ? '' : '*' }}</label>

                        <div class="mt-2">
                            <!-- Preview for Photo -->
                            <template x-if="preview && tipe === 'foto'">
                                <div class="mb-4">
                                    <img :src="preview" class="max-w-xs rounded-lg shadow">
                                </div>
                            </template>

                            <!-- Preview for Video -->
                            <template x-if="preview && tipe === 'video'">
                                <div class="mb-4">
                                    <video :src="preview" controls class="max-w-md rounded-lg shadow"></video>
                                </div>
                            </template>

                            <input type="file" name="file" id="file" accept="image/*,video/*"
                                @change="
                                   if ($event.target.files[0]) {
                                       preview = URL.createObjectURL($event.target.files[0]);
                                       tipe = $event.target.files[0].type.startsWith('video') ? 'video' : 'foto';
                                   }
                               "
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('file') border-red-500 @enderror">
                            <p class="mt-1 text-sm text-gray-500">
                                Foto: JPG, PNG, WebP (Maks. 5MB) | Video: MP4, WebM (Maks. 50MB)
                            </p>
                            @error('file')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Video URL (Alternative) -->
                    <div x-show="tipe === 'video'" x-data="{ tipe: '{{ old('tipe', $galeri->tipe ?? 'foto') }}' }">
                        <label for="video_url" class="block text-sm font-medium text-gray-700 mb-1">URL Video
                            (Alternatif)</label>
                        <input type="url" name="video_url" id="video_url"
                            value="{{ old('video_url', $galeri->video_url ?? '') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                            placeholder="https://youtube.com/watch?v=...">
                        <p class="mt-1 text-sm text-gray-500">Masukkan URL YouTube atau Vimeo sebagai alternatif upload file
                        </p>
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" value="1"
                                {{ old('is_active', $galeri->is_active ?? true) ? 'checked' : '' }}
                                class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                            <span class="ml-2 text-gray-700">Aktif (Tampilkan di website)</span>
                        </label>
                    </div>
                </div>

                <!-- Footer -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 rounded-b-xl flex items-center justify-end gap-3">
                    <a href="{{ route('admin.galeri.index') }}"
                        class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition">
                        <i class="fas fa-save mr-2"></i>
                        {{ isset($galeri) ? 'Update' : 'Simpan' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

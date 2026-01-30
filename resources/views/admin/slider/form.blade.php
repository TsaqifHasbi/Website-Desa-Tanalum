@extends('layouts.admin')

@section('title', isset($slider) ? 'Edit Slider' : 'Tambah Slider')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">{{ isset($slider) ? 'Edit Slider' : 'Tambah Slider' }}</h1>
                <p class="text-gray-600">{{ isset($slider) ? 'Perbarui gambar slider' : 'Upload gambar slider baru' }}</p>
            </div>
            <a href="{{ route('admin.slider.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-xl shadow-sm">
            <form action="{{ isset($slider) ? route('admin.slider.update', $slider->id) : route('admin.slider.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($slider))
                    @method('PUT')
                @endif

                <div class="p-6 space-y-6">
                    <!-- Image Preview & Upload -->
                    <div x-data="{ preview: '{{ isset($slider) && $slider->gambar ? Storage::url($slider->gambar) : '' }}' }">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Slider
                            {{ isset($slider) ? '' : '*' }}</label>

                        <!-- Preview -->
                        <div class="mb-4" x-show="preview">
                            <img :src="preview" class="max-w-full md:max-w-2xl rounded-xl shadow-sm">
                        </div>

                        <!-- Upload Zone -->
                        <div class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-primary-500 transition cursor-pointer"
                            onclick="document.getElementById('gambar').click()">
                            <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-3"></i>
                            <p class="text-gray-600 mb-1">Klik atau drag & drop gambar di sini</p>
                            <p class="text-sm text-gray-400">Format: JPG, PNG, WebP | Ukuran: 1920x600px recommended | Maks.
                                5MB</p>
                        </div>

                        <input type="file" name="gambar" id="gambar" accept="image/*" class="hidden"
                            @change="preview = URL.createObjectURL($event.target.files[0])">
                        @error('gambar')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Judul -->
                        <div>
                            <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul</label>
                            <input type="text" name="judul" id="judul"
                                value="{{ old('judul', $slider->judul ?? '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                placeholder="Judul slider (opsional)">
                            @error('judul')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Urutan -->
                        <div>
                            <label for="urutan" class="block text-sm font-medium text-gray-700 mb-1">Urutan</label>
                            <input type="number" name="urutan" id="urutan"
                                value="{{ old('urutan', $slider->urutan ?? 1) }}" min="1"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                placeholder="1">
                            <p class="mt-1 text-sm text-gray-500">Slider dengan urutan lebih kecil tampil lebih dulu</p>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="3"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                            placeholder="Deskripsi singkat yang akan tampil di slider (opsional)">{{ old('deskripsi', $slider->deskripsi ?? '') }}</textarea>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Link -->
                        <div>
                            <label for="link" class="block text-sm font-medium text-gray-700 mb-1">Link Tujuan</label>
                            <input type="url" name="link" id="link"
                                value="{{ old('link', $slider->link ?? '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                placeholder="https://...">
                            <p class="mt-1 text-sm text-gray-500">URL yang dibuka saat slider diklik (opsional)</p>
                        </div>

                        <!-- Button Text -->
                        <div>
                            <label for="button_text" class="block text-sm font-medium text-gray-700 mb-1">Teks
                                Tombol</label>
                            <input type="text" name="button_text" id="button_text"
                                value="{{ old('button_text', $slider->button_text ?? '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                placeholder="Contoh: Selengkapnya">
                        </div>
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" value="1"
                                {{ old('is_active', $slider->is_active ?? true) ? 'checked' : '' }}
                                class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                            <span class="ml-2 text-gray-700">Aktif (Tampilkan slider ini)</span>
                        </label>
                    </div>
                </div>

                <!-- Footer -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 rounded-b-xl flex items-center justify-end gap-3">
                    <a href="{{ route('admin.slider.index') }}"
                        class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition">
                        <i class="fas fa-save mr-2"></i>
                        {{ isset($slider) ? 'Update' : 'Simpan' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

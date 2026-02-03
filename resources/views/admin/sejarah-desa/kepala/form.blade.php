@extends('layouts.admin')

@section('title', isset($kepala) ? 'Edit Kepala Desa' : 'Tambah Kepala Desa')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">{{ isset($kepala) ? 'Edit Kepala Desa' : 'Tambah Kepala Desa' }}</h1>
                <p class="text-gray-600">{{ isset($kepala) ? 'Perbarui data kepala desa' : 'Tambahkan data kepala desa baru' }}</p>
            </div>
            <a href="{{ route('admin.sejarah.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>

        <!-- Form -->
        <form action="{{ isset($kepala) ? route('admin.sejarah.kepala.update', $kepala) : route('admin.sejarah.kepala.store') }}" 
            method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($kepala))
                @method('PUT')
            @endif

            <div class="grid lg:grid-cols-3 gap-6">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-sm p-6 space-y-6">
                        <!-- Nama -->
                        <div>
                            <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap *</label>
                            <input type="text" name="nama" id="nama"
                                value="{{ old('nama', $kepala->nama ?? '') }}" required
                                class="w-full px-4 py-3 text-lg border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('nama') border-red-500 @enderror"
                                placeholder="Masukkan nama kepala desa">
                            @error('nama')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Periode -->
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label for="tahun_mulai" class="block text-sm font-medium text-gray-700 mb-1">Tahun Mulai Menjabat</label>
                                <input type="number" name="tahun_mulai" id="tahun_mulai"
                                    value="{{ old('tahun_mulai', $kepala->tahun_mulai ?? '') }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('tahun_mulai') border-red-500 @enderror"
                                    placeholder="Contoh: 1990" min="1800" max="{{ date('Y') + 10 }}">
                                @error('tahun_mulai')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label for="tahun_selesai" class="block text-sm font-medium text-gray-700 mb-1">Tahun Selesai Menjabat</label>
                                <input type="number" name="tahun_selesai" id="tahun_selesai"
                                    value="{{ old('tahun_selesai', $kepala->tahun_selesai ?? '') }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('tahun_selesai') border-red-500 @enderror"
                                    placeholder="Kosongkan jika masih menjabat" min="1800" max="{{ date('Y') + 10 }}">
                                @error('tahun_selesai')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                <p class="mt-1 text-sm text-gray-500">Kosongkan jika masih menjabat</p>
                            </div>
                        </div>

                        <!-- Keterangan -->
                        <div>
                            <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" rows="4"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('keterangan') border-red-500 @enderror"
                                placeholder="Informasi tambahan tentang kepala desa (opsional)">{{ old('keterangan', $kepala->keterangan ?? '') }}</textarea>
                            @error('keterangan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Publish -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h3 class="font-semibold text-gray-800 mb-4">Pengaturan</h3>

                        <div class="space-y-4">
                            <div>
                                <label for="urutan" class="block text-sm font-medium text-gray-700 mb-1">Urutan</label>
                                <input type="number" name="urutan" id="urutan"
                                    value="{{ old('urutan', $kepala->urutan ?? 0) }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                    min="0">
                                <p class="mt-1 text-sm text-gray-500">Semakin kecil semakin atas</p>
                            </div>

                            <div>
                                <label class="flex items-center">
                                    <input type="checkbox" name="is_active" value="1"
                                        {{ old('is_active', $kepala->is_active ?? true) ? 'checked' : '' }}
                                        class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-2 text-gray-700">Aktif (Tampilkan di website)</span>
                                </label>
                            </div>
                        </div>

                        <div class="mt-6 pt-4 border-t border-gray-200">
                            <button type="submit"
                                class="w-full px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition">
                                <i class="fas fa-save mr-2"></i>
                                {{ isset($kepala) ? 'Update Data' : 'Simpan Data' }}
                            </button>
                        </div>
                    </div>

                    <!-- Foto -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h3 class="font-semibold text-gray-800 mb-4">Foto Kepala Desa</h3>

                        <div x-data="{ preview: '{{ isset($kepala) && $kepala->foto ? Storage::url($kepala->foto) : '' }}' }">
                            <div class="w-full aspect-[3/4] rounded-lg overflow-hidden bg-gray-100 mb-3" x-show="preview">
                                <img :src="preview" class="w-full h-full object-cover">
                            </div>

                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-primary-500 transition cursor-pointer"
                                onclick="document.getElementById('foto').click()" x-show="!preview">
                                <i class="fas fa-user-circle text-4xl text-gray-400 mb-2"></i>
                                <p class="text-sm text-gray-600">Klik untuk upload foto</p>
                                <p class="text-xs text-gray-400 mt-1">JPG, PNG (Maks. 2MB)</p>
                            </div>

                            <input type="file" name="foto" id="foto" accept="image/*" class="hidden"
                                @change="preview = URL.createObjectURL($event.target.files[0])">

                            <button type="button" x-show="preview"
                                @click="preview = ''; document.getElementById('foto').value = ''"
                                class="mt-2 text-sm text-red-600 hover:text-red-700">
                                <i class="fas fa-times mr-1"></i> Hapus foto
                            </button>

                            @error('foto')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                        <p class="mt-3 text-sm text-gray-500">
                            <i class="fas fa-lightbulb mr-1 text-yellow-500"></i>
                            Gunakan foto dengan rasio 3:4 untuk hasil terbaik
                        </p>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

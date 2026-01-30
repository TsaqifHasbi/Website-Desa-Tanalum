@extends('layouts.admin')

@section('title', isset($produk) ? 'Edit Produk' : 'Tambah Produk')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">{{ isset($produk) ? 'Edit Produk' : 'Tambah Produk' }}</h1>
                <p class="text-gray-600">{{ isset($produk) ? 'Perbarui data produk UMKM' : 'Tambah produk UMKM baru' }}</p>
            </div>
            <a href="{{ route('admin.produk.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-xl shadow-sm">
            <form action="{{ isset($produk) ? route('admin.produk.update', $produk->id) : route('admin.produk.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($produk))
                    @method('PUT')
                @endif

                <div class="p-6 space-y-6">
                    <div class="grid lg:grid-cols-3 gap-6">
                        <!-- Left Column - Image -->
                        <div>
                            <div x-data="{ preview: '{{ isset($produk) && $produk->gambar ? Storage::url($produk->gambar) : '' }}' }">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Produk
                                    {{ isset($produk) ? '' : '*' }}</label>

                                <div class="aspect-square rounded-xl overflow-hidden bg-gray-100 mb-3" x-show="preview">
                                    <img :src="preview" class="w-full h-full object-cover">
                                </div>

                                <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-primary-500 transition cursor-pointer"
                                    onclick="document.getElementById('gambar').click()" x-show="!preview">
                                    <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                                    <p class="text-sm text-gray-600">Klik untuk upload gambar</p>
                                    <p class="text-xs text-gray-400 mt-1">JPG, PNG, WebP (Maks. 5MB)</p>
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

                        <!-- Right Column - Details -->
                        <div class="lg:col-span-2 space-y-6">
                            <div class="grid md:grid-cols-2 gap-6">
                                <!-- Nama -->
                                <div>
                                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Produk
                                        *</label>
                                    <input type="text" name="nama" id="nama"
                                        value="{{ old('nama', $produk->nama ?? '') }}" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('nama') border-red-500 @enderror"
                                        placeholder="Masukkan nama produk">
                                    @error('nama')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Kategori -->
                                <div>
                                    <label for="kategori" class="block text-sm font-medium text-gray-700 mb-1">Kategori
                                        *</label>
                                    <input type="text" name="kategori" id="kategori"
                                        value="{{ old('kategori', $produk->kategori ?? '') }}" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                        placeholder="Contoh: Makanan, Kerajinan, dll" list="kategori-list">
                                    <datalist id="kategori-list">
                                        @foreach ($kategoris ?? [] as $kat)
                                            <option value="{{ $kat }}">
                                        @endforeach
                                    </datalist>
                                </div>
                            </div>

                            <div class="grid md:grid-cols-2 gap-6">
                                <!-- Harga -->
                                <div>
                                    <label for="harga" class="block text-sm font-medium text-gray-700 mb-1">Harga (Rp)
                                        *</label>
                                    <input type="number" name="harga" id="harga"
                                        value="{{ old('harga', $produk->harga ?? '') }}" required min="0"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('harga') border-red-500 @enderror"
                                        placeholder="0">
                                    @error('harga')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Stok -->
                                <div>
                                    <label for="stok" class="block text-sm font-medium text-gray-700 mb-1">Stok</label>
                                    <input type="number" name="stok" id="stok"
                                        value="{{ old('stok', $produk->stok ?? '') }}" min="0"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                        placeholder="Kosongkan jika tidak terbatas">
                                </div>
                            </div>

                            <!-- Deskripsi -->
                            <div>
                                <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi
                                    *</label>
                                <textarea name="deskripsi" id="deskripsi" rows="4" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('deskripsi') border-red-500 @enderror"
                                    placeholder="Jelaskan detail produk...">{{ old('deskripsi', $produk->deskripsi ?? '') }}</textarea>
                                @error('deskripsi')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <hr class="border-gray-200">

                    <!-- Seller Info -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Penjual</h3>
                        <div class="grid md:grid-cols-3 gap-6">
                            <div>
                                <label for="nama_penjual" class="block text-sm font-medium text-gray-700 mb-1">Nama Penjual
                                    *</label>
                                <input type="text" name="nama_penjual" id="nama_penjual"
                                    value="{{ old('nama_penjual', $produk->nama_penjual ?? '') }}" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                            </div>
                            <div>
                                <label for="whatsapp" class="block text-sm font-medium text-gray-700 mb-1">No. WhatsApp
                                    *</label>
                                <input type="text" name="whatsapp" id="whatsapp"
                                    value="{{ old('whatsapp', $produk->whatsapp ?? '') }}" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                    placeholder="628xxxxxxxxxx">
                                <p class="mt-1 text-sm text-gray-500">Format: 628xxxxxxxxxx (tanpa + atau 0)</p>
                            </div>
                            <div>
                                <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                                <input type="text" name="alamat" id="alamat"
                                    value="{{ old('alamat', $produk->alamat ?? '') }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                    placeholder="Alamat penjual">
                            </div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" value="1"
                                {{ old('is_active', $produk->is_active ?? true) ? 'checked' : '' }}
                                class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                            <span class="ml-2 text-gray-700">Aktif (Tampilkan produk di website)</span>
                        </label>
                    </div>
                </div>

                <!-- Footer -->
                <div
                    class="px-6 py-4 bg-gray-50 border-t border-gray-200 rounded-b-xl flex items-center justify-end gap-3">
                    <a href="{{ route('admin.produk.index') }}"
                        class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition">
                        <i class="fas fa-save mr-2"></i>
                        {{ isset($produk) ? 'Update' : 'Simpan' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@extends('layouts.admin')

@section('title', 'Profil Desa')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Profil Desa</h1>
            <p class="text-gray-600">Kelola informasi profil desa</p>
        </div>

        <!-- Form -->
        <form action="{{ route('admin.profil.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @if (session('success'))
                <div class="p-4 bg-green-100 border border-green-200 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Tabs -->
            <div x-data="{ activeTab: 'umum' }">
                <div class="bg-white rounded-xl shadow-sm">
                    <!-- Tab Navigation -->
                    <div class="border-b border-gray-200">
                        <nav class="flex overflow-x-auto">
                            <button type="button" @click="activeTab = 'umum'"
                                :class="activeTab === 'umum' ? 'border-primary-500 text-primary-600' :
                                    'border-transparent text-gray-500 hover:text-gray-700'"
                                class="px-6 py-4 text-sm font-medium border-b-2 whitespace-nowrap transition">
                                <i class="fas fa-info-circle mr-2"></i> Umum
                            </button>
                            <button type="button" @click="activeTab = 'visi-misi'"
                                :class="activeTab === 'visi-misi' ? 'border-primary-500 text-primary-600' :
                                    'border-transparent text-gray-500 hover:text-gray-700'"
                                class="px-6 py-4 text-sm font-medium border-b-2 whitespace-nowrap transition">
                                <i class="fas fa-bullseye mr-2"></i> Visi & Misi
                            </button>
                            <button type="button" @click="activeTab = 'geografis'"
                                :class="activeTab === 'geografis' ? 'border-primary-500 text-primary-600' :
                                    'border-transparent text-gray-500 hover:text-gray-700'"
                                class="px-6 py-4 text-sm font-medium border-b-2 whitespace-nowrap transition">
                                <i class="fas fa-map mr-2"></i> Geografis
                            </button>
                            <button type="button" @click="activeTab = 'sejarah'"
                                :class="activeTab === 'sejarah' ? 'border-primary-500 text-primary-600' :
                                    'border-transparent text-gray-500 hover:text-gray-700'"
                                class="px-6 py-4 text-sm font-medium border-b-2 whitespace-nowrap transition">
                                <i class="fas fa-book mr-2"></i> Sejarah
                            </button>
                            <button type="button" @click="activeTab = 'media'"
                                :class="activeTab === 'media' ? 'border-primary-500 text-primary-600' :
                                    'border-transparent text-gray-500 hover:text-gray-700'"
                                class="px-6 py-4 text-sm font-medium border-b-2 whitespace-nowrap transition">
                                <i class="fas fa-image mr-2"></i> Media
                            </button>
                        </nav>
                    </div>

                    <!-- Tab Content -->
                    <div class="p-6">
                        <!-- Umum -->
                        <div x-show="activeTab === 'umum'" class="space-y-6">
                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label for="nama_desa" class="block text-sm font-medium text-gray-700 mb-1">Nama Desa
                                        *</label>
                                    <input type="text" name="nama_desa" id="nama_desa"
                                        value="{{ old('nama_desa', $profil->nama_desa ?? '') }}" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                </div>
                                <div>
                                    <label for="kode_desa" class="block text-sm font-medium text-gray-700 mb-1">Kode
                                        Desa</label>
                                    <input type="text" name="kode_desa" id="kode_desa"
                                        value="{{ old('kode_desa', $profil->kode_desa ?? '') }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                </div>
                            </div>

                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label for="kecamatan"
                                        class="block text-sm font-medium text-gray-700 mb-1">Kecamatan</label>
                                    <input type="text" name="kecamatan" id="kecamatan"
                                        value="{{ old('kecamatan', $profil->kecamatan ?? 'Marang Kayu') }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                </div>
                                <div>
                                    <label for="kabupaten"
                                        class="block text-sm font-medium text-gray-700 mb-1">Kabupaten</label>
                                    <input type="text" name="kabupaten" id="kabupaten"
                                        value="{{ old('kabupaten', $profil->kabupaten ?? 'Kutai Kartanegara') }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                </div>
                            </div>

                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label for="provinsi"
                                        class="block text-sm font-medium text-gray-700 mb-1">Provinsi</label>
                                    <input type="text" name="provinsi" id="provinsi"
                                        value="{{ old('provinsi', $profil->provinsi ?? 'Kalimantan Timur') }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                </div>
                                <div>
                                    <label for="kode_pos" class="block text-sm font-medium text-gray-700 mb-1">Kode
                                        Pos</label>
                                    <input type="text" name="kode_pos" id="kode_pos"
                                        value="{{ old('kode_pos', $profil->kode_pos ?? '') }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                </div>
                            </div>

                            <div>
                                <label for="alamat_kantor" class="block text-sm font-medium text-gray-700 mb-1">Alamat
                                    Kantor Desa</label>
                                <textarea name="alamat_kantor" id="alamat_kantor" rows="2"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">{{ old('alamat_kantor', $profil->alamat_kantor ?? '') }}</textarea>
                            </div>

                            <div class="grid md:grid-cols-3 gap-6">
                                <div>
                                    <label for="telepon"
                                        class="block text-sm font-medium text-gray-700 mb-1">Telepon</label>
                                    <input type="text" name="telepon" id="telepon"
                                        value="{{ old('telepon', $profil->telepon ?? '') }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                                    <input type="email" name="email" id="email"
                                        value="{{ old('email', $profil->email ?? '') }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                </div>
                                <div>
                                    <label for="website"
                                        class="block text-sm font-medium text-gray-700 mb-1">Website</label>
                                    <input type="url" name="website" id="website"
                                        value="{{ old('website', $profil->website ?? '') }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                </div>
                            </div>
                        </div>

                        <!-- Visi & Misi -->
                        <div x-show="activeTab === 'visi-misi'" class="space-y-6">
                            <div>
                                <label for="visi" class="block text-sm font-medium text-gray-700 mb-1">Visi</label>
                                <textarea name="visi" id="visi" rows="4"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">{{ old('visi', $profil->visi ?? '') }}</textarea>
                            </div>
                            <div>
                                <label for="misi" class="block text-sm font-medium text-gray-700 mb-1">Misi</label>
                                <textarea name="misi" id="misi" rows="8"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                    placeholder="Gunakan format list dengan tanda - atau nomor untuk setiap poin misi">{{ old('misi', $profil->misi ?? '') }}</textarea>
                                <p class="mt-1 text-sm text-gray-500">Tips: Tulis setiap poin misi di baris baru</p>
                            </div>
                        </div>

                        <!-- Geografis -->
                        <div x-show="activeTab === 'geografis'" class="space-y-6">
                            <div class="grid md:grid-cols-3 gap-6">
                                <div>
                                    <label for="luas_wilayah" class="block text-sm font-medium text-gray-700 mb-1">Luas
                                        Wilayah (Ha)</label>
                                    <input type="text" name="luas_wilayah" id="luas_wilayah"
                                        value="{{ old('luas_wilayah', $profil->luas_wilayah ?? '') }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                </div>
                                <div>
                                    <label for="ketinggian"
                                        class="block text-sm font-medium text-gray-700 mb-1">Ketinggian (mdpl)</label>
                                    <input type="text" name="ketinggian" id="ketinggian"
                                        value="{{ old('ketinggian', $profil->ketinggian ?? '') }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                </div>
                                <div>
                                    <label for="jumlah_dusun" class="block text-sm font-medium text-gray-700 mb-1">Jumlah
                                        Dusun</label>
                                    <input type="number" name="jumlah_dusun" id="jumlah_dusun"
                                        value="{{ old('jumlah_dusun', $profil->jumlah_dusun ?? '') }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                </div>
                            </div>

                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label for="batas_utara" class="block text-sm font-medium text-gray-700 mb-1">Batas
                                        Utara</label>
                                    <input type="text" name="batas_utara" id="batas_utara"
                                        value="{{ old('batas_utara', $profil->batas_utara ?? '') }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                </div>
                                <div>
                                    <label for="batas_timur" class="block text-sm font-medium text-gray-700 mb-1">Batas
                                        Timur</label>
                                    <input type="text" name="batas_timur" id="batas_timur"
                                        value="{{ old('batas_timur', $profil->batas_timur ?? '') }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                </div>
                            </div>

                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label for="batas_selatan" class="block text-sm font-medium text-gray-700 mb-1">Batas
                                        Selatan</label>
                                    <input type="text" name="batas_selatan" id="batas_selatan"
                                        value="{{ old('batas_selatan', $profil->batas_selatan ?? '') }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                </div>
                                <div>
                                    <label for="batas_barat" class="block text-sm font-medium text-gray-700 mb-1">Batas
                                        Barat</label>
                                    <input type="text" name="batas_barat" id="batas_barat"
                                        value="{{ old('batas_barat', $profil->batas_barat ?? '') }}"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                </div>
                            </div>

                            <div>
                                <label for="koordinat" class="block text-sm font-medium text-gray-700 mb-1">Koordinat
                                    (Lat, Lng)</label>
                                <input type="text" name="koordinat" id="koordinat"
                                    value="{{ old('koordinat', $profil->koordinat ?? '') }}"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                    placeholder="-0.xxxx, 117.xxxx">
                                <p class="mt-1 text-sm text-gray-500">Contoh: -0.4948, 117.1436</p>
                            </div>
                        </div>

                        <!-- Sejarah -->
                        <div x-show="activeTab === 'sejarah'" class="space-y-6">
                            <div>
                                <label for="sejarah" class="block text-sm font-medium text-gray-700 mb-1">Sejarah
                                    Desa</label>
                                <textarea name="sejarah" id="sejarah" rows="15"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">{{ old('sejarah', $profil->sejarah ?? '') }}</textarea>
                            </div>
                        </div>

                        <!-- Media -->
                        <div x-show="activeTab === 'media'" class="space-y-6">
                            <!-- Logo -->
                            <div x-data="{ preview: '{{ isset($profil) && $profil->logo ? Storage::url($profil->logo) : '' }}' }">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Logo Desa</label>
                                <div class="flex items-center gap-4">
                                    <div
                                        class="w-24 h-24 rounded-xl overflow-hidden bg-gray-100 flex items-center justify-center">
                                        <template x-if="preview">
                                            <img :src="preview" class="w-full h-full object-contain">
                                        </template>
                                        <template x-if="!preview">
                                            <i class="fas fa-image text-3xl text-gray-300"></i>
                                        </template>
                                    </div>
                                    <div>
                                        <input type="file" name="logo" id="logo" accept="image/*"
                                            class="hidden"
                                            @change="preview = URL.createObjectURL($event.target.files[0])">
                                        <label for="logo"
                                            class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition cursor-pointer">
                                            <i class="fas fa-upload mr-2"></i> Upload Logo
                                        </label>
                                        <p class="text-sm text-gray-500 mt-1">PNG, JPG (Maks. 2MB)</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Foto Kantor -->
                            <div x-data="{ preview: '{{ isset($profil) && $profil->foto_kantor ? Storage::url($profil->foto_kantor) : '' }}' }">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Foto Kantor Desa</label>
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-48 h-32 rounded-xl overflow-hidden bg-gray-100 flex items-center justify-center">
                                        <template x-if="preview">
                                            <img :src="preview" class="w-full h-full object-cover">
                                        </template>
                                        <template x-if="!preview">
                                            <i class="fas fa-building text-3xl text-gray-300"></i>
                                        </template>
                                    </div>
                                    <div>
                                        <input type="file" name="foto_kantor" id="foto_kantor" accept="image/*"
                                            class="hidden"
                                            @change="preview = URL.createObjectURL($event.target.files[0])">
                                        <label for="foto_kantor"
                                            class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition cursor-pointer">
                                            <i class="fas fa-upload mr-2"></i> Upload Foto
                                        </label>
                                        <p class="text-sm text-gray-500 mt-1">PNG, JPG (Maks. 5MB)</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Struktur Organisasi -->
                            <div x-data="{ preview: '{{ isset($profil) && $profil->struktur_organisasi ? Storage::url($profil->struktur_organisasi) : '' }}' }">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Struktur Organisasi</label>
                                <div class="flex items-start gap-4">
                                    <div
                                        class="w-64 h-40 rounded-xl overflow-hidden bg-gray-100 flex items-center justify-center">
                                        <template x-if="preview">
                                            <img :src="preview" class="w-full h-full object-contain">
                                        </template>
                                        <template x-if="!preview">
                                            <i class="fas fa-sitemap text-3xl text-gray-300"></i>
                                        </template>
                                    </div>
                                    <div>
                                        <input type="file" name="struktur_organisasi" id="struktur_organisasi"
                                            accept="image/*" class="hidden"
                                            @change="preview = URL.createObjectURL($event.target.files[0])">
                                        <label for="struktur_organisasi"
                                            class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition cursor-pointer">
                                            <i class="fas fa-upload mr-2"></i> Upload Gambar
                                        </label>
                                        <p class="text-sm text-gray-500 mt-1">PNG, JPG (Maks. 5MB)</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 rounded-b-xl flex items-center justify-end">
                        <button type="submit"
                            class="px-6 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition">
                            <i class="fas fa-save mr-2"></i>
                            Simpan Perubahan
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

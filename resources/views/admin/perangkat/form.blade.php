@extends('layouts.admin')

@section('title', isset($perangkat) ? 'Edit Perangkat' : 'Tambah Perangkat')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">{{ isset($perangkat) ? 'Edit Perangkat' : 'Tambah Perangkat' }}
                </h1>
                <p class="text-gray-600">
                    {{ isset($perangkat) ? 'Perbarui data perangkat desa' : 'Tambah data perangkat desa baru' }}</p>
            </div>
            <a href="{{ route('admin.perangkat.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-xl shadow-sm">
            <form
                action="{{ isset($perangkat) ? route('admin.perangkat.update', $perangkat->id) : route('admin.perangkat.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($perangkat))
                    @method('PUT')
                @endif

                <div class="p-6 space-y-6">
                    <!-- Foto -->
                    <div class="flex items-start gap-6" x-data="{ preview: '{{ isset($perangkat) && $perangkat->foto ? Storage::url($perangkat->foto) : '' }}' }">
                        <div
                            class="w-32 h-32 rounded-xl overflow-hidden bg-gray-100 flex items-center justify-center flex-shrink-0">
                            <template x-if="preview">
                                <img :src="preview" class="w-full h-full object-cover">
                            </template>
                            <template x-if="!preview">
                                <i class="fas fa-user text-4xl text-gray-300"></i>
                            </template>
                        </div>
                        <div>
                            <label for="foto"
                                class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition cursor-pointer">
                                <i class="fas fa-camera mr-2"></i>
                                Upload Foto
                            </label>
                            <input type="file" name="foto" id="foto" accept="image/*" class="hidden"
                                @change="preview = URL.createObjectURL($event.target.files[0])">
                            <p class="text-sm text-gray-500 mt-2">JPG, PNG, WebP (Maks. 2MB) | Rasio 1:1 (kotak)</p>
                            @error('foto')
                                <p class="text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <hr class="border-gray-200">

                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Nama -->
                        <div>
                            <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap
                                *</label>
                            <input type="text" name="nama" id="nama"
                                value="{{ old('nama', $perangkat->nama ?? '') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('nama') border-red-500 @enderror"
                                placeholder="Masukkan nama lengkap">
                            @error('nama')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jabatan -->
                        <div>
                            <label for="jabatan" class="block text-sm font-medium text-gray-700 mb-1">Jabatan *</label>
                            <input type="text" name="jabatan" id="jabatan"
                                value="{{ old('jabatan', $perangkat->jabatan ?? '') }}" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('jabatan') border-red-500 @enderror"
                                placeholder="Contoh: Sekretaris Desa">
                            @error('jabatan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="grid md:grid-cols-3 gap-6">
                        <!-- Kategori -->
                        <div>
                            <label for="kategori" class="block text-sm font-medium text-gray-700 mb-1">Kategori *</label>
                            <select name="kategori" id="kategori" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('kategori') border-red-500 @enderror">
                                <option value="">Pilih Kategori</option>
                                <option value="kepala_desa"
                                    {{ old('kategori', $perangkat->kategori ?? '') == 'kepala_desa' ? 'selected' : '' }}>
                                    Kepala Desa</option>
                                <option value="perangkat"
                                    {{ old('kategori', $perangkat->kategori ?? '') == 'perangkat' ? 'selected' : '' }}>
                                    Perangkat Desa</option>
                                <option value="bpd"
                                    {{ old('kategori', $perangkat->kategori ?? '') == 'bpd' ? 'selected' : '' }}>BPD
                                </option>
                                <option value="lembaga"
                                    {{ old('kategori', $perangkat->kategori ?? '') == 'lembaga' ? 'selected' : '' }}>
                                    Lembaga Desa</option>
                            </select>
                            @error('kategori')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- NIP -->
                        <div>
                            <label for="nip" class="block text-sm font-medium text-gray-700 mb-1">NIP</label>
                            <input type="text" name="nip" id="nip"
                                value="{{ old('nip', $perangkat->nip ?? '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                placeholder="Nomor Induk Pegawai">
                        </div>

                        <!-- Urutan -->
                        <div>
                            <label for="urutan" class="block text-sm font-medium text-gray-700 mb-1">Urutan</label>
                            <input type="number" name="urutan" id="urutan"
                                value="{{ old('urutan', $perangkat->urutan ?? 1) }}" min="1"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                            <p class="mt-1 text-sm text-gray-500">Urutan lebih kecil tampil lebih dulu</p>
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Tempat Lahir -->
                        <div>
                            <label for="tempat_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tempat
                                Lahir</label>
                            <input type="text" name="tempat_lahir" id="tempat_lahir"
                                value="{{ old('tempat_lahir', $perangkat->tempat_lahir ?? '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                        </div>

                        <!-- Tanggal Lahir -->
                        <div>
                            <label for="tanggal_lahir" class="block text-sm font-medium text-gray-700 mb-1">Tanggal
                                Lahir</label>
                            <input type="date" name="tanggal_lahir" id="tanggal_lahir"
                                value="{{ old('tanggal_lahir', isset($perangkat->tanggal_lahir) ? $perangkat->tanggal_lahir->format('Y-m-d') : '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Pendidikan -->
                        <div>
                            <label for="pendidikan" class="block text-sm font-medium text-gray-700 mb-1">Pendidikan
                                Terakhir</label>
                            <select name="pendidikan" id="pendidikan"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                <option value="">Pilih Pendidikan</option>
                                <option value="SD"
                                    {{ old('pendidikan', $perangkat->pendidikan ?? '') == 'SD' ? 'selected' : '' }}>SD
                                </option>
                                <option value="SMP"
                                    {{ old('pendidikan', $perangkat->pendidikan ?? '') == 'SMP' ? 'selected' : '' }}>SMP
                                </option>
                                <option value="SMA/SMK"
                                    {{ old('pendidikan', $perangkat->pendidikan ?? '') == 'SMA/SMK' ? 'selected' : '' }}>
                                    SMA/SMK</option>
                                <option value="D1"
                                    {{ old('pendidikan', $perangkat->pendidikan ?? '') == 'D1' ? 'selected' : '' }}>D1
                                </option>
                                <option value="D2"
                                    {{ old('pendidikan', $perangkat->pendidikan ?? '') == 'D2' ? 'selected' : '' }}>D2
                                </option>
                                <option value="D3"
                                    {{ old('pendidikan', $perangkat->pendidikan ?? '') == 'D3' ? 'selected' : '' }}>D3
                                </option>
                                <option value="S1"
                                    {{ old('pendidikan', $perangkat->pendidikan ?? '') == 'S1' ? 'selected' : '' }}>S1
                                </option>
                                <option value="S2"
                                    {{ old('pendidikan', $perangkat->pendidikan ?? '') == 'S2' ? 'selected' : '' }}>S2
                                </option>
                                <option value="S3"
                                    {{ old('pendidikan', $perangkat->pendidikan ?? '') == 'S3' ? 'selected' : '' }}>S3
                                </option>
                            </select>
                        </div>

                        <!-- Periode -->
                        <div>
                            <label for="periode" class="block text-sm font-medium text-gray-700 mb-1">Periode
                                Jabatan</label>
                            <input type="text" name="periode" id="periode"
                                value="{{ old('periode', $perangkat->periode ?? '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                placeholder="Contoh: 2021-2027">
                        </div>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Telepon -->
                        <div>
                            <label for="telepon" class="block text-sm font-medium text-gray-700 mb-1">No. Telepon</label>
                            <input type="text" name="telepon" id="telepon"
                                value="{{ old('telepon', $perangkat->telepon ?? '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                placeholder="08xxxxxxxxxx">
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" id="email"
                                value="{{ old('email', $perangkat->email ?? '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                placeholder="email@example.com">
                        </div>
                    </div>

                    <!-- Alamat -->
                    <div>
                        <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                        <textarea name="alamat" id="alamat" rows="2"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                            placeholder="Alamat lengkap">{{ old('alamat', $perangkat->alamat ?? '') }}</textarea>
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" value="1"
                                {{ old('is_active', $perangkat->is_active ?? true) ? 'checked' : '' }}
                                class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                            <span class="ml-2 text-gray-700">Aktif (Tampilkan di website)</span>
                        </label>
                    </div>
                </div>

                <!-- Footer -->
                <div
                    class="px-6 py-4 bg-gray-50 border-t border-gray-200 rounded-b-xl flex items-center justify-end gap-3">
                    <a href="{{ route('admin.perangkat.index') }}"
                        class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition">
                        <i class="fas fa-save mr-2"></i>
                        {{ isset($perangkat) ? 'Update' : 'Simpan' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

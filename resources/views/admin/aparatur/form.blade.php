@extends('layouts.admin')

@section('title', isset($aparatur) ? 'Edit Aparatur' : 'Tambah Aparatur')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.aparatur.index') }}" class="text-green-600 hover:text-green-700">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
    </div>

    <div class="max-w-4xl">
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="p-6 border-b border-gray-200">
                <h2 class="text-xl font-semibold text-gray-800">
                    {{ isset($aparatur) ? 'Edit Data Aparatur' : 'Tambah Aparatur Baru' }}
                </h2>
            </div>

            <form action="{{ isset($aparatur) ? route('admin.aparatur.update', $aparatur) : route('admin.aparatur.store') }}"
                method="POST" enctype="multipart/form-data" class="p-6">
                @csrf
                @if (isset($aparatur))
                    @method('PUT')
                @endif

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama -->
                    <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                            Nama Lengkap <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama" id="nama" value="{{ old('nama', $aparatur->nama ?? '') }}"
                            required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                        @error('nama')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- NIP -->
                    <div>
                        <label for="nip" class="block text-sm font-medium text-gray-700 mb-2">
                            NIP
                        </label>
                        <input type="text" name="nip" id="nip" value="{{ old('nip', $aparatur->nip ?? '') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                        @error('nip')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jabatan -->
                    <div>
                        <label for="jabatan" class="block text-sm font-medium text-gray-700 mb-2">
                            Jabatan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="jabatan" id="jabatan"
                            value="{{ old('jabatan', $aparatur->jabatan ?? '') }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                        @error('jabatan')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Jenis -->
                    <div>
                        <label for="jenis" class="block text-sm font-medium text-gray-700 mb-2">
                            Jenis/Kategori <span class="text-red-500">*</span>
                        </label>
                        <select name="jenis" id="jenis" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                            <option value="">Pilih Jenis</option>
                            <option value="perangkat"
                                {{ old('jenis', $aparatur->jenis ?? '') == 'perangkat' ? 'selected' : '' }}>Perangkat Desa
                            </option>
                            <option value="bpd" {{ old('jenis', $aparatur->jenis ?? '') == 'bpd' ? 'selected' : '' }}>
                                BPD</option>
                            <option value="lpm" {{ old('jenis', $aparatur->jenis ?? '') == 'lpm' ? 'selected' : '' }}>
                                LPM</option>
                            <option value="pkk" {{ old('jenis', $aparatur->jenis ?? '') == 'pkk' ? 'selected' : '' }}>
                                PKK</option>
                            <option value="karang_taruna"
                                {{ old('jenis', $aparatur->jenis ?? '') == 'karang_taruna' ? 'selected' : '' }}>Karang
                                Taruna</option>
                            <option value="lembaga_lain"
                                {{ old('jenis', $aparatur->jenis ?? '') == 'lembaga_lain' ? 'selected' : '' }}>Lembaga Lain
                            </option>
                        </select>
                        @error('jenis')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Pendidikan -->
                    <div>
                        <label for="pendidikan" class="block text-sm font-medium text-gray-700 mb-2">
                            Pendidikan Terakhir
                        </label>
                        <input type="text" name="pendidikan" id="pendidikan"
                            value="{{ old('pendidikan', $aparatur->pendidikan ?? '') }}" placeholder="contoh: S1 Hukum"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                        @error('pendidikan')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Masa Jabatan -->
                    <div>
                        <label for="masa_jabatan" class="block text-sm font-medium text-gray-700 mb-2">
                            Masa Jabatan
                        </label>
                        <input type="text" name="masa_jabatan" id="masa_jabatan"
                            value="{{ old('masa_jabatan', $aparatur->masa_jabatan ?? '') }}"
                            placeholder="contoh: 2021 - 2027"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                        @error('masa_jabatan')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Telepon -->
                    <div>
                        <label for="telepon" class="block text-sm font-medium text-gray-700 mb-2">
                            Nomor Telepon
                        </label>
                        <input type="text" name="telepon" id="telepon"
                            value="{{ old('telepon', $aparatur->telepon ?? '') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                        @error('telepon')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                            Email
                        </label>
                        <input type="email" name="email" id="email"
                            value="{{ old('email', $aparatur->email ?? '') }}"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                        @error('email')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Urutan -->
                    <div>
                        <label for="urutan" class="block text-sm font-medium text-gray-700 mb-2">
                            Urutan Tampil
                        </label>
                        <input type="number" name="urutan" id="urutan"
                            value="{{ old('urutan', $aparatur->urutan ?? 0) }}" min="0"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                        <p class="mt-1 text-xs text-gray-500">Angka lebih kecil akan tampil lebih dulu</p>
                    </div>

                    <!-- Status -->
                    <div class="flex items-center pt-8">
                        <input type="checkbox" name="is_active" id="is_active" value="1"
                            {{ old('is_active', $aparatur->is_active ?? true) ? 'checked' : '' }}
                            class="rounded border-gray-300 text-green-600 focus:ring-green-500 mr-2">
                        <label for="is_active" class="text-sm font-medium text-gray-700">
                            Aktif (tampil di website)
                        </label>
                    </div>
                </div>

                <!-- Alamat -->
                <div class="mt-6">
                    <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">
                        Alamat
                    </label>
                    <textarea name="alamat" id="alamat" rows="2"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">{{ old('alamat', $aparatur->alamat ?? '') }}</textarea>
                    @error('alamat')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Tugas Pokok -->
                <div class="mt-6">
                    <label for="tugas_pokok" class="block text-sm font-medium text-gray-700 mb-2">
                        Tugas Pokok & Fungsi
                    </label>
                    <textarea name="tugas_pokok" id="tugas_pokok" rows="4"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">{{ old('tugas_pokok', $aparatur->tugas_pokok ?? '') }}</textarea>
                    @error('tugas_pokok')
                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Foto -->
                <div class="mt-6">
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Foto
                    </label>
                    <div class="flex items-start gap-6">
                        @if (isset($aparatur) && $aparatur->foto)
                            <div class="flex-shrink-0">
                                <img src="{{ Storage::url($aparatur->foto) }}" alt="{{ $aparatur->nama }}"
                                    class="w-32 h-32 rounded-lg object-cover border">
                                <p class="text-xs text-gray-500 mt-1">Foto saat ini</p>
                            </div>
                        @endif
                        <div class="flex-1">
                            <input type="file" name="foto" accept="image/jpeg,image/png,image/jpg"
                                class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                            <p class="mt-1 text-xs text-gray-500">Format: JPG, PNG. Maksimal 2MB. Disarankan rasio 1:1
                                (persegi).</p>
                            @error('foto')
                                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end gap-4">
                    <a href="{{ route('admin.aparatur.index') }}"
                        class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                        Batal
                    </a>
                    <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                        <i class="fas fa-save mr-2"></i>
                        {{ isset($aparatur) ? 'Update' : 'Simpan' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

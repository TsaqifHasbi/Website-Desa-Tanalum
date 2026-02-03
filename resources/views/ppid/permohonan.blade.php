@extends('layouts.app')

@section('title', 'Form Permohonan Informasi - PPID')

@section('content')
    <!-- Header -->
    <section class="bg-gradient-to-r from-green-600 to-green-700 py-12">
        <div class="container mx-auto px-4">
            <nav class="text-sm text-green-100 mb-4">
                <a href="{{ route('home') }}" class="hover:text-white">Home</a>
                <span class="mx-2">/</span>
                <a href="{{ route('ppid.index') }}" class="hover:text-white">PPID</a>
                <span class="mx-2">/</span>
                <span class="text-white">Permohonan Informasi</span>
            </nav>
            <h1 class="text-3xl md:text-4xl font-bold text-white">Form Permohonan Informasi</h1>
            <p class="text-green-100 mt-2">Ajukan permohonan informasi publik kepada PPID Desa Tanalum</p>
        </div>
    </section>

    <!-- Form Section -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto">
                @if (session('success'))
                    <div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-700 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-xl mr-3"></i>
                            <div>
                                <p class="font-semibold">Permohonan Berhasil Dikirim!</p>
                                <p class="text-sm">{{ session('success') }}</p>
                                @if (session('nomor_tiket'))
                                    <p class="text-sm mt-2">Nomor Tiket: <strong>{{ session('nomor_tiket') }}</strong></p>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                <div class="bg-white rounded-xl shadow-sm p-8">
                    <form action="{{ route('ppid.permohonan.submit') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="space-y-6">
                            <!-- Data Pemohon -->
                            <div class="border-b pb-6">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                                    <i class="fas fa-user text-green-600 mr-2"></i>
                                    Data Pemohon
                                </h3>

                                <div class="grid md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="nama_pemohon" class="block text-sm font-medium text-gray-700 mb-1">Nama
                                            Lengkap *</label>
                                        <input type="text" name="nama_pemohon" id="nama_pemohon" value="{{ old('nama_pemohon') }}"
                                            required
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('nama_pemohon') border-red-500 @enderror">
                                        @error('nama_pemohon')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="nik" class="block text-sm font-medium text-gray-700 mb-1">NIK
                                            *</label>
                                        <input type="text" name="nik" id="nik" value="{{ old('nik') }}"
                                            required maxlength="16"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('nik') border-red-500 @enderror"
                                            placeholder="16 digit NIK">
                                        @error('nik')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email
                                            *</label>
                                        <input type="email" name="email" id="email" value="{{ old('email') }}"
                                            required
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('email') border-red-500 @enderror">
                                        @error('email')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="telepon" class="block text-sm font-medium text-gray-700 mb-1">No.
                                            Telepon/HP *</label>
                                        <input type="text" name="telepon" id="telepon" value="{{ old('telepon') }}"
                                            required
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('telepon') border-red-500 @enderror">
                                        @error('telepon')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div class="md:col-span-2">
                                        <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat
                                            *</label>
                                        <textarea name="alamat" id="alamat" rows="2" required
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('alamat') border-red-500 @enderror">{{ old('alamat') }}</textarea>
                                        @error('alamat')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="pekerjaan"
                                            class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan</label>
                                        <input type="text" name="pekerjaan" id="pekerjaan"
                                            value="{{ old('pekerjaan') }}"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                    </div>
                                </div>
                            </div>

                            <!-- Rincian Informasi -->
                            <div class="border-b pb-6">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                                    <i class="fas fa-file-alt text-green-600 mr-2"></i>
                                    Rincian Informasi yang Dimohon
                                </h3>

                                <div class="space-y-4">


                                    <div>
                                        <label for="informasi_diminta"
                                            class="block text-sm font-medium text-gray-700 mb-1">Rincian Informasi yang
                                            Dibutuhkan *</label>
                                        <textarea name="informasi_diminta" id="informasi_diminta" rows="4" required
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('informasi_diminta') border-red-500 @enderror"
                                            placeholder="Jelaskan secara detail informasi yang Anda butuhkan...">{{ old('informasi_diminta') }}</textarea>
                                        @error('informasi_diminta')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="alasan_permohonan" class="block text-sm font-medium text-gray-700 mb-1">Tujuan
                                            Penggunaan Informasi *</label>
                                        <textarea name="alasan_permohonan" id="alasan_permohonan" rows="3" required
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 @error('alasan_permohonan') border-red-500 @enderror"
                                            placeholder="Jelaskan tujuan penggunaan informasi...">{{ old('alasan_permohonan') }}</textarea>
                                        @error('alasan_permohonan')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <!-- Cara Memperoleh Informasi -->
                            <div class="border-b pb-6">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                                    <i class="fas fa-paper-plane text-green-600 mr-2"></i>
                                    Cara Memperoleh Informasi
                                </h3>

                                <div class="space-y-3">
                                    <label
                                        class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer">
                                        <input type="radio" name="cara_memperoleh" value="melihat"
                                            {{ old('cara_memperoleh', 'melihat') == 'melihat' ? 'checked' : '' }}
                                            class="w-4 h-4 text-green-600 border-gray-300 focus:ring-green-500">
                                        <span class="ml-3 text-gray-700">Melihat/Membaca/Mendengarkan/Mencatat</span>
                                    </label>
                                    <label
                                        class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer">
                                        <input type="radio" name="cara_memperoleh" value="mendapat_salinan"
                                            {{ old('cara_memperoleh') == 'mendapat_salinan' ? 'checked' : '' }}
                                            class="w-4 h-4 text-green-600 border-gray-300 focus:ring-green-500">
                                        <span class="ml-3 text-gray-700">Mendapatkan salinan informasi
                                            (softcopy/hardcopy)</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Cara Mendapat Salinan -->
                            <div class="border-b pb-6">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                                    <i class="fas fa-inbox text-green-600 mr-2"></i>
                                    Cara Mendapatkan Salinan Informasi
                                </h3>

                                <div class="space-y-3">
                                    <label
                                        class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer">
                                        <input type="radio" name="cara_mendapat_salinan" value="ambil_langsung"
                                            {{ old('cara_mendapat_salinan', 'ambil_langsung') == 'ambil_langsung' ? 'checked' : '' }}
                                            class="w-4 h-4 text-green-600 border-gray-300 focus:ring-green-500">
                                        <span class="ml-3 text-gray-700">Mengambil langsung di kantor desa</span>
                                    </label>
                                    <label
                                        class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer">
                                        <input type="radio" name="cara_mendapat_salinan" value="email"
                                            {{ old('cara_mendapat_salinan') == 'email' ? 'checked' : '' }}
                                            class="w-4 h-4 text-green-600 border-gray-300 focus:ring-green-500">
                                        <span class="ml-3 text-gray-700">Dikirim via email</span>
                                    </label>
                                    <label
                                        class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer">
                                        <input type="radio" name="cara_mendapat_salinan" value="pos"
                                            {{ old('cara_mendapat_salinan') == 'pos' ? 'checked' : '' }}
                                            class="w-4 h-4 text-green-600 border-gray-300 focus:ring-green-500">
                                        <span class="ml-3 text-gray-700">Dikirim via pos/kurir</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Dokumen Pendukung -->
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                                    <i class="fas fa-upload text-green-600 mr-2"></i>
                                    Dokumen Pendukung (Opsional)
                                </h3>

                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                                    <input type="file" name="dokumen_pendukung" id="dokumen_pendukung" class="hidden"
                                        accept=".pdf,.jpg,.jpeg,.png">
                                    <label for="dokumen_pendukung" class="cursor-pointer">
                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                                        <p class="text-gray-600">Klik untuk upload dokumen pendukung</p>
                                        <p class="text-sm text-gray-400 mt-1">PDF, JPG, PNG (Maks. 5MB)</p>
                                    </label>
                                </div>
                            </div>

                            <!-- Submit -->
                            <div class="flex items-center justify-between pt-6 border-t">
                                <a href="{{ route('ppid.index') }}"
                                    class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition">
                                    <i class="fas fa-arrow-left mr-2"></i>
                                    Kembali
                                </a>
                                <button type="submit"
                                    class="px-8 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition">
                                    <i class="fas fa-paper-plane mr-2"></i>
                                    Kirim Permohonan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Information Box -->
                <div class="mt-8 bg-blue-50 rounded-xl p-6">
                    <h4 class="font-semibold text-blue-800 mb-3">
                        <i class="fas fa-info-circle mr-2"></i>
                        Informasi Penting
                    </h4>
                    <ul class="text-blue-700 text-sm space-y-2">
                        <li>• Permohonan informasi akan diproses dalam waktu 10 hari kerja sejak diterima.</li>
                        <li>• Anda akan menerima notifikasi melalui email yang didaftarkan.</li>
                        <li>• Pastikan data yang diisi benar dan valid.</li>
                        <li>• Untuk informasi lebih lanjut, hubungi kantor desa.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection

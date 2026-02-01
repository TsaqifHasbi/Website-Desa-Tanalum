@extends('layouts.app')

@section('title', 'Pengaduan')

@section('content')
    <!-- Hero Section -->
    <section class="relative py-20 bg-gradient-to-r from-primary-600 to-primary-700">
        <div class="container mx-auto px-4">
            <div class="text-center text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Layanan Pengaduan</h1>
                <p class="text-lg text-primary-100">Sampaikan keluhan atau saran Anda kepada kami</p>
            </div>
        </div>
    </section>

    <!-- Breadcrumb -->
    <div class="bg-white shadow-sm">
        <div class="container mx-auto px-4">
            <nav class="flex items-center space-x-2 py-4 text-sm">
                <a href="{{ route('home') }}" class="text-gray-500 hover:text-primary-600">Beranda</a>
                <span class="text-gray-400">/</span>
                <span class="text-primary-600 font-medium">Pengaduan</span>
            </nav>
        </div>
    </div>

    <!-- Content -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Form -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-2xl shadow-sm p-8" data-aos="fade-up">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Form Pengaduan</h2>

                        @if (session('success'))
                            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                                <div class="flex items-center text-green-600">
                                    <i class="fas fa-check-circle mr-2"></i>
                                    <span>{{ session('success') }}</span>
                                </div>
                                @if (session('kode_pengaduan'))
                                    <p class="mt-2 text-green-700">
                                        Kode Pengaduan Anda: <strong
                                            class="font-mono">{{ session('kode_pengaduan') }}</strong>
                                    </p>
                                    <p class="text-sm text-green-600 mt-1">Simpan kode ini untuk melacak status pengaduan
                                        Anda.</p>
                                @endif
                            </div>
                        @endif

                        @if ($errors->any())
                            <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-lg">
                                <div class="flex items-start text-red-600">
                                    <i class="fas fa-exclamation-circle mr-2 mt-0.5"></i>
                                    <div>
                                        <p class="font-medium">Terdapat kesalahan pada form:</p>
                                        <ul class="list-disc list-inside mt-1 text-sm">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endif

                        <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="grid md:grid-cols-2 gap-6">
                                <div>
                                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap
                                        <span class="text-red-500">*</span></label>
                                    <input type="text" name="nama" id="nama" value="{{ old('nama') }}" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('nama') border-red-500 @enderror">
                                </div>
                                <div>
                                    <label for="nik" class="block text-sm font-medium text-gray-700 mb-2">NIK</label>
                                    <input type="text" name="nik" id="nik" value="{{ old('nik') }}"
                                        maxlength="16"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('nik') border-red-500 @enderror"
                                        placeholder="16 digit NIK">
                                </div>
                            </div>

                            <div class="grid md:grid-cols-2 gap-6 mt-6">
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('email') border-red-500 @enderror">
                                </div>
                                <div>
                                    <label for="telepon" class="block text-sm font-medium text-gray-700 mb-2">No.
                                        Telepon/WA <span class="text-red-500">*</span></label>
                                    <input type="text" name="telepon" id="telepon" value="{{ old('telepon') }}"
                                        required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('telepon') border-red-500 @enderror">
                                </div>
                            </div>

                            <div class="mt-6">
                                <label for="alamat" class="block text-sm font-medium text-gray-700 mb-2">Alamat</label>
                                <textarea name="alamat" id="alamat" rows="2"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('alamat') border-red-500 @enderror">{{ old('alamat') }}</textarea>
                            </div>

                            <div class="mt-6">
                                <label for="kategori" class="block text-sm font-medium text-gray-700 mb-2">Kategori
                                    Pengaduan <span class="text-red-500">*</span></label>
                                <select name="kategori" id="kategori" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('kategori') border-red-500 @enderror">
                                    <option value="">Pilih Kategori</option>
                                    <option value="pelayanan" {{ old('kategori') == 'pelayanan' ? 'selected' : '' }}>
                                        Pelayanan Publik</option>
                                    <option value="infrastruktur"
                                        {{ old('kategori') == 'infrastruktur' ? 'selected' : '' }}>Infrastruktur</option>
                                    <option value="sosial" {{ old('kategori') == 'sosial' ? 'selected' : '' }}>Masalah
                                        Sosial</option>
                                    <option value="keamanan" {{ old('kategori') == 'keamanan' ? 'selected' : '' }}>Keamanan
                                        & Ketertiban</option>
                                    <option value="lingkungan" {{ old('kategori') == 'lingkungan' ? 'selected' : '' }}>
                                        Lingkungan</option>
                                    <option value="lainnya" {{ old('kategori') == 'lainnya' ? 'selected' : '' }}>Lainnya
                                    </option>
                                </select>
                            </div>

                            <div class="mt-6">
                                <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">Judul Pengaduan
                                    <span class="text-red-500">*</span></label>
                                <input type="text" name="judul" id="judul" value="{{ old('judul') }}" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('judul') border-red-500 @enderror">
                            </div>

                            <div class="mt-6">
                                <label for="isi_pengaduan" class="block text-sm font-medium text-gray-700 mb-2">Isi
                                    Pengaduan
                                    <span class="text-red-500">*</span></label>
                                <textarea name="isi_pengaduan" id="isi_pengaduan" rows="5" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('isi_pengaduan') border-red-500 @enderror"
                                    placeholder="Jelaskan pengaduan Anda secara detail...">{{ old('isi_pengaduan') }}</textarea>
                            </div>

                            <div class="mt-6">
                                <label for="lampiran" class="block text-sm font-medium text-gray-700 mb-2">Lampiran
                                    (Opsional)</label>
                                <input type="file" name="lampiran" id="lampiran" accept=".jpg,.jpeg,.png,.pdf"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('lampiran') border-red-500 @enderror">
                                <p class="text-sm text-gray-500 mt-1">Format: JPG, PNG, PDF. Maksimal 2MB</p>
                            </div>

                            <div class="mt-6">
                                <label class="flex items-start">
                                    <input type="checkbox" name="persetujuan" required class="mt-1 mr-2">
                                    <span class="text-sm text-gray-600">Saya menyatakan bahwa informasi yang saya berikan
                                        adalah benar dan dapat dipertanggungjawabkan. <span
                                            class="text-red-500">*</span></span>
                                </label>
                            </div>

                            <button type="submit"
                                class="w-full mt-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-lg transition">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Kirim Pengaduan
                            </button>
                        </form>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Track Pengaduan -->
                    <div class="bg-white rounded-2xl shadow-sm p-6" data-aos="fade-left">
                        <h3 class="font-bold text-gray-800 mb-4">Lacak Pengaduan</h3>
                        <form action="{{ route('pengaduan.index') }}" method="GET" id="trackForm">
                            <div class="mb-4">
                                <label for="nomor_tiket" class="block text-sm font-medium text-gray-700 mb-2">Kode
                                    Pengaduan</label>
                                <input type="text" name="nomor_tiket" id="nomor_tiket" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                    placeholder="Masukkan kode...">
                            </div>
                            <button type="button" onclick="trackPengaduan()"
                                class="w-full py-2 bg-gray-800 hover:bg-gray-900 text-white font-medium rounded-lg transition">
                                <i class="fas fa-search mr-2"></i>
                                Lacak
                            </button>
                        </form>
                        <script>
                            function trackPengaduan() {
                                var kode = document.getElementById('nomor_tiket').value;
                                if (kode) {
                                    window.location.href = '{{ url('pengaduan/cek') }}/' + kode;
                                }
                            }
                        </script>
                    </div>

                    <!-- Info -->
                    <div class="bg-blue-50 border border-blue-200 rounded-2xl p-6" data-aos="fade-left"
                        data-aos-delay="100">
                        <div class="flex items-start">
                            <div
                                class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-4 flex-shrink-0">
                                <i class="fas fa-info text-blue-600"></i>
                            </div>
                            <div>
                                <h4 class="font-semibold text-blue-800 mb-2">Informasi</h4>
                                <ul class="text-sm text-blue-700 space-y-1">
                                    <li>• Pengaduan akan diproses dalam 1-7 hari kerja</li>
                                    <li>• Anda akan mendapat notifikasi via WA/email</li>
                                    <li>• Simpan kode pengaduan untuk melacak status</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Contact -->
                    <div class="bg-white rounded-2xl shadow-sm p-6" data-aos="fade-left" data-aos-delay="200">
                        <h3 class="font-bold text-gray-800 mb-4">Kontak Langsung</h3>
                        <div class="space-y-4">
                            <a href="tel:{{ $profil->telepon ?? '' }}"
                                class="flex items-center text-gray-600 hover:text-primary-600 transition">
                                <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-phone text-primary-600"></i>
                                </div>
                                <span>{{ $profil->telepon ?? '-' }}</span>
                            </a>
                            <a href="mailto:{{ $profil->email ?? '' }}"
                                class="flex items-center text-gray-600 hover:text-primary-600 transition">
                                <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center mr-3">
                                    <i class="fas fa-envelope text-primary-600"></i>
                                </div>
                                <span>{{ $profil->email ?? '-' }}</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@extends('layouts.admin')

@section('title', isset($dokumen) ? 'Edit Dokumen' : 'Upload Dokumen')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">{{ isset($dokumen) ? 'Edit Dokumen' : 'Upload Dokumen' }}</h1>
                <p class="text-gray-600">{{ isset($dokumen) ? 'Perbarui data dokumen' : 'Tambah dokumen PPID baru' }}</p>
            </div>
            <a href="{{ route('admin.dokumen.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-xl shadow-sm">
            <form action="{{ isset($dokumen) ? route('admin.dokumen.update', $dokumen->id) : route('admin.dokumen.store') }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($dokumen))
                    @method('PUT')
                @endif

                <div class="p-6 space-y-6">
                    <!-- Judul -->
                    <div>
                        <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul Dokumen *</label>
                        <input type="text" name="judul" id="judul"
                            value="{{ old('judul', $dokumen->judul ?? '') }}" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 @error('judul') border-red-500 @enderror"
                            placeholder="Masukkan judul dokumen">
                        @error('judul')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Jenis Informasi -->
                        <div>
                            <label for="jenis" class="block text-sm font-medium text-gray-700 mb-1">Jenis Informasi
                                *</label>
                            <select name="jenis" id="jenis" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                <option value="">Pilih Jenis</option>
                                <option value="berkala"
                                    {{ old('jenis', $dokumen->jenis ?? '') == 'berkala' ? 'selected' : '' }}>Informasi
                                    Berkala</option>
                                <option value="serta_merta"
                                    {{ old('jenis', $dokumen->jenis ?? '') == 'serta_merta' ? 'selected' : '' }}>Informasi
                                    Serta Merta</option>
                                <option value="setiap_saat"
                                    {{ old('jenis', $dokumen->jenis ?? '') == 'setiap_saat' ? 'selected' : '' }}>Informasi
                                    Setiap Saat</option>
                            </select>
                            @error('jenis')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Kategori -->
                        <div>
                            <label for="kategori" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                            <select name="kategori" id="kategori"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                <option value="">Pilih Kategori</option>
                                <option value="Peraturan, Keputusan, dan/atau Kebijakan"
                                    {{ old('kategori', $dokumen->kategori ?? '') == 'Peraturan, Keputusan, dan/atau Kebijakan' ? 'selected' : '' }}>
                                    Peraturan, Keputusan, dan/atau Kebijakan</option>
                                <option value="Daftar Informasi Publik"
                                    {{ old('kategori', $dokumen->kategori ?? '') == 'Daftar Informasi Publik' ? 'selected' : '' }}>
                                    Daftar Informasi Publik</option>
                                <option value="Laporan Keuangan"
                                    {{ old('kategori', $dokumen->kategori ?? '') == 'Laporan Keuangan' ? 'selected' : '' }}>
                                    Laporan Keuangan</option>
                                <option value="Profil dan Kegiatan"
                                    {{ old('kategori', $dokumen->kategori ?? '') == 'Profil dan Kegiatan' ? 'selected' : '' }}>
                                    Profil dan Kegiatan</option>
                                <option value="Lainnya"
                                    {{ old('kategori', $dokumen->kategori ?? '') == 'Lainnya' ? 'selected' : '' }}>Lainnya
                                </option>
                            </select>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="3"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                            placeholder="Deskripsi singkat tentang dokumen ini...">{{ old('deskripsi', $dokumen->deskripsi ?? '') }}</textarea>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Tanggal Dokumen -->
                        <div>
                            <label for="tanggal" class="block text-sm font-medium text-gray-700 mb-1">Tanggal
                                Dokumen</label>
                            <input type="date" name="tanggal" id="tanggal"
                                value="{{ old('tanggal', isset($dokumen->tanggal) ? $dokumen->tanggal->format('Y-m-d') : '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                        </div>

                        <!-- Nomor Dokumen -->
                        <div>
                            <label for="nomor" class="block text-sm font-medium text-gray-700 mb-1">Nomor Dokumen</label>
                            <input type="text" name="nomor" id="nomor"
                                value="{{ old('nomor', $dokumen->nomor ?? '') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                placeholder="Contoh: 77/SK-BUP/HK/2025">
                        </div>
                    </div>

                    <!-- File Upload -->
                    <div x-data="{ fileName: '{{ isset($dokumen) && $dokumen->file ? basename($dokumen->file) : '' }}' }">
                        <label class="block text-sm font-medium text-gray-700 mb-2">File Dokumen
                            {{ isset($dokumen) ? '' : '*' }}</label>

                        @if (isset($dokumen) && $dokumen->file)
                            <div class="mb-3 p-4 bg-gray-50 rounded-lg flex items-center justify-between">
                                <div class="flex items-center">
                                    <i class="fas fa-file-pdf text-red-500 text-2xl mr-3"></i>
                                    <div>
                                        <p class="font-medium text-gray-800">{{ basename($dokumen->file) }}</p>
                                        <p class="text-sm text-gray-500">File saat ini</p>
                                    </div>
                                </div>
                                <a href="{{ Storage::url($dokumen->file) }}" target="_blank"
                                    class="px-3 py-1 bg-blue-100 text-blue-600 rounded-lg hover:bg-blue-200 transition text-sm">
                                    <i class="fas fa-eye mr-1"></i> Lihat
                                </a>
                            </div>
                        @endif

                        <div class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-primary-500 transition cursor-pointer"
                            onclick="document.getElementById('file').click()">
                            <input type="file" name="file" id="file" class="hidden"
                                accept=".pdf,.doc,.docx,.xls,.xlsx" @change="fileName = $event.target.files[0]?.name || ''">
                            <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                            <p class="text-gray-600" x-text="fileName || 'Klik untuk upload file'"></p>
                            <p class="text-sm text-gray-400 mt-1">PDF, DOC, DOCX, XLS, XLSX (Maks. 10MB)</p>
                        </div>

                        @error('file')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" value="1"
                                {{ old('is_active', $dokumen->is_active ?? true) ? 'checked' : '' }}
                                class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                            <span class="ml-2 text-gray-700">Aktif (Tampilkan di website)</span>
                        </label>
                    </div>
                </div>

                <!-- Footer -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 rounded-b-xl flex items-center justify-end gap-3">
                    <a href="{{ route('admin.dokumen.index') }}"
                        class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition">
                        <i class="fas fa-save mr-2"></i>
                        {{ isset($dokumen) ? 'Update' : 'Simpan' }}
                    </button>
                </div>
            </form>
        </div>

        <!-- Info Box -->
        <div class="bg-blue-50 rounded-xl p-6">
            <h4 class="font-semibold text-blue-800 mb-3">
                <i class="fas fa-info-circle mr-2"></i>
                Panduan Upload Dokumen PPID
            </h4>
            <ul class="text-blue-700 text-sm space-y-2">
                <li><strong>Informasi Berkala:</strong> Informasi yang wajib diumumkan secara berkala (minimal 1x setahun).
                </li>
                <li><strong>Informasi Serta Merta:</strong> Informasi yang wajib diumumkan tanpa penundaan karena bersifat
                    mendesak.</li>
                <li><strong>Informasi Setiap Saat:</strong> Informasi yang wajib tersedia setiap saat dan dapat diakses
                    publik.</li>
            </ul>
        </div>
    </div>
@endsection

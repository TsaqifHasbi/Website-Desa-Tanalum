@extends('layouts.admin')

@section('title', isset($dokumen) ? 'Edit Dokumen PPID' : 'Tambah Dokumen PPID')

@section('content')
<div class="mb-6">
    <a href="{{ route('admin.ppid.index') }}" class="text-green-600 hover:text-green-700">
        <i class="fas fa-arrow-left mr-2"></i>Kembali
    </a>
</div>

<div class="max-w-3xl">
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-xl font-semibold text-gray-800">
                {{ isset($dokumen) ? 'Edit Dokumen PPID' : 'Tambah Dokumen PPID' }}
            </h2>
        </div>
        
        <form action="{{ isset($dokumen) ? route('admin.ppid.dokumen.update', $dokumen) : route('admin.ppid.dokumen.store') }}" 
              method="POST" 
              enctype="multipart/form-data"
              class="p-6">
            @csrf
            @if(isset($dokumen))
            @method('PUT')
            @endif
            
            <div class="space-y-6">
                <!-- Nama Dokumen -->
                <div>
                    <label for="judul" class="block text-sm font-medium text-gray-700 mb-2">
                        Nama Dokumen <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="judul" id="judul" 
                           value="{{ old('judul', $dokumen->judul ?? '') }}" required
                           class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                    @error('judul')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Kategori -->
                <div>
                    <label for="kategori_id" class="block text-sm font-medium text-gray-700 mb-2">
                        Kategori <span class="text-red-500">*</span>
                    </label>
                    <select name="kategori_id" id="kategori_id" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                        <option value="">Pilih Kategori</option>
                        @foreach($kategoris as $kategori)
                        <option value="{{ $kategori->id }}" {{ old('kategori_id', $dokumen->kategori_id ?? '') == $kategori->id ? 'selected' : '' }}>
                            {{ $kategori->nama }} ({{ ucfirst(str_replace('_', ' ', $kategori->jenis)) }})
                        </option>
                        @endforeach
                    </select>
                    @error('kategori_id')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nomor Dokumen -->
                    <div>
                        <label for="nomor_dokumen" class="block text-sm font-medium text-gray-700 mb-2">
                            Nomor Dokumen
                        </label>
                        <input type="text" name="nomor_dokumen" id="nomor_dokumen" 
                               value="{{ old('nomor_dokumen', $dokumen->nomor_dokumen ?? '') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                    </div>
                    
                    <!-- Tanggal Dokumen -->
                    <div>
                        <label for="tanggal_dokumen" class="block text-sm font-medium text-gray-700 mb-2">
                            Tanggal Dokumen
                        </label>
                        <input type="date" name="tanggal_dokumen" id="tanggal_dokumen" 
                               value="{{ old('tanggal_dokumen', isset($dokumen->tanggal_dokumen) ? $dokumen->tanggal_dokumen->format('Y-m-d') : '') }}"
                               class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                    </div>
                </div>
                
                <!-- Deskripsi -->
                <div>
                    <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">
                        Deskripsi
                    </label>
                    <textarea name="deskripsi" id="deskripsi" rows="3"
                              class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">{{ old('deskripsi', $dokumen->deskripsi ?? '') }}</textarea>
                </div>
                
                <!-- File Upload -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        File Dokumen @if(!isset($dokumen))<span class="text-red-500">*</span>@endif
                    </label>
                    
                    @if(isset($dokumen) && $dokumen->file_path)
                    <div class="mb-4 p-4 bg-gray-50 rounded-lg flex items-center justify-between">
                        <div class="flex items-center">
                            <i class="fas fa-file-pdf text-red-500 text-2xl mr-3"></i>
                            <div>
                                <p class="text-sm font-medium text-gray-800">File saat ini</p>
                                <p class="text-xs text-gray-500">{{ number_format($dokumen->file_size / 1024, 0) }} KB</p>
                            </div>
                        </div>
                        <a href="{{ Storage::url($dokumen->file_path) }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                            <i class="fas fa-external-link-alt"></i>
                        </a>
                    </div>
                    @endif
                    
                    <input type="file" name="file" accept=".pdf,.doc,.docx,.xls,.xlsx"
                           {{ !isset($dokumen) ? 'required' : '' }}
                           class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                    <p class="mt-1 text-xs text-gray-500">Format: PDF, DOC, DOCX, XLS, XLSX. Maksimal 10MB.</p>
                    @error('file')
                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                    @enderror
                </div>
                
                <!-- Status -->
                <div class="flex items-center">
                    <input type="checkbox" name="is_active" id="is_active" value="1"
                           {{ old('is_active', $dokumen->is_active ?? true) ? 'checked' : '' }}
                           class="rounded border-gray-300 text-green-600 focus:ring-green-500 mr-2">
                    <label for="is_active" class="text-sm font-medium text-gray-700">
                        Aktif (tampil di halaman PPID)
                    </label>
                </div>
            </div>
            
            <!-- Actions -->
            <div class="mt-8 pt-6 border-t border-gray-200 flex justify-end gap-4">
                <a href="{{ route('admin.ppid.index') }}" 
                   class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                    Batal
                </a>
                <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    <i class="fas fa-save mr-2"></i>
                    {{ isset($dokumen) ? 'Update' : 'Simpan' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

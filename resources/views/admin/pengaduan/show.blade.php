@extends('layouts.admin')

@section('title', 'Detail Pengaduan')

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Detail Pengaduan</h1>
                <p class="text-gray-600">Kode: <span class="font-mono text-primary-600">{{ $pengaduan->kode_tracking }}</span>
                </p>
            </div>
            <a href="{{ route('admin.pengaduan.index') }}"
                class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>

        @if (session('success'))
            <div class="p-4 bg-green-100 border border-green-200 text-green-700 rounded-lg">
                {{ session('success') }}
            </div>
        @endif

        <div class="grid lg:grid-cols-3 gap-6">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Pengaduan Detail -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex items-start justify-between mb-4">
                        <h3 class="text-lg font-semibold text-gray-800">Isi Pengaduan</h3>
                        @php
                            $statusColors = [
                                'pending' => 'bg-yellow-100 text-yellow-700',
                                'proses' => 'bg-blue-100 text-blue-700',
                                'selesai' => 'bg-green-100 text-green-700',
                                'ditolak' => 'bg-red-100 text-red-700',
                            ];
                            $statusLabels = [
                                'pending' => 'Menunggu',
                                'proses' => 'Diproses',
                                'selesai' => 'Selesai',
                                'ditolak' => 'Ditolak',
                            ];
                        @endphp
                        <span
                            class="px-3 py-1 text-sm font-medium rounded-full {{ $statusColors[$pengaduan->status] ?? 'bg-gray-100 text-gray-700' }}">
                            {{ $statusLabels[$pengaduan->status] ?? $pengaduan->status }}
                        </span>
                    </div>

                    <div class="prose max-w-none text-gray-700">
                        {!! nl2br(e($pengaduan->isi)) !!}
                    </div>

                    @if ($pengaduan->lampiran)
                        <div class="mt-6 pt-4 border-t border-gray-100">
                            <p class="text-sm text-gray-500 mb-2">Lampiran:</p>
                            <a href="{{ Storage::url($pengaduan->lampiran) }}" target="_blank"
                                class="inline-flex items-center px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg transition">
                                <i class="fas fa-paperclip mr-2"></i>
                                Lihat Lampiran
                            </a>
                        </div>
                    @endif
                </div>

                <!-- Response Form -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Tanggapan</h3>

                    <form action="{{ route('admin.pengaduan.respond', $pengaduan->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="space-y-4">
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status *</label>
                                <select name="status" id="status" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                    <option value="pending" {{ $pengaduan->status == 'pending' ? 'selected' : '' }}>Menunggu
                                    </option>
                                    <option value="proses" {{ $pengaduan->status == 'proses' ? 'selected' : '' }}>Diproses
                                    </option>
                                    <option value="selesai" {{ $pengaduan->status == 'selesai' ? 'selected' : '' }}>Selesai
                                    </option>
                                    <option value="ditolak" {{ $pengaduan->status == 'ditolak' ? 'selected' : '' }}>Ditolak
                                    </option>
                                </select>
                            </div>

                            <div>
                                <label for="tanggapan"
                                    class="block text-sm font-medium text-gray-700 mb-1">Tanggapan</label>
                                <textarea name="tanggapan" id="tanggapan" rows="5"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                    placeholder="Tulis tanggapan untuk pengaduan ini...">{{ old('tanggapan', $pengaduan->tanggapan ?? '') }}</textarea>
                            </div>

                            <div class="flex justify-end">
                                <button type="submit"
                                    class="px-6 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition">
                                    <i class="fas fa-save mr-2"></i>
                                    Simpan Tanggapan
                                </button>
                            </div>
                        </div>
                    </form>

                    @if ($pengaduan->tanggapan && $pengaduan->responded_at)
                        <div class="mt-6 pt-4 border-t border-gray-100">
                            <p class="text-sm text-gray-500 mb-2">Tanggapan terakhir
                                ({{ $pengaduan->responded_at->format('d M Y H:i') }}):</p>
                            <div class="bg-green-50 p-4 rounded-lg text-green-800">
                                {!! nl2br(e($pengaduan->tanggapan)) !!}
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Pelapor Info -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="font-semibold text-gray-800 mb-4">Informasi Pelapor</h3>
                    <div class="space-y-3">
                        <div>
                            <p class="text-sm text-gray-500">Nama</p>
                            <p class="font-medium text-gray-800">{{ $pengaduan->nama }}</p>
                        </div>
                        @if ($pengaduan->nik)
                            <div>
                                <p class="text-sm text-gray-500">NIK</p>
                                <p class="font-mono text-gray-800">{{ $pengaduan->nik }}</p>
                            </div>
                        @endif
                        @if ($pengaduan->email)
                            <div>
                                <p class="text-sm text-gray-500">Email</p>
                                <p class="text-gray-800">{{ $pengaduan->email }}</p>
                            </div>
                        @endif
                        @if ($pengaduan->telepon)
                            <div>
                                <p class="text-sm text-gray-500">Telepon</p>
                                <p class="text-gray-800">{{ $pengaduan->telepon }}</p>
                            </div>
                        @endif
                        @if ($pengaduan->alamat)
                            <div>
                                <p class="text-sm text-gray-500">Alamat</p>
                                <p class="text-gray-800">{{ $pengaduan->alamat }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Timeline -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="font-semibold text-gray-800 mb-4">Timeline</h3>
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div
                                class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                                <i class="fas fa-check text-green-600 text-sm"></i>
                            </div>
                            <div>
                                <p class="font-medium text-gray-800">Pengaduan Dibuat</p>
                                <p class="text-sm text-gray-500">{{ $pengaduan->created_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>

                        @if ($pengaduan->status != 'pending')
                            <div class="flex items-start">
                                <div
                                    class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                                    <i class="fas fa-eye text-blue-600 text-sm"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">Pengaduan Dibaca</p>
                                    <p class="text-sm text-gray-500">{{ $pengaduan->updated_at->format('d M Y, H:i') }}</p>
                                </div>
                            </div>
                        @endif

                        @if ($pengaduan->responded_at)
                            <div class="flex items-start">
                                <div
                                    class="w-8 h-8 bg-primary-100 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                                    <i class="fas fa-reply text-primary-600 text-sm"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">Ditanggapi</p>
                                    <p class="text-sm text-gray-500">{{ $pengaduan->responded_at->format('d M Y, H:i') }}
                                    </p>
                                </div>
                            </div>
                        @endif

                        @if ($pengaduan->status == 'selesai')
                            <div class="flex items-start">
                                <div
                                    class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center mr-3 flex-shrink-0">
                                    <i class="fas fa-check-double text-green-600 text-sm"></i>
                                </div>
                                <div>
                                    <p class="font-medium text-gray-800">Selesai</p>
                                    <p class="text-sm text-gray-500">{{ $pengaduan->updated_at->format('d M Y, H:i') }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

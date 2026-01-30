@extends('layouts.admin')

@section('title', 'Detail Permohonan Informasi')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.ppid.permohonan') }}" class="text-green-600 hover:text-green-700">
            <i class="fas fa-arrow-left mr-2"></i>Kembali
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Permohonan Info -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-semibold text-gray-800">Detail Permohonan</h2>
                        @php
                            $statusColors = [
                                'menunggu' => 'yellow',
                                'diproses' => 'blue',
                                'selesai' => 'green',
                                'ditolak' => 'red',
                            ];
                        @endphp
                        <span
                            class="px-3 py-1 text-sm font-medium rounded-full bg-{{ $statusColors[$permohonan->status] ?? 'gray' }}-100 text-{{ $statusColors[$permohonan->status] ?? 'gray' }}-800">
                            {{ ucfirst($permohonan->status) }}
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div>
                            <p class="text-sm text-gray-500">Nomor Permohonan</p>
                            <p class="font-semibold text-gray-800">{{ $permohonan->nomor_permohonan }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Tanggal Permohonan</p>
                            <p class="font-semibold text-gray-800">{{ $permohonan->created_at->format('d F Y, H:i') }}</p>
                        </div>
                    </div>

                    <div class="border-t border-gray-200 pt-6">
                        <h4 class="font-semibold text-gray-800 mb-4">Informasi yang Diminta</h4>
                        <div class="prose prose-sm max-w-none text-gray-700 bg-gray-50 p-4 rounded-lg">
                            {!! nl2br(e($permohonan->informasi_diminta)) !!}
                        </div>
                    </div>

                    <div class="border-t border-gray-200 pt-6 mt-6">
                        <h4 class="font-semibold text-gray-800 mb-4">Tujuan Penggunaan</h4>
                        <p class="text-gray-700">{{ $permohonan->tujuan_penggunaan ?? '-' }}</p>
                    </div>
                </div>
            </div>

            <!-- Response Section -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-800">Tanggapan</h2>
                </div>
                <div class="p-6">
                    @if ($permohonan->tanggapan)
                        <div class="bg-green-50 p-4 rounded-lg border-l-4 border-green-500 mb-6">
                            <p class="text-sm text-gray-500 mb-2">Tanggapan diberikan pada
                                {{ $permohonan->ditanggapi_pada?->format('d M Y H:i') }}</p>
                            <div class="prose prose-sm max-w-none text-gray-700">
                                {!! nl2br(e($permohonan->tanggapan)) !!}
                            </div>
                        </div>
                    @endif

                    <form action="{{ route('admin.ppid.permohonan.update', $permohonan) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Update Status</label>
                            <select name="status" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                                <option value="menunggu" {{ $permohonan->status == 'menunggu' ? 'selected' : '' }}>Menunggu
                                </option>
                                <option value="diproses" {{ $permohonan->status == 'diproses' ? 'selected' : '' }}>Diproses
                                </option>
                                <option value="selesai" {{ $permohonan->status == 'selesai' ? 'selected' : '' }}>Selesai
                                </option>
                                <option value="ditolak" {{ $permohonan->status == 'ditolak' ? 'selected' : '' }}>Ditolak
                                </option>
                            </select>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tanggapan</label>
                            <textarea name="tanggapan" rows="4"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">{{ old('tanggapan', $permohonan->tanggapan) }}</textarea>
                        </div>

                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Lampirkan Dokumen (opsional)</label>
                            <input type="file" name="dokumen_balasan" accept=".pdf,.doc,.docx"
                                class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                        </div>

                        <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                            <i class="fas fa-save mr-2"></i>Simpan Tanggapan
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="space-y-6">
            <!-- Pemohon Info -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="font-semibold text-gray-800">Data Pemohon</h3>
                </div>
                <div class="p-6 space-y-4">
                    <div>
                        <p class="text-sm text-gray-500">Nama</p>
                        <p class="font-medium text-gray-800">{{ $permohonan->nama_pemohon }}</p>
                    </div>
                    @if ($permohonan->nik)
                        <div>
                            <p class="text-sm text-gray-500">NIK</p>
                            <p class="font-medium text-gray-800">{{ $permohonan->nik }}</p>
                        </div>
                    @endif
                    <div>
                        <p class="text-sm text-gray-500">Email</p>
                        <p class="font-medium text-gray-800">{{ $permohonan->email }}</p>
                    </div>
                    @if ($permohonan->telepon)
                        <div>
                            <p class="text-sm text-gray-500">Telepon</p>
                            <p class="font-medium text-gray-800">{{ $permohonan->telepon }}</p>
                        </div>
                    @endif
                    @if ($permohonan->alamat)
                        <div>
                            <p class="text-sm text-gray-500">Alamat</p>
                            <p class="font-medium text-gray-800">{{ $permohonan->alamat }}</p>
                        </div>
                    @endif
                    @if ($permohonan->pekerjaan)
                        <div>
                            <p class="text-sm text-gray-500">Pekerjaan</p>
                            <p class="font-medium text-gray-800">{{ $permohonan->pekerjaan }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Timeline -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="font-semibold text-gray-800">Timeline</h3>
                </div>
                <div class="p-6">
                    <div class="space-y-4">
                        <div class="flex items-start">
                            <div
                                class="w-8 h-8 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0 mr-3">
                                <i class="fas fa-paper-plane text-green-600 text-xs"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-800">Permohonan Dibuat</p>
                                <p class="text-xs text-gray-500">{{ $permohonan->created_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>

                        @if ($permohonan->status != 'menunggu')
                            <div class="flex items-start">
                                <div
                                    class="w-8 h-8 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0 mr-3">
                                    <i class="fas fa-spinner text-blue-600 text-xs"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-800">Diproses</p>
                                    <p class="text-xs text-gray-500">{{ $permohonan->updated_at->format('d M Y, H:i') }}
                                    </p>
                                </div>
                            </div>
                        @endif

                        @if (in_array($permohonan->status, ['selesai', 'ditolak']))
                            <div class="flex items-start">
                                <div
                                    class="w-8 h-8 bg-{{ $permohonan->status == 'selesai' ? 'green' : 'red' }}-100 rounded-full flex items-center justify-center flex-shrink-0 mr-3">
                                    <i
                                        class="fas fa-{{ $permohonan->status == 'selesai' ? 'check' : 'times' }} text-{{ $permohonan->status == 'selesai' ? 'green' : 'red' }}-600 text-xs"></i>
                                </div>
                                <div>
                                    <p class="text-sm font-medium text-gray-800">
                                        {{ $permohonan->status == 'selesai' ? 'Selesai' : 'Ditolak' }}</p>
                                    <p class="text-xs text-gray-500">
                                        {{ $permohonan->ditanggapi_pada?->format('d M Y, H:i') ?? '-' }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

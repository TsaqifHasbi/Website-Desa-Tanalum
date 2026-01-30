@extends('layouts.admin')

@section('title', 'Detail Pesan')

@section('content')
    <div class="mb-6">
        <a href="{{ route('admin.kontak.index') }}" class="text-green-600 hover:text-green-700">
            <i class="fas fa-arrow-left mr-2"></i>Kembali ke Daftar Pesan
        </a>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Message Content -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Main Message -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-200 flex items-start justify-between">
                    <div>
                        <h1 class="text-xl font-bold text-gray-800">{{ $kontak->subjek }}</h1>
                        <p class="text-sm text-gray-500 mt-1">
                            Diterima {{ $kontak->created_at->format('d F Y, H:i') }} WITA
                        </p>
                    </div>
                    <div>
                        @switch($kontak->status)
                            @case('baru')
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                    <i class="fas fa-envelope mr-2"></i>Baru
                                </span>
                            @break

                            @case('dibaca')
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                    <i class="fas fa-eye mr-2"></i>Dibaca
                                </span>
                            @break

                            @case('dibalas')
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                    <i class="fas fa-reply mr-2"></i>Dibalas
                                </span>
                            @break

                            @case('selesai')
                                <span
                                    class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                    <i class="fas fa-check mr-2"></i>Selesai
                                </span>
                            @break
                        @endswitch
                    </div>
                </div>

                <div class="p-6">
                    <div class="prose max-w-none text-gray-700">
                        {!! nl2br(e($kontak->pesan)) !!}
                    </div>
                </div>
            </div>

            <!-- Reply Section -->
            @if ($kontak->balasan)
                <div class="bg-green-50 rounded-xl border border-green-200 overflow-hidden">
                    <div class="p-4 border-b border-green-200 bg-green-100">
                        <div class="flex items-center">
                            <i class="fas fa-reply text-green-600 mr-3"></i>
                            <div>
                                <p class="font-medium text-green-800">Balasan dari Admin</p>
                                <p class="text-sm text-green-600">
                                    {{ $kontak->dibalas_pada ? $kontak->dibalas_pada->format('d F Y, H:i') : '' }}
                                    @if ($kontak->pembalas)
                                        oleh {{ $kontak->pembalas->name }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="prose max-w-none text-gray-700">
                            {!! nl2br(e($kontak->balasan)) !!}
                        </div>
                    </div>
                </div>
            @endif

            <!-- Reply Form -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">
                        <i class="fas fa-reply text-green-600 mr-2"></i>
                        {{ $kontak->balasan ? 'Edit Balasan' : 'Kirim Balasan' }}
                    </h3>
                </div>
                <form action="{{ route('admin.kontak.reply', $kontak) }}" method="POST" class="p-6">
                    @csrf

                    <div class="mb-4">
                        <textarea name="balasan" rows="6" required
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500"
                            placeholder="Tulis balasan...">{{ old('balasan', $kontak->balasan) }}</textarea>
                    </div>

                    <div class="flex items-center gap-4">
                        <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                            <i class="fas fa-paper-plane mr-2"></i>
                            {{ $kontak->balasan ? 'Update Balasan' : 'Kirim Balasan' }}
                        </button>

                        <a href="mailto:{{ $kontak->email }}?subject=Re: {{ $kontak->subjek }}"
                            class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                            <i class="fas fa-envelope mr-2"></i>
                            Balas via Email
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Sender Info -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="p-4 border-b border-gray-200">
                    <h3 class="font-semibold text-gray-700">Informasi Pengirim</h3>
                </div>
                <div class="p-6">
                    <div class="flex items-center mb-4">
                        <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center mr-4">
                            <span class="text-green-700 font-bold text-lg">{{ substr($kontak->nama, 0, 1) }}</span>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800">{{ $kontak->nama }}</p>
                        </div>
                    </div>

                    <div class="space-y-3 text-sm">
                        <div class="flex items-center text-gray-600">
                            <i class="fas fa-envelope w-5 text-gray-400"></i>
                            <a href="mailto:{{ $kontak->email }}" class="ml-3 text-green-600 hover:underline">
                                {{ $kontak->email }}
                            </a>
                        </div>
                        @if ($kontak->telepon)
                            <div class="flex items-center text-gray-600">
                                <i class="fas fa-phone w-5 text-gray-400"></i>
                                <a href="tel:{{ $kontak->telepon }}" class="ml-3 text-green-600 hover:underline">
                                    {{ $kontak->telepon }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="p-4 border-b border-gray-200">
                    <h3 class="font-semibold text-gray-700">Aksi Cepat</h3>
                </div>
                <div class="p-4 space-y-2">
                    @if ($kontak->status !== 'selesai')
                        <form action="{{ route('admin.kontak.updateStatus', $kontak) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <input type="hidden" name="status" value="selesai">
                            <button type="submit"
                                class="w-full flex items-center px-4 py-2 text-green-700 bg-green-50 rounded-lg hover:bg-green-100">
                                <i class="fas fa-check w-5"></i>
                                <span class="ml-3">Tandai Selesai</span>
                            </button>
                        </form>
                    @endif

                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $kontak->telepon ?? '') }}?text={{ urlencode('Halo ' . $kontak->nama . ', terima kasih telah menghubungi Desa Tanalum.') }}"
                        target="_blank"
                        class="w-full flex items-center px-4 py-2 text-green-700 bg-green-50 rounded-lg hover:bg-green-100 {{ !$kontak->telepon ? 'opacity-50 pointer-events-none' : '' }}">
                        <i class="fab fa-whatsapp w-5"></i>
                        <span class="ml-3">Balas via WhatsApp</span>
                    </a>

                    <form action="{{ route('admin.kontak.destroy', $kontak) }}" method="POST"
                        onsubmit="return confirm('Yakin ingin menghapus pesan ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="w-full flex items-center px-4 py-2 text-red-700 bg-red-50 rounded-lg hover:bg-red-100">
                            <i class="fas fa-trash w-5"></i>
                            <span class="ml-3">Hapus Pesan</span>
                        </button>
                    </form>
                </div>
            </div>

            <!-- Update Status -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="p-4 border-b border-gray-200">
                    <h3 class="font-semibold text-gray-700">Ubah Status</h3>
                </div>
                <form action="{{ route('admin.kontak.updateStatus', $kontak) }}" method="POST" class="p-4">
                    @csrf
                    @method('PUT')
                    <select name="status"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 mb-3">
                        <option value="baru" {{ $kontak->status == 'baru' ? 'selected' : '' }}>Baru</option>
                        <option value="dibaca" {{ $kontak->status == 'dibaca' ? 'selected' : '' }}>Dibaca</option>
                        <option value="dibalas" {{ $kontak->status == 'dibalas' ? 'selected' : '' }}>Dibalas</option>
                        <option value="selesai" {{ $kontak->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                    <button type="submit"
                        class="w-full px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200">
                        Update Status
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection

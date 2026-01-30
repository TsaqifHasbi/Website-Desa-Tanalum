@extends('layouts.main')

@section('title', 'Layanan Pengaduan - Desa Tanalum')

@section('content')
    <!-- Hero Section -->
    <section class="relative py-20 bg-gradient-to-r from-green-600 to-green-700">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="container mx-auto px-4 relative">
            <div class="text-center text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Layanan Pengaduan</h1>
                <p class="text-xl text-green-100 mb-4">Sampaikan Aspirasi dan Keluhan Anda</p>
                <!-- Breadcrumb -->
                <nav class="flex items-center justify-center text-sm">
                    <a href="{{ route('home') }}" class="text-green-200 hover:text-white">Beranda</a>
                    <span class="mx-2 text-green-300">/</span>
                    <span class="text-white">Pengaduan</span>
                </nav>
            </div>
        </div>
    </section>

    <!-- Info Section -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="grid md:grid-cols-2 gap-8">
                    <!-- Buat Pengaduan -->
                    <div class="bg-white rounded-xl shadow-sm p-8 text-center">
                        <div class="w-20 h-20 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-edit text-green-600 text-3xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Buat Pengaduan</h2>
                        <p class="text-gray-600 mb-6">
                            Sampaikan keluhan, saran, atau aspirasi Anda kepada Pemerintah Desa Tanalum.
                            Pengaduan Anda akan ditindaklanjuti dengan serius.
                        </p>
                        <a href="{{ route('pengaduan.create') }}"
                            class="inline-flex items-center px-6 py-3 bg-green-600 text-white rounded-lg hover:bg-green-700 transition-colors">
                            <i class="fas fa-plus mr-2"></i>
                            Buat Pengaduan Baru
                        </a>
                    </div>

                    <!-- Cek Status -->
                    <div class="bg-white rounded-xl shadow-sm p-8 text-center">
                        <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-search text-blue-600 text-3xl"></i>
                        </div>
                        <h2 class="text-2xl font-bold text-gray-800 mb-4">Cek Status Pengaduan</h2>
                        <p class="text-gray-600 mb-6">
                            Masukkan nomor tiket pengaduan Anda untuk melihat status dan perkembangan
                            tindak lanjut pengaduan.
                        </p>
                        <form action="" method="GET" class="max-w-sm mx-auto" x-data="{ tiket: '' }">
                            <div class="flex gap-2">
                                <input type="text" x-model="tiket" placeholder="Nomor Tiket (contoh: TKT-XXXXXX)"
                                    class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                                <button type="button" @click="if(tiket) window.location.href='/pengaduan/cek/' + tiket"
                                    class="px-4 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Alur Pengaduan -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <h2 class="text-3xl font-bold text-green-600 text-center mb-12">Alur Pengaduan</h2>

                <div class="grid md:grid-cols-4 gap-6">
                    <div class="text-center">
                        <div
                            class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4 relative">
                            <span class="text-2xl font-bold text-green-600">1</span>
                        </div>
                        <h4 class="font-semibold text-gray-800 mb-2">Buat Pengaduan</h4>
                        <p class="text-sm text-gray-600">Isi formulir pengaduan dengan lengkap dan jelas</p>
                    </div>

                    <div class="text-center">
                        <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl font-bold text-blue-600">2</span>
                        </div>
                        <h4 class="font-semibold text-gray-800 mb-2">Verifikasi</h4>
                        <p class="text-sm text-gray-600">Petugas akan memverifikasi dan meneruskan pengaduan</p>
                    </div>

                    <div class="text-center">
                        <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl font-bold text-yellow-600">3</span>
                        </div>
                        <h4 class="font-semibold text-gray-800 mb-2">Proses</h4>
                        <p class="text-sm text-gray-600">Pengaduan diproses oleh pihak terkait</p>
                    </div>

                    <div class="text-center">
                        <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <span class="text-2xl font-bold text-green-600">4</span>
                        </div>
                        <h4 class="font-semibold text-gray-800 mb-2">Selesai</h4>
                        <p class="text-sm text-gray-600">Pengaduan ditanggapi dan diselesaikan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Pengaduan Selesai -->
    @if (isset($pengaduans) && $pengaduans->count() > 0)
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="max-w-4xl mx-auto">
                    <h2 class="text-3xl font-bold text-green-600 text-center mb-4">Pengaduan yang Telah Ditanggapi</h2>
                    <p class="text-gray-600 text-center mb-12">Pengaduan publik yang sudah selesai ditindaklanjuti</p>

                    <div class="space-y-4">
                        @foreach ($pengaduans as $pengaduan)
                            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                                <div class="p-6">
                                    <div class="flex items-start gap-4">
                                        <div
                                            class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center flex-shrink-0">
                                            <i class="fas fa-check text-green-600"></i>
                                        </div>
                                        <div class="flex-1">
                                            <h4 class="font-semibold text-gray-800 mb-1">{{ $pengaduan->judul }}</h4>
                                            <p class="text-sm text-gray-600 mb-3 line-clamp-2">
                                                {{ Str::limit($pengaduan->isi_pengaduan, 150) }}</p>
                                            <div class="flex flex-wrap items-center gap-4 text-xs text-gray-500">
                                                <span><i
                                                        class="fas fa-ticket-alt mr-1"></i>{{ $pengaduan->nomor_tiket }}</span>
                                                <span><i
                                                        class="fas fa-folder mr-1"></i>{{ $pengaduan->kategori ?? 'Umum' }}</span>
                                                <span><i
                                                        class="fas fa-calendar mr-1"></i>{{ $pengaduan->created_at->format('d M Y') }}</span>
                                            </div>

                                            @if ($pengaduan->tanggapan)
                                                <div class="mt-4 p-4 bg-green-50 rounded-lg border-l-4 border-green-500">
                                                    <p class="text-sm font-medium text-green-800 mb-1">Tanggapan:</p>
                                                    <p class="text-sm text-gray-700">
                                                        {{ Str::limit($pengaduan->tanggapan, 200) }}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <div class="mt-8">
                        {{ $pengaduans->links() }}
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- FAQ Section -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto">
                <h2 class="text-3xl font-bold text-green-600 text-center mb-12">Pertanyaan Umum</h2>

                <div class="space-y-4" x-data="{ open: null }">
                    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                        <button @click="open = open === 1 ? null : 1"
                            class="w-full px-6 py-4 text-left flex items-center justify-between">
                            <span class="font-medium text-gray-800">Bagaimana cara membuat pengaduan?</span>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform"
                                :class="{ 'rotate-180': open === 1 }"></i>
                        </button>
                        <div x-show="open === 1" x-collapse>
                            <div class="px-6 pb-4 text-gray-600">
                                Klik tombol "Buat Pengaduan Baru", isi formulir dengan lengkap termasuk identitas,
                                kategori pengaduan, dan uraian pengaduan. Setelah submit, Anda akan mendapatkan
                                nomor tiket untuk melacak status pengaduan.
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                        <button @click="open = open === 2 ? null : 2"
                            class="w-full px-6 py-4 text-left flex items-center justify-between">
                            <span class="font-medium text-gray-800">Berapa lama pengaduan diproses?</span>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform"
                                :class="{ 'rotate-180': open === 2 }"></i>
                        </button>
                        <div x-show="open === 2" x-collapse>
                            <div class="px-6 pb-4 text-gray-600">
                                Pengaduan akan diverifikasi dalam 1x24 jam dan diproses maksimal 14 hari kerja
                                tergantung kompleksitas masalah. Anda dapat memantau perkembangan melalui nomor tiket.
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                        <button @click="open = open === 3 ? null : 3"
                            class="w-full px-6 py-4 text-left flex items-center justify-between">
                            <span class="font-medium text-gray-800">Apakah identitas pelapor dirahasiakan?</span>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform"
                                :class="{ 'rotate-180': open === 3 }"></i>
                        </button>
                        <div x-show="open === 3" x-collapse>
                            <div class="px-6 pb-4 text-gray-600">
                                Ya, identitas pelapor akan dirahasiakan kecuali Anda memilih untuk mempublikasikan
                                pengaduan. Data pribadi Anda dilindungi dan hanya digunakan untuk keperluan tindak lanjut.
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                        <button @click="open = open === 4 ? null : 4"
                            class="w-full px-6 py-4 text-left flex items-center justify-between">
                            <span class="font-medium text-gray-800">Apa saja yang bisa diadukan?</span>
                            <i class="fas fa-chevron-down text-gray-400 transition-transform"
                                :class="{ 'rotate-180': open === 4 }"></i>
                        </button>
                        <div x-show="open === 4" x-collapse>
                            <div class="px-6 pb-4 text-gray-600">
                                Anda dapat mengadukan berbagai hal terkait pelayanan publik desa, infrastruktur,
                                lingkungan, sosial kemasyarakatan, dan hal-hal lain yang berkaitan dengan
                                pemerintahan desa.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section class="py-12 bg-green-600">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto text-center text-white">
                <h3 class="text-2xl font-bold mb-4">Butuh Bantuan Lebih Lanjut?</h3>
                <p class="text-green-100 mb-6">
                    Jika Anda mengalami kesulitan atau membutuhkan bantuan langsung,
                    silakan hubungi kantor desa.
                </p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="tel:{{ $profil->telepon ?? '' }}"
                        class="inline-flex items-center px-6 py-3 bg-white text-green-600 rounded-lg hover:bg-gray-100 transition-colors">
                        <i class="fas fa-phone mr-2"></i>
                        {{ $profil->telepon ?? '08xx-xxxx-xxxx' }}
                    </a>
                    <a href="{{ route('kontak') }}"
                        class="inline-flex items-center px-6 py-3 border-2 border-white text-white rounded-lg hover:bg-white/10 transition-colors">
                        <i class="fas fa-envelope mr-2"></i>
                        Hubungi Kami
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@alpinejs/collapse@3.x.x/dist/cdn.min.js"></script>
@endpush

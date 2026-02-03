@extends('layouts.app')

@section('title', 'Sejarah Desa')

@section('content')
    <!-- Hero Section -->
    <section class="relative py-20 bg-gradient-to-r from-primary-600 to-primary-700">
        <div class="container mx-auto px-4">
            <div class="text-center text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Sejarah Desa</h1>
                <p class="text-lg text-primary-100">{{ $profil->nama_desa ?? 'Desa Tanalum' }}</p>
            </div>
        </div>
    </section>

    <!-- Breadcrumb -->
    <div class="bg-white shadow-sm">
        <div class="container mx-auto px-4">
            <nav class="flex items-center space-x-2 py-4 text-sm">
                <a href="{{ route('home') }}" class="text-gray-500 hover:text-primary-600">Beranda</a>
                <span class="text-gray-400">/</span>
                <a href="{{ route('profil.index') }}" class="text-gray-500 hover:text-primary-600">Profil Desa</a>
                <span class="text-gray-400">/</span>
                <span class="text-primary-600 font-medium">Sejarah</span>
            </nav>
        </div>
    </div>

    <!-- Tab Navigation -->
    <div class="sticky top-0 z-40 bg-white border-b border-gray-200 shadow-sm" x-data="{ activeSection: 'cerita-rakyat' }">
        <div class="container mx-auto px-4">
            <nav class="flex gap-4 overflow-x-auto">
                <a href="#cerita-rakyat" 
                    @click.prevent="activeSection = 'cerita-rakyat'; document.getElementById('cerita-rakyat').scrollIntoView({behavior: 'smooth', block: 'start'})"
                    :class="activeSection === 'cerita-rakyat' ? 'border-primary-600 text-primary-600' : 'border-transparent text-gray-600 hover:text-primary-600'"
                    class="py-4 px-2 text-sm font-medium border-b-2 whitespace-nowrap transition">
                    <i class="fas fa-book-reader mr-2"></i>
                    Cerita Rakyat
                </a>
                <a href="#riwayat-kepemerintahan"
                    @click.prevent="activeSection = 'riwayat-kepemerintahan'; document.getElementById('riwayat-kepemerintahan').scrollIntoView({behavior: 'smooth', block: 'start'})"
                    :class="activeSection === 'riwayat-kepemerintahan' ? 'border-primary-600 text-primary-600' : 'border-transparent text-gray-600 hover:text-primary-600'"
                    class="py-4 px-2 text-sm font-medium border-b-2 whitespace-nowrap transition">
                    <i class="fas fa-landmark mr-2"></i>
                    Riwayat Kepemerintahan
                </a>
            </nav>
        </div>
    </div>

    <!-- Section 1: Cerita Rakyat -->
    <section id="cerita-rakyat" class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <!-- Section Header -->
                <div class="text-center mb-12" data-aos="fade-up">
                    <span class="inline-block px-4 py-1 bg-primary-100 text-primary-600 text-sm font-medium rounded-full mb-4">
                        Bagian 1
                    </span>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Cerita Rakyat</h2>
                    <p class="text-lg text-gray-600">Cikal Bakal Desa Tanalum</p>
                </div>

                <!-- Cerita Rakyat Content -->
                @forelse($ceritaRakyat ?? [] as $index => $cerita)
                    <div class="bg-white rounded-2xl shadow-sm overflow-hidden mb-8" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        @if($cerita->gambar_utama)
                            <div class="relative h-64 md:h-80 overflow-hidden">
                                <img src="{{ Storage::url($cerita->gambar_utama) }}" alt="{{ $cerita->judul }}"
                                    class="w-full h-full object-cover">
                                <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                                <div class="absolute bottom-0 left-0 right-0 p-6 text-white">
                                    <h3 class="text-2xl md:text-3xl font-bold">{{ $cerita->judul }}</h3>
                                </div>
                            </div>
                        @else
                            <div class="p-6 md:p-8 bg-gradient-to-r from-primary-600 to-primary-700 text-white">
                                <h3 class="text-2xl md:text-3xl font-bold">{{ $cerita->judul }}</h3>
                            </div>
                        @endif

                        <div class="p-6 md:p-8">
                            <div class="prose prose-lg max-w-none text-gray-600">
                                {!! $cerita->konten !!}
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white rounded-2xl shadow-sm p-8 md:p-12" data-aos="fade-up">
                        @if ($profil->foto_kantor)
                            <img src="{{ Storage::url($profil->foto_kantor) }}" alt="Kantor Desa"
                                class="w-full rounded-xl mb-8">
                        @endif

                        <div class="prose prose-lg max-w-none text-gray-600">
                            @if ($profil->sejarah)
                                {!! $profil->sejarah !!}
                            @else
                                <h3 class="text-2xl font-bold text-gray-900 mb-6">Cikal Bakal Desa Tanalum</h3>
                                
                                <p>Desa Tanalum merupakan salah satu desa yang terletak di Kecamatan Marang Kayu, Kabupaten
                                    Kutai Kartanegara, Provinsi Kalimantan Timur.</p>

                                <p>Nama "Tanalum" berasal dari bahasa lokal yang memiliki makna mendalam bagi masyarakat
                                    setempat. Desa ini memiliki sejarah panjang yang tak terpisahkan dari perkembangan wilayah
                                    Kutai Kartanegara.</p>

                                <p>Sejak zaman dahulu, masyarakat desa hidup dari hasil pertanian, perkebunan, dan memanfaatkan
                                    sumber daya alam yang melimpah di wilayah ini. Gotong royong dan kekeluargaan menjadi
                                    nilai-nilai utama yang terus dijaga oleh warga desa hingga saat ini.</p>
                            @endif
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- Section 2: Riwayat Kepemerintahan -->
    <section id="riwayat-kepemerintahan" class="py-16 bg-white">
        <div class="container mx-auto px-4">
            <div class="max-w-6xl mx-auto">
                <!-- Section Header -->
                <div class="text-center mb-12" data-aos="fade-up">
                    <span class="inline-block px-4 py-1 bg-primary-100 text-primary-600 text-sm font-medium rounded-full mb-4">
                        Bagian 2
                    </span>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">Tanalum dalam Riwayat Kepemerintahan</h2>
                    <p class="text-lg text-gray-600">Daftar para pemimpin desa dari masa ke masa</p>
                </div>

                <!-- Kepala Desa Timeline -->
                @if(count($kepalaDesa ?? []) > 0)
                    <div class="relative pt-8">
                        <!-- Vertical Line (Desktop: Center, Mobile: Left) -->
                        <div class="absolute left-4 md:left-1/2 top-0 bottom-0 w-1 bg-gradient-to-b from-primary-500 via-primary-400 to-gray-200 transform md:-translate-x-1/2 rounded-full"></div>

                        <div class="space-y-12 md:space-y-24">
                            @foreach($kepalaDesa as $index => $kepala)
                                <div class="relative flex flex-col md:flex-row items-center w-full" data-aos="fade-up">
                                    
                                    <!-- Timeline Dot -->
                                    <div class="absolute left-4 md:left-1/2 w-6 h-6 bg-white border-4 border-primary-600 rounded-full transform -translate-x-1/2 z-10 shadow-sm hidden md:flex items-center justify-center">
                                        <div class="w-2 h-2 bg-primary-600 rounded-full animate-pulse"></div>
                                    </div>
                                    <div class="absolute left-4 md:hidden w-4 h-4 bg-primary-600 rounded-full transform -translate-x-1/2 z-10 border-2 border-white shadow-sm mt-8"></div>

                                    <!-- Content Container -->
                                    <div class="flex flex-col md:flex-row items-center w-full md:gap-0 pl-10 md:pl-0">
                                        
                                        <!-- Card (Alternating on Desktop) -->
                                        <div class="w-full md:w-[45%] {{ $index % 2 == 0 ? 'md:order-1' : 'md:order-3' }}">
                                            <div class="bg-white rounded-3xl shadow-md hover:shadow-xl transition-all duration-500 overflow-hidden border border-gray-100 group">
                                                <div class="flex flex-col sm:flex-row h-full">
                                                    <!-- Image -->
                                                    <div class="w-full sm:w-40 md:w-48 h-64 sm:h-auto shrink-0 relative overflow-hidden">
                                                        @if($kepala->foto)
                                                            <img src="{{ Storage::url($kepala->foto) }}" 
                                                                alt="{{ $kepala->nama }}"
                                                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                                        @else
                                                            <div class="w-full h-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                                                <i class="fas fa-user-tie text-5xl text-gray-300"></i>
                                                            </div>
                                                        @endif
                                                        <div class="absolute inset-0 bg-primary-600/10 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                                                    </div>

                                                    <!-- Details -->
                                                    <div class="p-6 flex-1 flex flex-col justify-center">
                                                        <span class="text-xs font-bold text-primary-600 uppercase tracking-widest mb-2 block">Kepala Desa {{ $index + 1 }}</span>
                                                        <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-2 leading-tight">{{ $kepala->nama }}</h3>
                                                        <div class="inline-flex items-center text-sm font-semibold text-gray-500 mb-4">
                                                            <div class="w-8 h-[2px] bg-primary-500 mr-2"></div>
                                                            {{ $kepala->periode }}
                                                        </div>
                                                        @if($kepala->keterangan)
                                                            <p class="text-gray-600 text-sm italic line-clamp-3">"{{ $kepala->keterangan }}"</p>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Spacer for Center Dot -->
                                        <div class="hidden md:block w-[10%] order-2"></div>
                                        
                                        <!-- Place Holder for Empty Side -->
                                        <div class="hidden md:block w-[45%] {{ $index % 2 == 0 ? 'order-3' : 'order-1' }}"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <!-- Empty State -->
                    <div class="text-center py-20 bg-gray-50 rounded-3xl border-2 border-dashed border-gray-200" data-aos="fade-up">
                        <div class="w-24 h-24 mx-auto bg-white rounded-full flex items-center justify-center mb-6 shadow-sm">
                            <i class="fas fa-landmark text-4xl text-primary-200"></i>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Data</h3>
                        <p class="text-gray-500 max-w-sm mx-auto">Riwayat kepemerintahan sedang dalam tahap pengumpulan data dan akan segera diperbarui.</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Navigation -->
    <section class="py-8 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="flex flex-col sm:flex-row justify-between gap-4">
                    <a href="{{ route('profil.index') }}"
                        class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-gray-700 hover:bg-gray-100 rounded-lg transition">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Kembali ke Profil
                    </a>
                    <a href="{{ route('profil.visi-misi') }}"
                        class="inline-flex items-center justify-center px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white rounded-lg transition">
                        Visi & Misi
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    /* Prose styles for article content */
    .prose img {
        max-width: 100%;
        height: auto;
        border-radius: 12px;
        margin: 1.5rem 0;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    .prose p {
        margin-bottom: 1.25rem;
    }

    .prose h2, .prose h3, .prose h4 {
        color: #1f2937;
        margin-top: 2rem;
        margin-bottom: 1rem;
    }

    /* Fix for list styling - override Tailwind reset */
    .prose ul {
        list-style-type: disc !important;
        padding-left: 2rem !important;
        margin: 1rem 0 !important;
    }

    .prose ol {
        list-style-type: decimal !important;
        padding-left: 2rem !important;
        margin: 1rem 0 !important;
    }

    .prose ul li,
    .prose ol li {
        display: list-item !important;
        margin: 0.5rem 0 !important;
    }

    .prose ul ul {
        list-style-type: circle !important;
        margin: 0.5rem 0 !important;
    }

    .prose ol ol {
        list-style-type: lower-alpha !important;
        margin: 0.5rem 0 !important;
    }

    /* Mobile Timeline adjust */
    @media (max-width: 768px) {
        #riwayat-kepemerintahan .relative > div {
            flex-direction: column;
        }
    }
</style>
@endpush

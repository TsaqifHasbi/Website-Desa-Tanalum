@extends('layouts.app')

@section('title', 'Pemerintahan Desa')

@section('content')
    <!-- Hero Section -->
    <section class="relative py-20 bg-gradient-to-r from-primary-600 to-primary-700">
        <div class="container mx-auto px-4">
            <div class="text-center text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Pemerintahan Desa</h1>
                <p class="text-lg text-primary-100">Perangkat Desa {{ $profil->nama_desa ?? 'Tanalum' }}</p>
            </div>
        </div>
    </section>

    <!-- Breadcrumb -->
    <div class="bg-white shadow-sm">
        <div class="container mx-auto px-4">
            <nav class="flex items-center space-x-2 py-4 text-sm">
                <a href="{{ route('home') }}" class="text-gray-500 hover:text-primary-600">Beranda</a>
                <span class="text-gray-400">/</span>
                <span class="text-primary-600 font-medium">Pemerintahan</span>
            </nav>
        </div>
    </div>

    <!-- Content -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <!-- Kepala Desa -->
            @if ($kepalaDesa)
                <div class="mb-16" data-aos="fade-up">
                    <div class="bg-gradient-to-r from-primary-600 to-primary-700 rounded-2xl p-8 lg:p-12">
                        <div class="flex flex-col lg:flex-row items-center lg:items-start gap-8">
                            <div class="w-48 h-48 rounded-2xl overflow-hidden bg-white/10 flex-shrink-0">
                                @if ($kepalaDesa->foto)
                                    <img src="{{ Storage::url($kepalaDesa->foto) }}" alt="{{ $kepalaDesa->nama }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full flex items-center justify-center">
                                        <i class="fas fa-user text-5xl text-white/50"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="text-center lg:text-left text-white">
                                <span
                                    class="inline-block px-4 py-1 bg-white/20 rounded-full text-sm font-medium mb-4">Kepala
                                    Desa</span>
                                <h2 class="text-3xl font-bold mb-2">{{ $kepalaDesa->nama }}</h2>
                                @if ($kepalaDesa->nip)
                                    <p class="text-primary-100 mb-4">NIP: {{ $kepalaDesa->nip }}</p>
                                @endif
                                @if ($kepalaDesa->periode)
                                    <p class="text-primary-100">Periode: {{ $kepalaDesa->periode }}</p>
                                @endif
                                @if ($kepalaDesa->visi_misi)
                                    <div class="mt-6 bg-white/10 rounded-xl p-6">
                                        <h4 class="font-semibold mb-2">Sambutan:</h4>
                                        <p class="text-primary-100">{{ Str::limit($kepalaDesa->visi_misi, 300) }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Perangkat Desa -->
            @if ($perangkat->count() > 0)
                <div class="mb-12">
                    <div class="text-center mb-10" data-aos="fade-up">
                        <span class="text-primary-600 font-semibold">Tim Kami</span>
                        <h2 class="text-3xl font-bold text-gray-800 mt-2">Perangkat Desa</h2>
                    </div>

                    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach ($perangkat as $index => $p)
                            <div class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-md transition group"
                                data-aos="fade-up" data-aos-delay="{{ ($index % 4) * 100 }}">
                                <div class="aspect-square overflow-hidden bg-gray-100">
                                    @if ($p->foto)
                                        <img src="{{ Storage::url($p->foto) }}" alt="{{ $p->nama }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <i class="fas fa-user text-5xl text-gray-300"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-6 text-center">
                                    <h3 class="font-bold text-gray-800 mb-1">{{ $p->nama }}</h3>
                                    <p class="text-primary-600 font-medium text-sm">{{ $p->jabatan }}</p>
                                    @if ($p->nip)
                                        <p class="text-gray-500 text-sm mt-2">NIP: {{ $p->nip }}</p>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- BPD -->
            @if ($bpd->count() > 0)
                <div class="mb-12">
                    <div class="text-center mb-10" data-aos="fade-up">
                        <span class="text-primary-600 font-semibold">Mitra Pemerintah Desa</span>
                        <h2 class="text-3xl font-bold text-gray-800 mt-2">Badan Permusyawaratan Desa (BPD)</h2>
                    </div>

                    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach ($bpd as $index => $b)
                            <div class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-md transition group"
                                data-aos="fade-up" data-aos-delay="{{ ($index % 4) * 100 }}">
                                <div class="aspect-square overflow-hidden bg-gray-100">
                                    @if ($b->foto)
                                        <img src="{{ Storage::url($b->foto) }}" alt="{{ $b->nama }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <i class="fas fa-user text-5xl text-gray-300"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="p-6 text-center">
                                    <h3 class="font-bold text-gray-800 mb-1">{{ $b->nama }}</h3>
                                    <p class="text-primary-600 font-medium text-sm">{{ $b->jabatan }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Lembaga Desa -->
            @if ($lembaga->count() > 0)
                <div>
                    <div class="text-center mb-10" data-aos="fade-up">
                        <span class="text-primary-600 font-semibold">Organisasi Kemasyarakatan</span>
                        <h2 class="text-3xl font-bold text-gray-800 mt-2">Lembaga Desa</h2>
                    </div>

                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach ($lembaga as $index => $l)
                            <div class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-md transition" data-aos="fade-up"
                                data-aos-delay="{{ ($index % 3) * 100 }}">
                                <div class="flex items-start">
                                    <div
                                        class="w-14 h-14 bg-primary-100 rounded-xl flex items-center justify-center mr-4 flex-shrink-0">
                                        <i class="fas fa-building text-2xl text-primary-600"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-gray-800 mb-1">{{ $l->nama }}</h3>
                                        @if ($l->ketua)
                                            <p class="text-gray-600 text-sm">Ketua: {{ $l->ketua }}</p>
                                        @endif
                                        @if ($l->alamat)
                                            <p class="text-gray-500 text-sm mt-2">
                                                <i class="fas fa-map-marker-alt mr-1"></i> {{ $l->alamat }}
                                            </p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            @if ($perangkat->count() == 0 && $bpd->count() == 0 && !$kepalaDesa)
                <div class="text-center py-16 bg-white rounded-2xl shadow-sm">
                    <i class="fas fa-users text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">Data Belum Tersedia</h3>
                    <p class="text-gray-500">Data perangkat desa belum diinput.</p>
                </div>
            @endif
        </div>
    </section>
@endsection

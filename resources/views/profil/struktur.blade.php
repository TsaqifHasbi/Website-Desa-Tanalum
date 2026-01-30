@extends('layouts.app')

@section('title', 'Struktur Organisasi')

@section('content')
    <!-- Hero Section -->
    <section class="relative py-20 bg-gradient-to-r from-primary-600 to-primary-700">
        <div class="container mx-auto px-4">
            <div class="text-center text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Struktur Organisasi</h1>
                <p class="text-lg text-primary-100">Pemerintah {{ $profil->nama_desa ?? 'Desa Tanalum' }}</p>
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
                <span class="text-primary-600 font-medium">Struktur Organisasi</span>
            </nav>
        </div>
    </div>

    <!-- Content -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <!-- Kepala Desa -->
            @if ($kepalaDesa)
                <div class="text-center mb-12" data-aos="fade-up">
                    <div class="inline-block">
                        <div
                            class="w-40 h-40 mx-auto rounded-full overflow-hidden mb-4 border-4 border-primary-200 shadow-xl">
                            @if ($kepalaDesa->foto)
                                <img src="{{ Storage::url($kepalaDesa->foto) }}" alt="{{ $kepalaDesa->nama }}"
                                    class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-primary-100 flex items-center justify-center">
                                    <i class="fas fa-user text-5xl text-primary-400"></i>
                                </div>
                            @endif
                        </div>
                        <h3 class="text-xl font-bold text-gray-800">{{ $kepalaDesa->nama }}</h3>
                        <p class="text-primary-600 font-medium">{{ $kepalaDesa->jabatan }}</p>
                        @if ($kepalaDesa->nip)
                            <p class="text-sm text-gray-500 mt-1">NIP: {{ $kepalaDesa->nip }}</p>
                        @endif
                    </div>
                </div>
            @endif

            <!-- Connector Line -->
            <div class="hidden lg:block w-0.5 h-12 bg-primary-200 mx-auto mb-8"></div>

            <!-- Sekretaris & Kasi -->
            @php
                $sekretaris = $aparaturs->where('jabatan', 'like', '%sekretaris%')->first();
                $perangkat = $aparaturs
                    ->whereNotIn('jabatan', ['Kepala Desa'])
                    ->where('jabatan', 'not like', '%sekretaris%');
            @endphp

            @if ($sekretaris)
                <div class="text-center mb-8" data-aos="fade-up">
                    <div class="inline-block">
                        <div class="w-32 h-32 mx-auto rounded-full overflow-hidden mb-3 border-4 border-white shadow-lg">
                            @if ($sekretaris->foto)
                                <img src="{{ Storage::url($sekretaris->foto) }}" alt="{{ $sekretaris->nama }}"
                                    class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-primary-100 flex items-center justify-center">
                                    <i class="fas fa-user text-3xl text-primary-400"></i>
                                </div>
                            @endif
                        </div>
                        <h3 class="font-semibold text-gray-800">{{ $sekretaris->nama }}</h3>
                        <p class="text-sm text-gray-500">{{ $sekretaris->jabatan }}</p>
                    </div>
                </div>
            @endif

            <!-- Connector Line -->
            <div class="hidden lg:block w-0.5 h-12 bg-primary-200 mx-auto mb-8"></div>

            <!-- Perangkat Desa -->
            @if ($perangkat->count() > 0)
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 mb-12">
                    @foreach ($perangkat as $index => $aparatur)
                        <div class="text-center" data-aos="fade-up" data-aos-delay="{{ $index * 50 }}">
                            <div class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-md transition">
                                <div class="w-24 h-24 mx-auto rounded-full overflow-hidden mb-4 border-4 border-gray-100">
                                    @if ($aparatur->foto)
                                        <img src="{{ Storage::url($aparatur->foto) }}" alt="{{ $aparatur->nama }}"
                                            class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-primary-100 flex items-center justify-center">
                                            <i class="fas fa-user text-2xl text-primary-400"></i>
                                        </div>
                                    @endif
                                </div>
                                <h3 class="font-semibold text-gray-800 text-sm">{{ $aparatur->nama }}</h3>
                                <p class="text-xs text-gray-500 mt-1">{{ $aparatur->jabatan }}</p>
                                @if ($aparatur->nip)
                                    <p class="text-xs text-gray-400 mt-1">NIP: {{ $aparatur->nip }}</p>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            @if ($aparaturs->isEmpty())
                <div class="text-center py-12 bg-white rounded-2xl shadow-sm">
                    <i class="fas fa-users text-4xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500">Data aparatur desa belum tersedia</p>
                </div>
            @endif

            <!-- BPD Section -->
            @php
                $bpdMembers = App\Models\AparaturDesa::where('jenis', 'bpd')
                    ->where('is_active', true)
                    ->orderBy('urutan')
                    ->get();
            @endphp

            @if ($bpdMembers->count() > 0)
                <div class="mt-16">
                    <div class="text-center mb-8" data-aos="fade-up">
                        <h2 class="text-2xl font-bold text-gray-800">Badan Permusyawaratan Desa (BPD)</h2>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        @foreach ($bpdMembers as $index => $anggota)
                            <div class="text-center" data-aos="fade-up" data-aos-delay="{{ $index * 50 }}">
                                <div class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-md transition">
                                    <div
                                        class="w-20 h-20 mx-auto rounded-full overflow-hidden mb-4 border-4 border-gray-100">
                                        @if ($anggota->foto)
                                            <img src="{{ Storage::url($anggota->foto) }}" alt="{{ $anggota->nama }}"
                                                class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full bg-blue-100 flex items-center justify-center">
                                                <i class="fas fa-user text-xl text-blue-400"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <h3 class="font-semibold text-gray-800 text-sm">{{ $anggota->nama }}</h3>
                                    <p class="text-xs text-gray-500 mt-1">{{ $anggota->jabatan }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Navigation -->
            <div class="flex flex-col sm:flex-row justify-between gap-4 mt-12">
                <a href="{{ route('profil.visi-misi') }}"
                    class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-gray-700 hover:bg-gray-50 rounded-lg transition">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Visi & Misi
                </a>
                <a href="{{ route('profil.peta') }}"
                    class="inline-flex items-center justify-center px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white rounded-lg transition">
                    Data Geografis
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>
@endsection

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
    <section class="py-16 bg-white overflow-x-auto">
        <div class="container mx-auto px-4 min-w-[1024px]">
            @php
                // Grouping Data Appratur
                $sekretaris = $aparaturs->first(fn($i) => stripos($i->jabatan, 'Sekretaris') !== false);
                
                $kaur = $aparaturs->filter(fn($i) => 
                    (stripos($i->jabatan, 'Kaur') !== false || stripos($i->jabatan, 'Urusan') !== false) && 
                    stripos($i->jabatan, 'Sekretaris') === false && 
                    stripos($i->jabatan, 'Kepala Desa') === false
                );

                $kasi = $aparaturs->filter(fn($i) => 
                    (stripos($i->jabatan, 'Kasi') !== false || stripos($i->jabatan, 'Seksi') !== false)
                );

                $kadus = $aparaturs->filter(fn($i) => 
                    stripos($i->jabatan, 'Kadus') !== false || stripos($i->jabatan, 'Dusun') !== false || stripos($i->jabatan, 'Wilayah') !== false
                );

                // Sisanya (Staff lain/Pelaksana)
                $staff = $aparaturs->filter(fn($i) => 
                    stripos($i->jabatan, 'Kepala Desa') === false &&
                    stripos($i->jabatan, 'Sekretaris') === false &&
                    !$kaur->contains('id', $i->id) &&
                    !$kasi->contains('id', $i->id) &&
                    !$kadus->contains('id', $i->id)
                );

                $bpd = \App\Models\AparaturDesa::where('jenis', 'bpd')->where('is_active', true)->get();
            @endphp

            <div class="flex flex-col items-center">
                <!-- Level 1: Kepala Desa & BPD -->
                <div class="flex items-center justify-center gap-20 relative mb-12">
                     <!-- BPD (Mitra Kerja/Garis Koordinasi) -->
                     @if($bpd->count() > 0)
                     <div class="relative group">
                         <div class="w-64 bg-yellow-50 border-2 border-yellow-400 rounded-xl p-4 shadow-md text-center">
                             <h3 class="font-bold text-gray-800 border-b border-yellow-200 pb-2 mb-2">BPD</h3>
                             <div class="flex -space-x-2 justify-center overflow-hidden py-2">
                                 @foreach($bpd->take(5) as $anggota)
                                     @if($anggota->foto)
                                         <img class="inline-block h-10 w-10 rounded-full ring-2 ring-white object-cover" src="{{ Storage::url($anggota->foto) }}" alt="{{ $anggota->nama }}">
                                     @else
                                         <div class="inline-block h-10 w-10 rounded-full ring-2 ring-white bg-yellow-200 flex items-center justify-center text-xs ml-0">
                                             {{ substr($anggota->nama, 0, 1) }}
                                         </div>
                                     @endif
                                 @endforeach
                             </div>
                             <p class="text-xs text-gray-600 mt-1">{{ $bpd->count() }} Anggota</p>
                         </div>
                         <!-- Garis Koordinasi (Dotted) -->
                         <div class="absolute top-1/2 left-full w-20 border-t-2 border-dashed border-gray-400 -translate-y-1/2"></div>
                     </div>
                     @endif

                    <!-- Kepala Desa -->
                    <div class="relative z-10">
                        <div class="w-64 bg-white border-2 border-primary-600 rounded-xl p-4 shadow-lg text-center transform hover:scale-105 transition duration-300">
                            <div class="w-24 h-24 mx-auto rounded-full border-4 border-primary-100 overflow-hidden mb-3">
                                @if ($kepalaDesa && $kepalaDesa->foto)
                                    <img src="{{ Storage::url($kepalaDesa->foto) }}" alt="{{ $kepalaDesa->nama }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-primary-50 flex items-center justify-center">
                                        <i class="fas fa-user text-3xl text-primary-300"></i>
                                    </div>
                                @endif
                            </div>
                            <h3 class="font-bold text-gray-800 text-lg">{{ $kepalaDesa->nama ?? 'Kepala Desa' }}</h3>
                            <div class="inline-block bg-primary-600 text-white text-xs px-2 py-1 rounded-full mt-1 mb-1">Kepala Desa</div>
                            @if ($kepalaDesa && $kepalaDesa->nip)
                                <p class="text-xs text-gray-500">NIP: {{ $kepalaDesa->nip }}</p>
                            @endif
                        </div>
                        <!-- Garis ke Bawah -->
                        <div class="absolute top-full left-1/2 w-0.5 h-12 bg-gray-800 -translate-x-1/2"></div>
                    </div>
                </div>

                <!-- Level 2: Sekretaris Desa -->
                @if ($sekretaris)
                <div class="relative mb-12">
                    <div class="w-64 bg-white border-l-4 border-orange-500 rounded-xl p-4 shadow-md text-center transform hover:scale-105 transition duration-300">
                        <div class="w-20 h-20 mx-auto rounded-full border-2 border-orange-100 overflow-hidden mb-2">
                             @if ($sekretaris->foto)
                                <img src="{{ Storage::url($sekretaris->foto) }}" alt="{{ $sekretaris->nama }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-orange-50 flex items-center justify-center">
                                    <i class="fas fa-user text-2xl text-orange-300"></i>
                                </div>
                            @endif
                        </div>
                        <h3 class="font-bold text-gray-800">{{ $sekretaris->nama }}</h3>
                         <div class="inline-block bg-orange-100 text-orange-700 text-xs px-2 py-0.5 rounded-full mt-1">Carik / Sekdes</div>
                    </div>
                    <!-- Garis ke Atas (nyambung dari Kades) -->
                    <!-- Garis ke Bawah (ke Kasi/Kaur) -->
                    <div class="absolute top-full left-1/2 w-0.5 h-12 bg-gray-800 -translate-x-1/2"></div>
                    
                    <!-- Garis Horizontal Staff (Cabang) -->
                    <div class="absolute top-[calc(100%+3rem)] left-1/2 -translate-x-1/2 w-[600px] border-t-2 border-gray-800"></div>
                </div>
                @endif

                <!-- Level 3: Kaur & Kasi -->
                <div class="flex justify-center gap-8 mb-16 pt-0 relative">
                    <!-- Column Left: KAUR (Urusan) -->
                     @foreach ($kaur as $k)
                    <div class="relative flex flex-col items-center">
                        <!-- Garis vertikal dr horizontal line -->
                        <div class="h-8 w-0.5 bg-gray-800 -mt-8 mb-0"></div> 
                        
                        <div class="w-48 bg-white border-t-4 border-blue-500 rounded-lg p-3 shadow-md text-center mt-0 hover:shadow-lg transition">
                             <div class="w-16 h-16 mx-auto rounded-full border border-gray-200 overflow-hidden mb-2">
                                @if ($k->foto)
                                    <img src="{{ Storage::url($k->foto) }}" alt="{{ $k->nama }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                                        <i class="fas fa-user text-gray-400"></i>
                                    </div>
                                @endif
                            </div>
                            <h4 class="font-semibold text-gray-800 text-sm leading-tight">{{ $k->nama }}</h4>
                            <p class="text-xs text-blue-600 mt-1 font-medium">{{ $k->jabatan }}</p>
                        </div>
                    </div>
                    @endforeach

                    <!-- Column Right: KASI (Seksi) -->
                    @foreach ($kasi as $k)
                    <div class="relative flex flex-col items-center">
                         <!-- Garis vertikal dr horizontal line -->
                         <div class="h-8 w-0.5 bg-gray-800 -mt-8 mb-0"></div>

                        <div class="w-48 bg-white border-t-4 border-green-500 rounded-lg p-3 shadow-md text-center mt-0 hover:shadow-lg transition">
                            <div class="w-16 h-16 mx-auto rounded-full border border-gray-200 overflow-hidden mb-2">
                                @if ($k->foto)
                                    <img src="{{ Storage::url($k->foto) }}" alt="{{ $k->nama }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                                        <i class="fas fa-user text-gray-400"></i>
                                    </div>
                                @endif
                            </div>
                            <h4 class="font-semibold text-gray-800 text-sm leading-tight">{{ $k->nama }}</h4>
                            <p class="text-xs text-green-600 mt-1 font-medium">{{ $k->jabatan }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>

                <!-- Level 4: Kepala Dusun -->
                 @if($kadus->count() > 0)
                 <div class="relative w-full flex justify-center mt-8">
                     <!-- Garis penghubung besar dari level Sekdes/Kaur -->
                     <!-- Kita buat garis baru dari tengah-tengah atas -->
                      <div class="absolute -top-16 left-1/2 w-0.5 h-16 bg-gray-800 -translate-x-1/2"></div>
                      
                      <!-- Garis Horizontal Kadus -->
                      <div class="absolute top-0 left-1/2 -translate-x-1/2 w-3/4 border-t-2 border-gray-800"></div>

                     <div class="flex justify-center gap-6 pt-8 w-full">
                         @foreach ($kadus as $k)
                        <div class="relative flex flex-col items-center">
                             <!-- Garis Vertikal Kecil -->
                             <div class="absolute -top-8 w-0.5 h-8 bg-gray-800"></div>

                            <div class="w-40 bg-white border-b-4 border-purple-500 rounded-lg p-3 shadow-md text-center hover:shadow-lg transition">
                                <div class="w-14 h-14 mx-auto rounded-full border border-gray-200 overflow-hidden mb-2">
                                    @if ($k->foto)
                                        <img src="{{ Storage::url($k->foto) }}" alt="{{ $k->nama }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                                            <i class="fas fa-map-marker-alt text-gray-400"></i>
                                        </div>
                                    @endif
                                </div>
                                <h4 class="font-semibold text-gray-800 text-sm leading-tight">{{ $k->nama }}</h4>
                                <p class="text-xs text-purple-600 mt-1 font-medium">{{ $k->jabatan }}</p>
                            </div>
                        </div>
                        @endforeach
                     </div>
                 </div>
                 @endif
            </div>

            <!-- Staff Lain (Jika ada yg tidak masuk kategori) -->
            @if($staff->count() > 0)
                <div class="mt-20 border-t border-gray-200 pt-10">
                    <h3 class="text-center font-bold text-gray-700 text-xl mb-8">Staf & Perangkat Desa Lainnya</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                        @foreach($staff as $s)
                            <div class="bg-white rounded-lg p-4 shadow-sm text-center border border-gray-100">
                                <div class="w-16 h-16 mx-auto rounded-full bg-gray-100 mb-2 overflow-hidden">
                                     @if ($s->foto)
                                        <img src="{{ Storage::url($s->foto) }}" alt="{{ $s->nama }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center">
                                            <i class="fas fa-user text-gray-400"></i>
                                        </div>
                                    @endif
                                </div>
                                <h4 class="font-bold text-gray-800 text-sm">{{ $s->nama }}</h4>
                                <p class="text-xs text-gray-500">{{ $s->jabatan }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Navigation -->
            <div class="flex flex-col sm:flex-row justify-between gap-4 mt-16 max-w-4xl mx-auto">
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

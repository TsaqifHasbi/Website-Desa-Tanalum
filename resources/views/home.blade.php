@extends('layouts.app')

@section('title', 'Beranda')

@section('content')
    <!-- Hero Slider -->
    <section class="relative">
        <div x-data="{
            activeSlide: 0,
            slides: {{ $sliders->count() }},
            autoPlay: null,
            init() {
                this.autoPlay = setInterval(() => { this.next() }, 5000);
            },
            next() {
                this.activeSlide = (this.activeSlide + 1) % this.slides;
            },
            prev() {
                this.activeSlide = this.activeSlide === 0 ? this.slides - 1 : this.activeSlide - 1;
            }
        }" class="relative h-[500px] md:h-[600px] overflow-hidden">
            @forelse($sliders as $index => $slider)
                <div x-show="activeSlide === {{ $index }}" x-transition:enter="transition ease-out duration-500"
                    x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100" class="absolute inset-0">
                    <img src="{{ Storage::url($slider->gambar) }}" alt="{{ $slider->judul }}"
                        class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-r from-black/70 via-black/40 to-transparent"></div>
                    <div class="absolute inset-0 flex items-center">
                        <div class="container mx-auto px-4">
                            <div class="max-w-2xl text-white">
                                @if ($slider->judul)
                                    <h2 class="text-3xl md:text-5xl font-bold mb-4">{{ $slider->judul }}</h2>
                                @endif
                                @if ($slider->deskripsi)
                                    <p class="text-lg md:text-xl mb-6 text-gray-200">{{ $slider->deskripsi }}</p>
                                @endif
                                @if ($slider->link)
                                    <a href="{{ $slider->link }}"
                                        class="inline-flex items-center px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-lg transition">
                                        Selengkapnya
                                        <i class="fas fa-arrow-right ml-2"></i>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="absolute inset-0 bg-gradient-to-r from-primary-700 to-primary-500 flex items-center">
                    <div class="container mx-auto px-4">
                        <div class="max-w-2xl text-white">
                            <h2 class="text-3xl md:text-5xl font-bold mb-4">Selamat Datang di
                                {{ $profil->nama_desa ?? 'Desa Tanalum' }}</h2>
                            <p class="text-lg md:text-xl mb-6 text-gray-100">{{ $profil->kecamatan ?? 'Kec. Marang Kayu' }},
                                {{ $profil->kabupaten ?? 'Kab. Kutai Kartanegara' }}</p>
                        </div>
                    </div>
                </div>
            @endforelse

            @if ($sliders->count() > 1)
                <!-- Navigation Arrows -->
                <button @click="prev()"
                    class="absolute left-4 top-1/2 -translate-y-1/2 p-3 bg-white/20 hover:bg-white/30 text-white rounded-full backdrop-blur-sm transition">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button @click="next()"
                    class="absolute right-4 top-1/2 -translate-y-1/2 p-3 bg-white/20 hover:bg-white/30 text-white rounded-full backdrop-blur-sm transition">
                    <i class="fas fa-chevron-right"></i>
                </button>

                <!-- Dots -->
                <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex space-x-2">
                    @foreach ($sliders as $index => $slider)
                        <button @click="activeSlide = {{ $index }}"
                            :class="{
                                'bg-white': activeSlide === {{ $index }},
                                'bg-white/50': activeSlide !==
                                    {{ $index }}
                            }"
                            class="w-3 h-3 rounded-full transition"></button>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <!-- Quick Stats -->
    <section class="py-8 bg-white shadow-sm">
        <div class="container mx-auto px-4">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="text-center p-4" data-aos="fade-up" data-aos-delay="0">
                    <div class="text-3xl md:text-4xl font-bold text-primary-600">
                        {{ number_format($statistik->jumlah_penduduk ?? 0) }}</div>
                    <div class="text-sm text-gray-600 mt-1">Jumlah Penduduk</div>
                </div>
                <div class="text-center p-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-3xl md:text-4xl font-bold text-primary-600">
                        {{ number_format($statistik->jumlah_kk ?? 0) }}</div>
                    <div class="text-sm text-gray-600 mt-1">Kepala Keluarga</div>
                </div>
                <div class="text-center p-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-3xl md:text-4xl font-bold text-primary-600">{{ $profil->jumlah_dusun ?? 0 }}</div>
                    <div class="text-sm text-gray-600 mt-1">Jumlah Dusun</div>
                </div>
                <div class="text-center p-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="text-3xl md:text-4xl font-bold text-primary-600">
                        {{ number_format($profil->luas_wilayah ?? 0, 2) }}</div>
                    <div class="text-sm text-gray-600 mt-1">Luas Wilayah (Km²)</div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div data-aos="fade-right">
                    @if ($profil->foto_kantor)
                        <img src="{{ Storage::url($profil->foto_kantor) }}" alt="Kantor Desa"
                            class="rounded-2xl shadow-lg w-full">
                    @else
                        <div
                            class="aspect-video bg-gradient-to-br from-primary-100 to-primary-200 rounded-2xl flex items-center justify-center">
                            <i class="fas fa-landmark text-6xl text-primary-500"></i>
                        </div>
                    @endif
                </div>
                <div data-aos="fade-left">
                    <span class="text-primary-600 font-semibold">Tentang Kami</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mt-2 mb-6">
                        {{ $profil->nama_desa ?? 'Desa Tanalum' }}</h2>
                    <p class="text-gray-600 leading-relaxed mb-6">
                        {{ Str::limit($profil->sejarah ?? 'Desa Tanalum merupakan salah satu desa yang terletak di Kecamatan Marang Kayu, Kabupaten Kutai Kartanegara, Provinsi Kalimantan Timur. Desa ini memiliki potensi alam yang melimpah dan masyarakat yang ramah.', 300) }}
                    </p>
                    <div class="grid grid-cols-2 gap-4 mb-6">
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-map-marker-alt text-primary-600"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Kecamatan</p>
                                <p class="font-semibold text-gray-800">{{ $profil->kecamatan ?? 'Marang Kayu' }}</p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <div class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center mr-3">
                                <i class="fas fa-city text-primary-600"></i>
                            </div>
                            <div>
                                <p class="text-sm text-gray-500">Kabupaten</p>
                                <p class="font-semibold text-gray-800">{{ $profil->kabupaten ?? 'Kutai Kartanegara' }}</p>
                            </div>
                        </div>
                    </div>
                    <a href="{{ route('profil.index') }}"
                        class="inline-flex items-center px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-lg transition">
                        Selengkapnya
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Kepala Desa Section -->
    @if ($kepalaDesa)
        <section class="py-16 bg-gradient-to-br from-primary-600 to-primary-700 text-white">
            <div class="container mx-auto px-4">
                <div class="grid lg:grid-cols-2 gap-12 items-center">
                    <div class="text-center lg:text-left order-2 lg:order-1" data-aos="fade-right">
                        <span class="text-primary-200 font-semibold">Sambutan Kepala Desa</span>
                        <h2 class="text-3xl md:text-4xl font-bold mt-2 mb-6">{{ $kepalaDesa->nama }}</h2>
                        <p class="text-primary-100 leading-relaxed mb-6">
                            "Selamat datang di website resmi {{ $profil->nama_desa ?? 'Desa Tanalum' }}. Website ini hadir
                            sebagai media informasi dan komunikasi antara pemerintah desa dengan masyarakat. Kami berharap
                            website ini dapat memberikan manfaat bagi seluruh warga desa dan masyarakat luas."
                        </p>
                        <div class="flex items-center justify-center lg:justify-start space-x-4">
                            <div>
                                <p class="font-bold text-lg">{{ $kepalaDesa->nama }}</p>
                                <p class="text-primary-200">{{ $kepalaDesa->jabatan }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="text-center order-1 lg:order-2" data-aos="fade-left">
                        @if ($kepalaDesa->foto)
                            <img src="{{ Storage::url($kepalaDesa->foto) }}" alt="{{ $kepalaDesa->nama }}"
                                class="w-64 h-64 mx-auto rounded-full object-cover border-4 border-white shadow-xl">
                        @else
                            <div
                                class="w-64 h-64 mx-auto rounded-full bg-primary-500 flex items-center justify-center border-4 border-white shadow-xl">
                                <i class="fas fa-user text-6xl text-white"></i>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- Berita Section -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12" data-aos="fade-up">
                <span class="text-primary-600 font-semibold">Berita Terbaru</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mt-2">Kabar Desa</h2>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($beritas as $index => $berita)
                    <article class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-lg transition group"
                        data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <a href="{{ route('berita.show', $berita->slug) }}">
                            <div class="aspect-video overflow-hidden">
                                @if ($berita->gambar_utama)
                                    <img src="{{ Storage::url($berita->gambar_utama) }}" alt="{{ $berita->judul }}"
                                        class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                @else
                                    <div
                                        class="w-full h-full bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center">
                                        <i class="fas fa-newspaper text-4xl text-primary-400"></i>
                                    </div>
                                @endif
                            </div>
                        </a>
                        <div class="p-6">
                            <div class="flex items-center space-x-4 text-sm text-gray-500 mb-3">
                                <span><i class="far fa-calendar mr-1"></i>
                                    {{ $berita->published_at ? $berita->published_at->format('d M Y') : $berita->created_at->format('d M Y') }}</span>
                                @if ($berita->kategori)
                                    <span
                                        class="px-2 py-0.5 bg-primary-100 text-primary-700 rounded text-xs">{{ $berita->kategori->nama }}</span>
                                @endif
                            </div>
                            <h3
                                class="font-bold text-lg text-gray-800 mb-2 line-clamp-2 group-hover:text-primary-600 transition">
                                <a href="{{ route('berita.show', $berita->slug) }}">{{ $berita->judul }}</a>
                            </h3>
                            <p class="text-gray-600 text-sm line-clamp-3">
                                {{ $berita->ringkasan ?? Str::limit(strip_tags($berita->konten), 120) }}</p>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full text-center py-12 text-gray-500">
                        <i class="fas fa-newspaper text-4xl mb-4"></i>
                        <p>Belum ada berita yang dipublikasikan.</p>
                    </div>
                @endforelse
            </div>

            @if ($beritas->count() > 0)
                <div class="text-center mt-10" data-aos="fade-up">
                    <a href="{{ route('berita.index') }}"
                        class="inline-flex items-center px-6 py-3 border-2 border-primary-600 text-primary-600 hover:bg-primary-600 hover:text-white font-semibold rounded-lg transition">
                        Lihat Semua Berita
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- Infografis Section -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12" data-aos="fade-up">
                <span class="text-primary-600 font-semibold">Infografis</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mt-2">Data & Statistik Desa</h2>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                <a href="{{ route('infografis.penduduk') }}" class="group" data-aos="fade-up" data-aos-delay="0">
                    <div
                        class="bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl p-6 text-white hover:shadow-lg transition">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                <i class="fas fa-users text-xl"></i>
                            </div>
                            <i class="fas fa-arrow-right opacity-0 group-hover:opacity-100 transition"></i>
                        </div>
                        <h3 class="font-bold text-xl mb-2">Data Penduduk</h3>
                        <p class="text-blue-100 text-sm">Statistik kependudukan berdasarkan usia, jenis kelamin,
                            pendidikan, dan pekerjaan.</p>
                    </div>
                </a>

                <a href="{{ route('infografis.apbdes') }}" class="group" data-aos="fade-up" data-aos-delay="100">
                    <div
                        class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-6 text-white hover:shadow-lg transition">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                <i class="fas fa-money-bill-wave text-xl"></i>
                            </div>
                            <i class="fas fa-arrow-right opacity-0 group-hover:opacity-100 transition"></i>
                        </div>
                        <h3 class="font-bold text-xl mb-2">APBDes</h3>
                        <p class="text-green-100 text-sm">Anggaran Pendapatan dan Belanja Desa tahun {{ date('Y') }}.
                        </p>
                    </div>
                </a>

                <a href="{{ route('infografis.idm') }}" class="group" data-aos="fade-up" data-aos-delay="200">
                    <div
                        class="bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl p-6 text-white hover:shadow-lg transition">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                <i class="fas fa-chart-line text-xl"></i>
                            </div>
                            <i class="fas fa-arrow-right opacity-0 group-hover:opacity-100 transition"></i>
                        </div>
                        <h3 class="font-bold text-xl mb-2">IDM</h3>
                        <p class="text-purple-100 text-sm">Indeks Desa Membangun dan status perkembangan desa.</p>
                    </div>
                </a>

                <a href="{{ route('infografis.sdgs') }}" class="group" data-aos="fade-up" data-aos-delay="300">
                    <div
                        class="bg-gradient-to-br from-orange-500 to-orange-600 rounded-2xl p-6 text-white hover:shadow-lg transition">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                <i class="fas fa-globe text-xl"></i>
                            </div>
                            <i class="fas fa-arrow-right opacity-0 group-hover:opacity-100 transition"></i>
                        </div>
                        <h3 class="font-bold text-xl mb-2">SDGs Desa</h3>
                        <p class="text-orange-100 text-sm">Capaian Sustainable Development Goals (SDGs) Desa.</p>
                    </div>
                </a>

                <a href="{{ route('infografis.bansos') }}" class="group" data-aos="fade-up" data-aos-delay="400">
                    <div
                        class="bg-gradient-to-br from-pink-500 to-pink-600 rounded-2xl p-6 text-white hover:shadow-lg transition">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                <i class="fas fa-hand-holding-heart text-xl"></i>
                            </div>
                            <i class="fas fa-arrow-right opacity-0 group-hover:opacity-100 transition"></i>
                        </div>
                        <h3 class="font-bold text-xl mb-2">Bantuan Sosial</h3>
                        <p class="text-pink-100 text-sm">Data penerima bantuan sosial di desa.</p>
                    </div>
                </a>

                <a href="{{ route('cek-bansos') }}" class="group" data-aos="fade-up" data-aos-delay="500">
                    <div
                        class="bg-gradient-to-br from-teal-500 to-teal-600 rounded-2xl p-6 text-white hover:shadow-lg transition">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                <i class="fas fa-search text-xl"></i>
                            </div>
                            <i class="fas fa-arrow-right opacity-0 group-hover:opacity-100 transition"></i>
                        </div>
                        <h3 class="font-bold text-xl mb-2">Cek Penerima Bansos</h3>
                        <p class="text-teal-100 text-sm">Cek status penerima bantuan sosial berdasarkan NIK.</p>
                    </div>
                </a>
            </div>
        </div>
    </section>

    <!-- Produk UMKM Section -->
    @if ($produks->count() > 0)
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12" data-aos="fade-up">
                    <span class="text-primary-600 font-semibold">Belanja Produk Desa</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mt-2">Produk UMKM</h2>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach ($produks as $index => $produk)
                        <div class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-lg transition group"
                            data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                            <a href="{{ route('belanja.show', $produk->slug) }}">
                                <div class="aspect-square overflow-hidden">
                                    @if ($produk->gambar)
                                        <img src="{{ Storage::url($produk->gambar) }}" alt="{{ $produk->nama }}"
                                            class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                    @else
                                        <div
                                            class="w-full h-full bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center">
                                            <i class="fas fa-box text-4xl text-primary-400"></i>
                                        </div>
                                    @endif
                                </div>
                            </a>
                            <div class="p-5">
                                @if ($produk->kategori)
                                    <span
                                        class="text-xs text-primary-600 font-medium">{{ $produk->kategori->nama }}</span>
                                @endif
                                <h3 class="font-semibold text-lg text-gray-800 mt-1 line-clamp-2">
                                    <a href="{{ route('belanja.show', $produk->slug) }}"
                                        class="hover:text-primary-600 transition">{{ $produk->nama }}</a>
                                </h3>
                                <p class="text-primary-600 font-bold text-lg mt-2">{{ $produk->formatted_harga }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-10" data-aos="fade-up">
                    <a href="{{ route('belanja.index') }}"
                        class="inline-flex items-center px-6 py-3 border-2 border-primary-600 text-primary-600 hover:bg-primary-600 hover:text-white font-semibold rounded-lg transition">
                        Lihat Semua Produk
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </section>
    @endif

    <!-- Galeri Section -->
    @if ($galeris->count() > 0)
        <section class="py-16">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12" data-aos="fade-up">
                    <span class="text-primary-600 font-semibold">Dokumentasi</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mt-2">Galeri Desa</h2>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    @foreach ($galeris as $index => $galeri)
                        <div class="group relative aspect-square overflow-hidden rounded-xl" data-aos="fade-up"
                            data-aos-delay="{{ $index * 50 }}">
                            @if ($galeri->file_path)
                                <img src="{{ Storage::url($galeri->file_path) }}" alt="{{ $galeri->judul }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition duration-300">
                            @endif
                            <div
                                class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition flex items-center justify-center">
                                <span class="text-white font-medium text-center px-4">{{ $galeri->judul }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-10" data-aos="fade-up">
                    <a href="{{ route('galeri.index') }}"
                        class="inline-flex items-center px-6 py-3 border-2 border-primary-600 text-primary-600 hover:bg-primary-600 hover:text-white font-semibold rounded-lg transition">
                        Lihat Galeri Lengkap
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </section>
    @endif

    <!-- Aparatur Section -->
    @if ($aparaturs->count() > 0)
        <section class="py-16 bg-gray-50">
            <div class="container mx-auto px-4">
                <div class="text-center mb-12" data-aos="fade-up">
                    <span class="text-primary-600 font-semibold">Pemerintahan</span>
                    <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mt-2">Aparatur Desa</h2>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
                    @foreach ($aparaturs as $index => $aparatur)
                        <div class="text-center" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                            <div
                                class="w-32 h-32 mx-auto rounded-full overflow-hidden mb-4 border-4 border-white shadow-lg">
                                @if ($aparatur->foto)
                                    <img src="{{ Storage::url($aparatur->foto) }}" alt="{{ $aparatur->nama }}"
                                        class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-primary-100 flex items-center justify-center">
                                        <i class="fas fa-user text-3xl text-primary-400"></i>
                                    </div>
                                @endif
                            </div>
                            <h3 class="font-semibold text-gray-800">{{ $aparatur->nama }}</h3>
                            <p class="text-sm text-gray-500">{{ $aparatur->jabatan }}</p>
                        </div>
                    @endforeach
                </div>

                <div class="text-center mt-10" data-aos="fade-up">
                    <a href="{{ route('profil.struktur') }}"
                        class="inline-flex items-center px-6 py-3 border-2 border-primary-600 text-primary-600 hover:bg-primary-600 hover:text-white font-semibold rounded-lg transition">
                        Lihat Struktur Organisasi
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </section>
    @endif

    <!-- CTA Section -->
    <section class="py-16 bg-primary-600">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto text-center text-white">
                <h2 class="text-3xl md:text-4xl font-bold mb-4" data-aos="fade-up">Ada Keluhan atau Pengaduan?</h2>
                <p class="text-lg text-primary-100 mb-8" data-aos="fade-up" data-aos-delay="100">
                    Sampaikan keluhan, saran, atau pengaduan Anda kepada kami. Kami siap mendengarkan dan membantu
                    menyelesaikan permasalahan Anda.
                </p>
                <div class="flex flex-col sm:flex-row items-center justify-center space-y-4 sm:space-y-0 sm:space-x-4"
                    data-aos="fade-up" data-aos-delay="200">
                    <a href="{{ route('pengaduan.create') }}"
                        class="px-8 py-3 bg-white text-primary-600 hover:bg-gray-100 font-semibold rounded-lg transition">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Kirim Pengaduan
                    </a>
                    <a href="{{ route('ppid.permohonan') }}"
                        class="px-8 py-3 border-2 border-white text-white hover:bg-white hover:text-primary-600 font-semibold rounded-lg transition">
                        <i class="fas fa-file-alt mr-2"></i>
                        Permohonan Informasi
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection

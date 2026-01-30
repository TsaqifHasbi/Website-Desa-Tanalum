<header class="bg-white shadow-sm sticky top-0 z-50" x-data="{ mobileMenuOpen: false, profilOpen: false, infografisOpen: false }">
    <!-- Top Bar -->
    <div class="bg-primary-700 text-white py-2">
        <div class="container mx-auto px-4">
            <div class="flex flex-wrap items-center justify-between text-sm">
                <div class="flex items-center space-x-4">
                    <a href="mailto:{{ $profil->email ?? 'desa@tanalum.desa.id' }}"
                        class="flex items-center hover:text-primary-200">
                        <i class="fas fa-envelope mr-2"></i>
                        <span class="hidden sm:inline">{{ $profil->email ?? 'desa@tanalum.desa.id' }}</span>
                    </a>
                    <span class="hidden md:flex items-center">
                        <i class="fas fa-phone mr-2"></i>
                        {{ $profil->telepon ?? '0541-123456' }}
                    </span>
                </div>
                <div class="flex items-center space-x-4">
                    @php
                        $facebook = App\Models\Setting::getValue('social_facebook');
                        $instagram = App\Models\Setting::getValue('social_instagram');
                        $youtube = App\Models\Setting::getValue('social_youtube');
                    @endphp
                    @if ($facebook)
                        <a href="{{ $facebook }}" target="_blank" class="hover:text-primary-200"><i
                                class="fab fa-facebook-f"></i></a>
                    @endif
                    @if ($instagram)
                        <a href="{{ $instagram }}" target="_blank" class="hover:text-primary-200"><i
                                class="fab fa-instagram"></i></a>
                    @endif
                    @if ($youtube)
                        <a href="{{ $youtube }}" target="_blank" class="hover:text-primary-200"><i
                                class="fab fa-youtube"></i></a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Main Navigation -->
    <nav class="container mx-auto px-4">
        <div class="flex items-center justify-between h-20">
            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center space-x-3">
                @php $logo = App\Models\Setting::getValue('site_logo'); @endphp
                @if ($logo)
                    <img src="{{ Storage::url($logo) }}" alt="Logo" class="h-12 w-auto">
                @else
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-12 w-auto"
                        onerror="this.style.display='none'">
                @endif
                <div>
                    <h1 class="font-bold text-lg text-gray-800 leading-tight">{{ $profil->nama_desa ?? 'Desa Tanalum' }}
                    </h1>
                    <p class="text-xs text-gray-500">{{ $profil->kabupaten ?? 'Kab. Rembang' }}</p>
                </div>
            </a>

            <!-- Desktop Menu -->
            <div class="hidden lg:flex items-center space-x-1">
                <a href="{{ route('home') }}"
                    class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition {{ request()->routeIs('home') ? 'text-primary-600 bg-primary-50' : '' }}">
                    Beranda
                </a>

                <!-- Profil Dropdown -->
                <div class="relative" @mouseenter="profilOpen = true" @mouseleave="profilOpen = false">
                    <button
                        class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition flex items-center {{ request()->routeIs('profil.*') ? 'text-primary-600 bg-primary-50' : '' }}">
                        Profil Desa
                        <i class="fas fa-chevron-down ml-2 text-xs"></i>
                    </button>
                    <div x-show="profilOpen" x-cloak x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="absolute left-0 mt-1 w-48 bg-white rounded-lg shadow-lg border border-gray-100 py-2 z-50">
                        <a href="{{ route('profil.index') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600">Tentang
                            Desa</a>
                        <a href="{{ route('profil.visi-misi') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600">Visi
                            & Misi</a>
                        <a href="{{ route('profil.sejarah') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600">Sejarah
                            Desa</a>
                        <a href="{{ route('profil.struktur') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600">Struktur
                            Organisasi</a>
                        <a href="{{ route('profil.peta') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600">Peta
                            Desa</a>
                        <a href="{{ route('profil.demografi') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600">Demografi</a>
                    </div>
                </div>

                <!-- Infografis Dropdown -->
                <div class="relative" @mouseenter="infografisOpen = true" @mouseleave="infografisOpen = false">
                    <button
                        class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition flex items-center {{ request()->routeIs('infografis.*') ? 'text-primary-600 bg-primary-50' : '' }}">
                        Infografis
                        <i class="fas fa-chevron-down ml-2 text-xs"></i>
                    </button>
                    <div x-show="infografisOpen" x-cloak x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="absolute left-0 mt-1 w-56 bg-white rounded-lg shadow-lg border border-gray-100 py-2 z-50">
                        <a href="{{ route('infografis.penduduk') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600">Data
                            Penduduk</a>
                        <a href="{{ route('infografis.apbdes') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600">APBDes</a>
                        <a href="{{ route('infografis.stunting') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600">Stunting</a>
                        <a href="{{ route('infografis.bansos') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600">Bantuan
                            Sosial</a>
                        <a href="{{ route('infografis.idm') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600">IDM</a>
                        <a href="{{ route('infografis.sdgs') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600">SDGs
                            Desa</a>
                        <a href="{{ route('cek-bansos') }}"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600">Cek
                            Penerima Bansos</a>
                    </div>
                </div>

                <a href="{{ route('berita.index') }}"
                    class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition {{ request()->routeIs('berita.*') ? 'text-primary-600 bg-primary-50' : '' }}">
                    Berita
                </a>

                <a href="{{ route('belanja.index') }}"
                    class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition {{ request()->routeIs('belanja.*') ? 'text-primary-600 bg-primary-50' : '' }}">
                    Belanja
                </a>

                <a href="{{ route('wisata.index') }}"
                    class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition {{ request()->routeIs('wisata.*') ? 'text-primary-600 bg-primary-50' : '' }}">
                    Wisata
                </a>

                <a href="{{ route('galeri.index') }}"
                    class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition {{ request()->routeIs('galeri.*') ? 'text-primary-600 bg-primary-50' : '' }}">
                    Galeri
                </a>

                <a href="{{ route('ppid.index') }}"
                    class="px-4 py-2 text-sm font-medium text-gray-700 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition {{ request()->routeIs('ppid.*') ? 'text-primary-600 bg-primary-50' : '' }}">
                    PPID
                </a>

                <a href="{{ route('pengaduan.index') }}"
                    class="ml-2 px-4 py-2 text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 rounded-lg transition">
                    <i class="fas fa-headset mr-2"></i>
                    Pengaduan
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <button @click="mobileMenuOpen = !mobileMenuOpen"
                class="lg:hidden p-2 text-gray-700 hover:bg-gray-100 rounded-lg">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" x-cloak x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            class="lg:hidden py-4 border-t border-gray-100">
            <div class="space-y-2">
                <a href="{{ route('home') }}"
                    class="block px-4 py-2 text-gray-700 hover:bg-primary-50 hover:text-primary-600 rounded-lg">Beranda</a>

                <div x-data="{ open: false }">
                    <button @click="open = !open"
                        class="w-full flex items-center justify-between px-4 py-2 text-gray-700 hover:bg-primary-50 hover:text-primary-600 rounded-lg">
                        <span>Profil Desa</span>
                        <i class="fas fa-chevron-down text-xs transition-transform"
                            :class="{ 'rotate-180': open }"></i>
                    </button>
                    <div x-show="open" class="pl-4 mt-1 space-y-1">
                        <a href="{{ route('profil.index') }}"
                            class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600">Tentang Desa</a>
                        <a href="{{ route('profil.visi-misi') }}"
                            class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600">Visi & Misi</a>
                        <a href="{{ route('profil.sejarah') }}"
                            class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600">Sejarah Desa</a>
                        <a href="{{ route('profil.struktur') }}"
                            class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600">Struktur
                            Organisasi</a>
                        <a href="{{ route('profil.peta') }}"
                            class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600">Peta Desa</a>
                        <a href="{{ route('profil.demografi') }}"
                            class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600">Demografi</a>
                    </div>
                </div>

                <div x-data="{ open: false }">
                    <button @click="open = !open"
                        class="w-full flex items-center justify-between px-4 py-2 text-gray-700 hover:bg-primary-50 hover:text-primary-600 rounded-lg">
                        <span>Infografis</span>
                        <i class="fas fa-chevron-down text-xs transition-transform"
                            :class="{ 'rotate-180': open }"></i>
                    </button>
                    <div x-show="open" class="pl-4 mt-1 space-y-1">
                        <a href="{{ route('infografis.penduduk') }}"
                            class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600">Data Penduduk</a>
                        <a href="{{ route('infografis.apbdes') }}"
                            class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600">APBDes</a>
                        <a href="{{ route('infografis.stunting') }}"
                            class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600">Stunting</a>
                        <a href="{{ route('infografis.bansos') }}"
                            class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600">Bantuan Sosial</a>
                        <a href="{{ route('infografis.idm') }}"
                            class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600">IDM</a>
                        <a href="{{ route('infografis.sdgs') }}"
                            class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600">SDGs Desa</a>
                    </div>
                </div>

                <a href="{{ route('berita.index') }}"
                    class="block px-4 py-2 text-gray-700 hover:bg-primary-50 hover:text-primary-600 rounded-lg">Berita</a>
                <a href="{{ route('belanja.index') }}"
                    class="block px-4 py-2 text-gray-700 hover:bg-primary-50 hover:text-primary-600 rounded-lg">Belanja</a>
                <a href="{{ route('wisata.index') }}"
                    class="block px-4 py-2 text-gray-700 hover:bg-primary-50 hover:text-primary-600 rounded-lg">Wisata</a>
                <a href="{{ route('galeri.index') }}"
                    class="block px-4 py-2 text-gray-700 hover:bg-primary-50 hover:text-primary-600 rounded-lg">Galeri</a>
                <a href="{{ route('ppid.index') }}"
                    class="block px-4 py-2 text-gray-700 hover:bg-primary-50 hover:text-primary-600 rounded-lg">PPID</a>
                <a href="{{ route('pengaduan.create') }}"
                    class="block px-4 py-2 text-white bg-primary-600 hover:bg-primary-700 rounded-lg text-center">
                    <i class="fas fa-headset mr-2"></i>Pengaduan
                </a>
            </div>
        </div>
    </nav>
</header>

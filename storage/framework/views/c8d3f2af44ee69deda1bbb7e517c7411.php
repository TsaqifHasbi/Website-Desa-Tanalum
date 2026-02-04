<header x-data="{
    mobileMenuOpen: false,
    profilOpen: false,
    infografisOpen: false,
    scrolled: false,
    isHomePage: <?php echo e(request()->routeIs('home') ? 'true' : 'false'); ?>

}" x-init="window.addEventListener('scroll', () => { scrolled = window.scrollY > 50 })"
    :class="{
        'bg-white shadow-sm': scrolled || !isHomePage,
        'bg-transparent': !scrolled && isHomePage
    }"
    class="fixed top-0 left-0 right-0 z-50 transition-all duration-300">
    <!-- Top Bar -->
    

    <!-- Main Navigation -->
    <nav class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-20 lg:h-24 transition-all duration-300">
            <!-- Logo -->
            <a href="<?php echo e(route('home')); ?>" class="flex items-center space-x-2 md:space-x-3 gap-1">
                <?php $logo = App\Models\Setting::getValue('site_logo', 'slider/logo-tanalum.png'); ?>
                <?php if($logo && Storage::disk('public')->exists($logo)): ?>
                    <img src="<?php echo e(Storage::url($logo)); ?>" alt="Logo" class="h-10 md:h-14 lg:h-16 w-auto transition-all duration-300">
                <?php else: ?>
                    <div class="w-10 h-10 md:w-16 md:h-16 bg-primary-600 rounded-full flex items-center justify-center">
                        <i class="fas fa-landmark text-white text-sm md:text-lg"></i>
                    </div>
                <?php endif; ?>
                <div class="flex flex-col justify-center">
                    <h1 class="font-bold text-base md:text-lg lg:text-xl leading-tight transition-colors duration-300 line-clamp-1"
                        :class="scrolled || !isHomePage ? 'text-gray-800' : 'text-white'">
                        <?php echo e($profil->nama_desa ?? 'Desa Tanalum'); ?>

                    </h1>
                    <p class="text-xs md:text-sm lg:text-md transition-colors duration-300 hidden sm:block"
                        :class="scrolled || !isHomePage ? 'text-gray-500' : 'text-gray-200'">
                        Kecamatan <?php echo e($profil->kecamatan ?? 'Kec. Rembang'); ?></p>
                </div>
            </a>

            <!-- Desktop Menu -->
            <div class="hidden lg:flex items-center space-x-1">
                <a href="<?php echo e(route('home')); ?>"
                    class="relative px-4 py-2 text-sm font-medium transition-colors duration-300 <?php echo e(request()->routeIs('home') ? 'after:absolute after:bottom-0 after:left-4 after:right-4 after:h-0.5 after:bg-primary-600' : ''); ?>"
                    :class="scrolled || !isHomePage ?
                        'text-gray-700 hover:text-primary-600 <?php echo e(request()->routeIs('home') ? 'text-primary-600' : ''); ?>' :
                        'text-white hover:text-gray-200 <?php echo e(request()->routeIs('home') ? 'after:bg-white' : ''); ?>'">
                    Beranda
                </a>

                <!-- Profil Dropdown -->
                <div class="relative" @mouseenter="profilOpen = true" @mouseleave="profilOpen = false">
                    <button
                        class="relative px-4 py-2 text-sm font-medium transition-colors duration-300 flex items-center <?php echo e(request()->routeIs('profil.*') ? 'after:absolute after:bottom-0 after:left-4 after:right-4 after:h-0.5 after:bg-primary-600' : ''); ?>"
                        :class="scrolled || !isHomePage ?
                            'text-gray-700 hover:text-primary-600 <?php echo e(request()->routeIs('profil.*') ? 'text-primary-600' : ''); ?>' :
                            'text-white hover:text-gray-200 <?php echo e(request()->routeIs('profil.*') ? 'after:bg-white' : ''); ?>'">
                        Profil Desa
                        <i class="fas fa-chevron-down ml-2 text-xs"></i>
                    </button>
                    <div x-show="profilOpen" x-cloak x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="absolute left-0 mt-1 w-48 bg-white rounded-lg shadow-lg border border-gray-100 py-2 z-50">
                        <a href="<?php echo e(route('profil.index')); ?>"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600">Tentang
                            Desa</a>
                        <a href="<?php echo e(route('profil.visi-misi')); ?>"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600">Visi
                            & Misi</a>
                        <a href="<?php echo e(route('profil.sejarah')); ?>"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600">Sejarah
                            Desa</a>
                        <a href="<?php echo e(route('profil.struktur')); ?>"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600">Struktur
                            Organisasi</a>
                        <a href="<?php echo e(route('profil.peta')); ?>"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600">Peta
                            Desa</a>
                        <a href="<?php echo e(route('profil.demografi')); ?>"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600">Demografi</a>
                    </div>
                </div>

                <!-- Infografis Dropdown -->
                <div class="relative" @mouseenter="infografisOpen = true" @mouseleave="infografisOpen = false">
                    <button
                        class="relative px-4 py-2 text-sm font-medium transition-colors duration-300 flex items-center <?php echo e(request()->routeIs('infografis.*') ? 'after:absolute after:bottom-0 after:left-4 after:right-4 after:h-0.5 after:bg-primary-600' : ''); ?>"
                        :class="scrolled || !isHomePage ?
                            'text-gray-700 hover:text-primary-600 <?php echo e(request()->routeIs('infografis.*') ? 'text-primary-600' : ''); ?>' :
                            'text-white hover:text-gray-200 <?php echo e(request()->routeIs('infografis.*') ? 'after:bg-white' : ''); ?>'">
                        Infografis
                        <i class="fas fa-chevron-down ml-2 text-xs"></i>
                    </button>
                    <div x-show="infografisOpen" x-cloak x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 translate-y-1"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="absolute left-0 mt-1 w-56 bg-white rounded-lg shadow-lg border border-gray-100 py-2 z-50">
                        <a href="<?php echo e(route('infografis.penduduk')); ?>"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600">Data
                            Penduduk</a>
                        <a href="<?php echo e(route('infografis.apbdes')); ?>"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600">APBDes</a>
                        <a href="<?php echo e(route('infografis.stunting')); ?>"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600">Stunting</a>
                        <a href="<?php echo e(route('infografis.bansos')); ?>"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600">Bantuan
                            Sosial</a>
                        <a href="<?php echo e(route('infografis.idm')); ?>"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600">IDM</a>
                        <a href="<?php echo e(route('infografis.sdgs')); ?>"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600">SDGs
                            Desa</a>
                        <a href="<?php echo e(route('cek-bansos')); ?>"
                            class="block px-4 py-2 text-sm text-gray-700 hover:bg-primary-50 hover:text-primary-600">Cek
                            Penerima Bansos</a>
                    </div>
                </div>

                <a href="<?php echo e(route('berita.index')); ?>"
                    class="relative px-4 py-2 text-sm font-medium transition-colors duration-300 <?php echo e(request()->routeIs('berita.*') ? 'after:absolute after:bottom-0 after:left-4 after:right-4 after:h-0.5 after:bg-primary-600' : ''); ?>"
                    :class="scrolled || !isHomePage ?
                        'text-gray-700 hover:text-primary-600 <?php echo e(request()->routeIs('berita.*') ? 'text-primary-600' : ''); ?>' :
                        'text-white hover:text-gray-200 <?php echo e(request()->routeIs('berita.*') ? 'after:bg-white' : ''); ?>'">
                    Berita
                </a>

                <a href="<?php echo e(route('belanja.index')); ?>"
                    class="relative px-4 py-2 text-sm font-medium transition-colors duration-300 <?php echo e(request()->routeIs('belanja.*') ? 'after:absolute after:bottom-0 after:left-4 after:right-4 after:h-0.5 after:bg-primary-600' : ''); ?>"
                    :class="scrolled || !isHomePage ?
                        'text-gray-700 hover:text-primary-600 <?php echo e(request()->routeIs('belanja.*') ? 'text-primary-600' : ''); ?>' :
                        'text-white hover:text-gray-200 <?php echo e(request()->routeIs('belanja.*') ? 'after:bg-white' : ''); ?>'">
                    Belanja
                </a>

                <a href="<?php echo e(route('wisata.index')); ?>"
                    class="relative px-4 py-2 text-sm font-medium transition-colors duration-300 <?php echo e(request()->routeIs('wisata.*') ? 'after:absolute after:bottom-0 after:left-4 after:right-4 after:h-0.5 after:bg-primary-600' : ''); ?>"
                    :class="scrolled || !isHomePage ?
                        'text-gray-700 hover:text-primary-600 <?php echo e(request()->routeIs('wisata.*') ? 'text-primary-600' : ''); ?>' :
                        'text-white hover:text-gray-200 <?php echo e(request()->routeIs('wisata.*') ? 'after:bg-white' : ''); ?>'">
                    Wisata
                </a>

                <a href="<?php echo e(route('galeri.index')); ?>"
                    class="relative px-4 py-2 text-sm font-medium transition-colors duration-300 <?php echo e(request()->routeIs('galeri.*') ? 'after:absolute after:bottom-0 after:left-4 after:right-4 after:h-0.5 after:bg-primary-600' : ''); ?>"
                    :class="scrolled || !isHomePage ?
                        'text-gray-700 hover:text-primary-600 <?php echo e(request()->routeIs('galeri.*') ? 'text-primary-600' : ''); ?>' :
                        'text-white hover:text-gray-200 <?php echo e(request()->routeIs('galeri.*') ? 'after:bg-white' : ''); ?>'">
                    Galeri
                </a>

                <a href="<?php echo e(route('ppid.index')); ?>"
                    class="relative px-4 py-2 text-sm font-medium transition-colors duration-300 <?php echo e(request()->routeIs('ppid.*') ? 'after:absolute after:bottom-0 after:left-4 after:right-4 after:h-0.5 after:bg-primary-600' : ''); ?>"
                    :class="scrolled || !isHomePage ?
                        'text-gray-700 hover:text-primary-600 <?php echo e(request()->routeIs('ppid.*') ? 'text-primary-600' : ''); ?>' :
                        'text-white hover:text-gray-200 <?php echo e(request()->routeIs('ppid.*') ? 'after:bg-white' : ''); ?>'">
                    PPID
                </a>

                <a href="<?php echo e(route('pengaduan.index')); ?>"
                    class="ml-2 px-4 py-2 text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 rounded-lg transition">
                    <i class="fas fa-headset mr-2"></i>
                    Pengaduan
                </a>
            </div>

            <!-- Mobile Menu Button -->
            <button @click="mobileMenuOpen = !mobileMenuOpen"
                class="lg:hidden p-2 rounded-lg transition-colors duration-300"
                :class="scrolled || !isHomePage ? 'text-gray-700 hover:bg-gray-100' : 'text-white hover:bg-white/20'">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenuOpen" x-cloak x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0"
            class="lg:hidden py-4 border-t border-gray-100 bg-white shadow-lg">
            <div class="space-y-2">
                <a href="<?php echo e(route('home')); ?>"
                    class="block px-4 py-2 text-gray-700 hover:bg-primary-50 hover:text-primary-600 rounded-lg">Beranda</a>

                <div x-data="{ open: false }">
                    <button @click="open = !open"
                        class="w-full flex items-center justify-between px-4 py-2 text-gray-700 hover:bg-primary-50 hover:text-primary-600 rounded-lg">
                        <span>Profil Desa</span>
                        <i class="fas fa-chevron-down text-xs transition-transform"
                            :class="{ 'rotate-180': open }"></i>
                    </button>
                    <div x-show="open" class="pl-4 mt-1 space-y-1">
                        <a href="<?php echo e(route('profil.index')); ?>"
                            class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600">Tentang Desa</a>
                        <a href="<?php echo e(route('profil.visi-misi')); ?>"
                            class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600">Visi & Misi</a>
                        <a href="<?php echo e(route('profil.sejarah')); ?>"
                            class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600">Sejarah Desa</a>
                        <a href="<?php echo e(route('profil.struktur')); ?>"
                            class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600">Struktur
                            Organisasi</a>
                        <a href="<?php echo e(route('profil.peta')); ?>"
                            class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600">Peta Desa</a>
                        <a href="<?php echo e(route('profil.demografi')); ?>"
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
                        <a href="<?php echo e(route('infografis.penduduk')); ?>"
                            class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600">Data Penduduk</a>
                        <a href="<?php echo e(route('infografis.apbdes')); ?>"
                            class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600">APBDes</a>
                        <a href="<?php echo e(route('infografis.stunting')); ?>"
                            class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600">Stunting</a>
                        <a href="<?php echo e(route('infografis.bansos')); ?>"
                            class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600">Bantuan Sosial</a>
                        <a href="<?php echo e(route('infografis.idm')); ?>"
                            class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600">IDM</a>
                        <a href="<?php echo e(route('infografis.sdgs')); ?>"
                            class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600">SDGs Desa</a>
                    </div>
                </div>

                <a href="<?php echo e(route('berita.index')); ?>"
                    class="block px-4 py-2 text-gray-700 hover:bg-primary-50 hover:text-primary-600 rounded-lg">Berita</a>
                <a href="<?php echo e(route('belanja.index')); ?>"
                    class="block px-4 py-2 text-gray-700 hover:bg-primary-50 hover:text-primary-600 rounded-lg">Belanja</a>
                <a href="<?php echo e(route('wisata.index')); ?>"
                    class="block px-4 py-2 text-gray-700 hover:bg-primary-50 hover:text-primary-600 rounded-lg">Wisata</a>
                <a href="<?php echo e(route('galeri.index')); ?>"
                    class="block px-4 py-2 text-gray-700 hover:bg-primary-50 hover:text-primary-600 rounded-lg">Galeri</a>
                <a href="<?php echo e(route('ppid.index')); ?>"
                    class="block px-4 py-2 text-gray-700 hover:bg-primary-50 hover:text-primary-600 rounded-lg">PPID</a>
                <a href="<?php echo e(route('pengaduan.create')); ?>"
                    class="block px-4 py-2 text-white bg-primary-600 hover:bg-primary-700 rounded-lg text-center">
                    <i class="fas fa-headset mr-2"></i>Pengaduan
                </a>
            </div>
        </div>
    </nav>
</header>
<?php /**PATH C:\laragon\www\website-desa-tanalum\resources\views/partials/header.blade.php ENDPATH**/ ?>
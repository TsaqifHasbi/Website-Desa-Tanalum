<!-- Sidebar Backdrop for Mobile -->
<div x-show="sidebarOpen" x-cloak @click="sidebarOpen = false" class="fixed inset-0 z-40 bg-black bg-opacity-50 lg:hidden">
</div>

<!-- Sidebar -->
<aside :class="{ '-translate-x-full': !sidebarOpen }"
    class="fixed inset-y-0 left-0 z-50 w-64 bg-white border-r border-gray-200 transform transition-transform duration-200 ease-in-out lg:translate-x-0">

    <!-- Logo -->
    <div class="flex items-center justify-between h-16 px-4 border-b border-gray-200">
        <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-2">
            @php $logo = App\Models\Setting::getValue('site_logo'); @endphp
            @if ($logo)
                <img src="{{ Storage::url($logo) }}" alt="Logo" class="h-8 w-auto">
            @endif
            <span class="font-bold text-lg text-gray-800">Admin Panel</span>
        </a>
        <button @click="sidebarOpen = false" class="lg:hidden p-1 text-gray-500 hover:text-gray-700">
            <i class="fas fa-times"></i>
        </button>
    </div>

    <!-- Navigation -->
    <nav class="p-4 space-y-1 overflow-y-auto h-[calc(100vh-4rem)]">
        <!-- Dashboard -->
        <a href="{{ route('admin.dashboard') }}"
            class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-50' }}">
            <i class="fas fa-tachometer-alt w-5 mr-3"></i>
            Dashboard
        </a>

        <!-- Konten -->
        <div class="pt-4">
            <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Konten</p>
        </div>

        <a href="{{ route('admin.berita.index') }}"
            class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('admin.berita.*') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-50' }}">
            <i class="fas fa-newspaper w-5 mr-3"></i>
            Berita
        </a>

        <a href="{{ route('admin.galeri.index') }}"
            class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('admin.galeri.*') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-50' }}">
            <i class="fas fa-images w-5 mr-3"></i>
            Galeri
        </a>

        <a href="{{ route('admin.slider.index') }}"
            class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('admin.slider.*') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-50' }}">
            <i class="fas fa-sliders-h w-5 mr-3"></i>
            Slider
        </a>

        <!-- Desa -->
        <div class="pt-4">
            <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Desa</p>
        </div>

        <a href="{{ route('admin.profil.index') }}"
            class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('admin.profil.*') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-50' }}">
            <i class="fas fa-landmark w-5 mr-3"></i>
            Profil Desa
        </a>

        <a href="{{ route('admin.aparatur.index') }}"
            class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('admin.aparatur.*') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-50' }}">
            <i class="fas fa-users w-5 mr-3"></i>
            Aparatur Desa
        </a>

        <!-- Data Desa -->
        <div x-data="{ open: {{ request()->routeIs('admin.data.*') ? 'true' : 'false' }} }">
            <button @click="open = !open"
                class="w-full flex items-center justify-between px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-lg">
                <span class="flex items-center">
                    <i class="fas fa-database w-5 mr-3"></i>
                    Data Desa
                </span>
                <i class="fas fa-chevron-down text-xs transition-transform" :class="{ 'rotate-180': open }"></i>
            </button>
            <div x-show="open" x-cloak class="ml-8 mt-1 space-y-1">
                <a href="{{ route('admin.data.penduduk') }}"
                    class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600 rounded-lg {{ request()->routeIs('admin.data.penduduk') ? 'text-primary-600' : '' }}">Penduduk</a>
                <a href="{{ route('admin.data.dusun') }}"
                    class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600 rounded-lg {{ request()->routeIs('admin.data.dusun') ? 'text-primary-600' : '' }}">Dusun</a>
                <a href="{{ route('admin.data.apbdes') }}"
                    class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600 rounded-lg {{ request()->routeIs('admin.data.apbdes') ? 'text-primary-600' : '' }}">APBDes</a>
                <a href="{{ route('admin.data.bansos') }}"
                    class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600 rounded-lg {{ request()->routeIs('admin.data.bansos*') ? 'text-primary-600' : '' }}">Bansos</a>
                <a href="{{ route('admin.data.idm') }}"
                    class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600 rounded-lg {{ request()->routeIs('admin.data.idm') ? 'text-primary-600' : '' }}">IDM</a>
                <a href="{{ route('admin.data.sdgs') }}"
                    class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600 rounded-lg {{ request()->routeIs('admin.data.sdgs') ? 'text-primary-600' : '' }}">SDGs</a>
                <a href="{{ route('admin.data.stunting') }}"
                    class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600 rounded-lg {{ request()->routeIs('admin.data.stunting') ? 'text-primary-600' : '' }}">Stunting</a>
            </div>
        </div>

        <!-- Potensi & Wisata -->
        <div x-data="{ open: {{ request()->routeIs('admin.potensi.*') ? 'true' : 'false' }} }">
            <button @click="open = !open"
                class="w-full flex items-center justify-between px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-lg">
                <span class="flex items-center">
                    <i class="fas fa-mountain w-5 mr-3"></i>
                    Potensi & Wisata
                </span>
                <i class="fas fa-chevron-down text-xs transition-transform" :class="{ 'rotate-180': open }"></i>
            </button>
            <div x-show="open" x-cloak class="ml-8 mt-1 space-y-1">
                <a href="{{ route('admin.potensi.wisata') }}"
                    class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600 rounded-lg {{ request()->routeIs('admin.potensi.wisata*') ? 'text-primary-600' : '' }}">Wisata
                    Desa</a>
                <a href="{{ route('admin.potensi.index') }}"
                    class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600 rounded-lg {{ request()->routeIs('admin.potensi.index') || request()->routeIs('admin.potensi.create') || request()->routeIs('admin.potensi.edit') ? 'text-primary-600' : '' }}">Potensi
                    Desa</a>
                <a href="{{ route('admin.potensi.kategori') }}"
                    class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600 rounded-lg {{ request()->routeIs('admin.potensi.kategori') ? 'text-primary-600' : '' }}">Kategori
                    Potensi</a>
            </div>
        </div>

        <!-- UMKM -->
        <a href="{{ route('admin.produk.index') }}"
            class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('admin.produk.*') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-50' }}">
            <i class="fas fa-store w-5 mr-3"></i>
            Produk UMKM
        </a>

        <!-- PPID -->
        <div x-data="{ open: {{ request()->routeIs('admin.ppid.*') ? 'true' : 'false' }} }">
            <button @click="open = !open"
                class="w-full flex items-center justify-between px-4 py-2.5 text-sm font-medium text-gray-700 hover:bg-gray-50 rounded-lg">
                <span class="flex items-center">
                    <i class="fas fa-file-alt w-5 mr-3"></i>
                    PPID
                </span>
                <i class="fas fa-chevron-down text-xs transition-transform" :class="{ 'rotate-180': open }"></i>
            </button>
            <div x-show="open" x-cloak class="ml-8 mt-1 space-y-1">
                <a href="{{ route('admin.ppid.index') }}"
                    class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600 rounded-lg {{ request()->routeIs('admin.ppid.index') ? 'text-primary-600' : '' }}">Dokumen
                    PPID</a>
                <a href="{{ route('admin.ppid.kategori') }}"
                    class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600 rounded-lg {{ request()->routeIs('admin.ppid.kategori') ? 'text-primary-600' : '' }}">Kategori</a>
                <a href="{{ route('admin.ppid.permohonan') }}"
                    class="block px-4 py-2 text-sm text-gray-600 hover:text-primary-600 rounded-lg {{ request()->routeIs('admin.ppid.permohonan*') ? 'text-primary-600' : '' }}">Permohonan</a>
            </div>
        </div>

        <!-- Layanan -->
        <div class="pt-4">
            <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Layanan</p>
        </div>

        <a href="{{ route('admin.pengaduan.index') }}"
            class="flex items-center justify-between px-4 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('admin.pengaduan.*') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-50' }}">
            <span class="flex items-center">
                <i class="fas fa-headset w-5 mr-3"></i>
                Pengaduan
            </span>
            @php $pengaduanBaru = App\Models\Pengaduan::where('status', 'baru')->count(); @endphp
            @if ($pengaduanBaru > 0)
                <span class="bg-red-500 text-white text-xs px-2 py-0.5 rounded-full">{{ $pengaduanBaru }}</span>
            @endif
        </a>

        <!-- Pengaturan -->
        <div class="pt-4">
            <p class="px-4 text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Pengaturan</p>
        </div>

        @if (Auth::user()->isSuperAdmin())
            <a href="{{ route('admin.users.index') }}"
                class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('admin.users.*') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-50' }}">
                <i class="fas fa-user-cog w-5 mr-3"></i>
                Manajemen User
            </a>
        @endif

        <a href="{{ route('admin.settings.index') }}"
            class="flex items-center px-4 py-2.5 text-sm font-medium rounded-lg {{ request()->routeIs('admin.settings.*') ? 'bg-primary-50 text-primary-700' : 'text-gray-700 hover:bg-gray-50' }}">
            <i class="fas fa-cog w-5 mr-3"></i>
            Pengaturan Umum
        </a>
    </nav>
</aside>

<header class="sticky top-0 z-30 bg-white border-b border-gray-200">
    <div class="flex items-center justify-between h-16 px-4 lg:px-6">
        <!-- Left: Menu Button & Breadcrumb -->
        <div class="flex items-center">
            <button @click="sidebarOpen = true"
                class="lg:hidden p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg mr-2">
                <i class="fas fa-bars"></i>
            </button>

            <nav class="hidden md:flex items-center text-sm text-gray-500">
                <a href="{{ route('admin.dashboard') }}" class="hover:text-primary-600">Dashboard</a>
                @hasSection('breadcrumb')
                    <i class="fas fa-chevron-right mx-2 text-xs"></i>
                    @yield('breadcrumb')
                @endif
            </nav>
        </div>

        <!-- Right: User Menu -->
        <div class="flex items-center space-x-4">
            <!-- Visit Site -->
            <a href="{{ route('home') }}" target="_blank"
                class="hidden sm:flex items-center px-3 py-1.5 text-sm text-gray-600 hover:text-primary-600 hover:bg-gray-100 rounded-lg">
                <i class="fas fa-external-link-alt mr-2"></i>
                Lihat Website
            </a>

            <!-- Notifications -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open"
                    class="relative p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg">
                    <i class="fas fa-bell"></i>
                    @php
                        $notifCount =
                            App\Models\Pengaduan::where('status', 'baru')->count() +
                            App\Models\PermohonanInformasi::where('status', 'baru')->count();
                    @endphp
                    @if ($notifCount > 0)
                        <span
                            class="absolute top-0 right-0 w-4 h-4 bg-red-500 text-white text-xs rounded-full flex items-center justify-center">{{ $notifCount > 9 ? '9+' : $notifCount }}</span>
                    @endif
                </button>

                <div x-show="open" @click.away="open = false" x-cloak
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    class="absolute right-0 mt-2 w-80 bg-white rounded-lg shadow-lg border border-gray-100 py-2 z-50">
                    <div class="px-4 py-2 border-b border-gray-100">
                        <h3 class="font-semibold text-gray-800">Notifikasi</h3>
                    </div>
                    <div class="max-h-64 overflow-y-auto">
                        @php $pengaduanBaru = App\Models\Pengaduan::where('status', 'baru')->latest()->take(3)->get(); @endphp
                        @forelse($pengaduanBaru as $p)
                            <a href="{{ route('admin.pengaduan.show', $p) }}"
                                class="block px-4 py-3 hover:bg-gray-50 border-b border-gray-50">
                                <div class="flex items-start">
                                    <div class="w-8 h-8 bg-red-100 rounded-full flex items-center justify-center mr-3">
                                        <i class="fas fa-headset text-red-500 text-sm"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm font-medium text-gray-800 line-clamp-1">{{ $p->judul }}
                                        </p>
                                        <p class="text-xs text-gray-500">{{ $p->created_at->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </a>
                        @empty
                            <div class="px-4 py-6 text-center text-gray-500">
                                <i class="fas fa-bell-slash text-2xl mb-2"></i>
                                <p class="text-sm">Tidak ada notifikasi baru</p>
                            </div>
                        @endforelse
                    </div>
                    @if ($notifCount > 3)
                        <div class="px-4 py-2 border-t border-gray-100">
                            <a href="{{ route('admin.pengaduan.index') }}"
                                class="text-sm text-primary-600 hover:text-primary-700">Lihat semua</a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- User Dropdown -->
            <div x-data="{ open: false }" class="relative">
                <button @click="open = !open" class="flex items-center space-x-2 p-1.5 hover:bg-gray-100 rounded-lg">
                    @if (Auth::user()->avatar)
                        <img src="{{ Storage::url(Auth::user()->avatar) }}" alt="{{ Auth::user()->name }}"
                            class="w-8 h-8 rounded-full object-cover">
                    @else
                        <div class="w-8 h-8 bg-primary-100 rounded-full flex items-center justify-center">
                            <span
                                class="text-primary-700 font-semibold text-sm">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                        </div>
                    @endif
                    <span class="hidden md:block text-sm font-medium text-gray-700">{{ Auth::user()->name }}</span>
                    <i class="fas fa-chevron-down text-xs text-gray-400"></i>
                </button>

                <div x-show="open" @click.away="open = false" x-cloak
                    x-transition:enter="transition ease-out duration-100"
                    x-transition:enter-start="transform opacity-0 scale-95"
                    x-transition:enter-end="transform opacity-100 scale-100"
                    class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg border border-gray-100 py-2 z-50">
                    <div class="px-4 py-2 border-b border-gray-100">
                        <p class="text-sm font-medium text-gray-800">{{ Auth::user()->name }}</p>
                        <p class="text-xs text-gray-500">{{ Auth::user()->getRoleLabel() }}</p>
                    </div>
                    <a href="{{ route('admin.profile') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                        <i class="fas fa-user mr-2 w-4"></i>
                        Profil Saya
                    </a>
                    <a href="{{ route('admin.password') }}"
                        class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-50">
                        <i class="fas fa-key mr-2 w-4"></i>
                        Ganti Password
                    </a>
                    <div class="border-t border-gray-100 my-1"></div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-sm text-red-600 hover:bg-red-50">
                            <i class="fas fa-sign-out-alt mr-2 w-4"></i>
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

@extends('layouts.app')

@section('title', 'Listing')

@section('content')
    <!-- Header -->
    <section class="bg-gradient-to-r from-green-600 to-green-700 py-8">
        <div class="container mx-auto px-4">
            <h1 class="text-3xl md:text-4xl font-bold text-white">LISTING</h1>
            <p class="text-green-100">Daftar Informasi dan Data Desa Tanalum</p>
        </div>
    </section>

    <!-- Content -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <!-- Search & Filter -->
            <div class="bg-white rounded-xl shadow-sm p-6 mb-8">
                <form action="{{ route('listing.index') }}" method="GET" class="grid md:grid-cols-4 gap-4">
                    <div class="md:col-span-2">
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Cari artikel, berita, atau informasi..."
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                    </div>
                    <div>
                        <select name="kategori"
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                            <option value="">Semua Kategori</option>
                            <option value="berita" {{ request('kategori') == 'berita' ? 'selected' : '' }}>Berita</option>
                            <option value="pengumuman" {{ request('kategori') == 'pengumuman' ? 'selected' : '' }}>
                                Pengumuman</option>
                            <option value="kegiatan" {{ request('kategori') == 'kegiatan' ? 'selected' : '' }}>Kegiatan
                            </option>
                            <option value="pembangunan" {{ request('kategori') == 'pembangunan' ? 'selected' : '' }}>
                                Pembangunan</option>
                        </select>
                    </div>
                    <div>
                        <button type="submit"
                            class="w-full px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition">
                            <i class="fas fa-search mr-2"></i>
                            Cari
                        </button>
                    </div>
                </form>
            </div>

            <!-- Quick Links -->
            <div class="grid md:grid-cols-4 gap-4 mb-8">
                <a href="{{ route('listing.peta') }}"
                    class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition group">
                    <div
                        class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mb-4 group-hover:bg-green-200 transition">
                        <i class="fas fa-map text-green-600 text-xl"></i>
                    </div>
                    <h3 class="font-semibold text-gray-800">Peta Desa</h3>
                    <p class="text-sm text-gray-500 mt-1">Lihat peta interaktif desa</p>
                </a>

                <a href="{{ route('infografis.penduduk') }}"
                    class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition group">
                    <div
                        class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mb-4 group-hover:bg-blue-200 transition">
                        <i class="fas fa-users text-blue-600 text-xl"></i>
                    </div>
                    <h3 class="font-semibold text-gray-800">Data Penduduk</h3>
                    <p class="text-sm text-gray-500 mt-1">Statistik kependudukan</p>
                </a>

                <a href="{{ route('infografis.apbdes') }}"
                    class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition group">
                    <div
                        class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mb-4 group-hover:bg-yellow-200 transition">
                        <i class="fas fa-money-bill-wave text-yellow-600 text-xl"></i>
                    </div>
                    <h3 class="font-semibold text-gray-800">APBDes</h3>
                    <p class="text-sm text-gray-500 mt-1">Anggaran desa</p>
                </a>

                <a href="{{ route('ppid.index') }}"
                    class="bg-white rounded-xl shadow-sm p-6 hover:shadow-md transition group">
                    <div
                        class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center mb-4 group-hover:bg-purple-200 transition">
                        <i class="fas fa-file-alt text-purple-600 text-xl"></i>
                    </div>
                    <h3 class="font-semibold text-gray-800">PPID</h3>
                    <p class="text-sm text-gray-500 mt-1">Dokumen publik</p>
                </a>
            </div>

            <!-- Results -->
            <div class="bg-white rounded-xl shadow-sm">
                <div class="p-6 border-b">
                    <h2 class="font-semibold text-gray-800">
                        @if (request('search'))
                            Hasil pencarian untuk "{{ request('search') }}"
                        @else
                            Semua Informasi
                        @endif
                        <span class="text-gray-500 font-normal">({{ $items->total() ?? 0 }} item)</span>
                    </h2>
                </div>

                <div class="divide-y">
                    @forelse($items ?? [] as $item)
                        <div class="p-6 hover:bg-gray-50 transition">
                            <div class="flex gap-4">
                                @if ($item->gambar)
                                    <div class="w-24 h-24 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
                                        <img src="{{ Storage::url($item->gambar) }}" alt="{{ $item->judul }}"
                                            class="w-full h-full object-cover">
                                    </div>
                                @endif
                                <div class="flex-1">
                                    <div class="flex items-center gap-2 mb-2">
                                        <span
                                            class="px-2 py-1 bg-green-100 text-green-700 text-xs font-medium rounded">{{ ucfirst($item->kategori ?? 'Berita') }}</span>
                                        <span class="text-sm text-gray-500">{{ $item->created_at->format('d M Y') }}</span>
                                    </div>
                                    <h3 class="font-semibold text-gray-800 mb-2 hover:text-green-600">
                                        <a href="{{ route('berita.show', $item->slug) }}">{{ $item->judul }}</a>
                                    </h3>
                                    <p class="text-gray-600 text-sm line-clamp-2">
                                        {{ Str::limit(strip_tags($item->konten), 150) }}</p>
                                </div>
                            </div>
                        </div>
                    @empty
                        <!-- Sample Data -->
                        @foreach ([['judul' => 'Kegiatan Gotong Royong Warga RT.002 Desa Tanalum', 'kategori' => 'Kegiatan', 'tanggal' => '18 Dec 2025'], ['judul' => 'Pelatihan Tata Kelola Bisnis dan Pemasaran Destinasi Wisata', 'kategori' => 'Pembangunan', 'tanggal' => '23 Oct 2025'], ['judul' => 'Pendampingan Desa Wisata: Perancangan Paket Wisata', 'kategori' => 'Berita', 'tanggal' => '23 Sep 2025'], ['judul' => 'Gerakan Bersih Pantai Di Desa Tanalum', 'kategori' => 'Kegiatan', 'tanggal' => '26 Oct 2025']] as $sample)
                            <div class="p-6 hover:bg-gray-50 transition">
                                <div class="flex gap-4">
                                    <div
                                        class="w-24 h-24 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0 flex items-center justify-center">
                                        <i class="fas fa-newspaper text-3xl text-gray-300"></i>
                                    </div>
                                    <div class="flex-1">
                                        <div class="flex items-center gap-2 mb-2">
                                            <span
                                                class="px-2 py-1 bg-green-100 text-green-700 text-xs font-medium rounded">{{ $sample['kategori'] }}</span>
                                            <span class="text-sm text-gray-500">{{ $sample['tanggal'] }}</span>
                                        </div>
                                        <h3 class="font-semibold text-gray-800 mb-2 hover:text-green-600">
                                            <a href="#">{{ $sample['judul'] }}</a>
                                        </h3>
                                        <p class="text-gray-600 text-sm line-clamp-2">Lorem ipsum dolor sit amet,
                                            consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et
                                            dolore magna aliqua.</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforelse
                </div>

                @if (isset($items) && $items->hasPages())
                    <div class="p-6 border-t">
                        {{ $items->withQueryString()->links() }}
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection

@extends('layouts.admin')

@section('title', 'Pengaturan Website')

@section('content')
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Pengaturan Website</h1>
        <p class="text-gray-600">Kelola pengaturan umum website desa</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
        <!-- Sidebar Menu -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="p-4 border-b border-gray-200">
                    <h3 class="font-semibold text-gray-700">Menu Pengaturan</h3>
                </div>
                <nav class="p-2">
                    <a href="#umum"
                        class="flex items-center px-4 py-3 text-sm font-medium text-green-600 bg-green-50 rounded-lg mb-1">
                        <i class="fas fa-cog w-5 text-center mr-3"></i>
                        Pengaturan Umum
                    </a>
                    <a href="#profil"
                        class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-lg mb-1">
                        <i class="fas fa-building w-5 text-center mr-3"></i>
                        Profil Desa
                    </a>
                    <a href="#kontak"
                        class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-lg mb-1">
                        <i class="fas fa-phone w-5 text-center mr-3"></i>
                        Kontak & Sosmed
                    </a>
                    <a href="#seo"
                        class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-lg mb-1">
                        <i class="fas fa-search w-5 text-center mr-3"></i>
                        SEO & Meta
                    </a>
                    <a href="#backup"
                        class="flex items-center px-4 py-3 text-sm font-medium text-gray-600 hover:bg-gray-50 rounded-lg">
                        <i class="fas fa-database w-5 text-center mr-3"></i>
                        Backup Data
                    </a>
                </nav>
            </div>
        </div>

        <!-- Main Content -->
        <div class="lg:col-span-3 space-y-6">
            @if (session('success'))
                <div class="p-4 bg-green-50 border border-green-200 rounded-lg">
                    <div class="flex items-center">
                        <i class="fas fa-check-circle text-green-500 mr-3"></i>
                        <p class="text-green-700">{{ session('success') }}</p>
                    </div>
                </div>
            @endif

            <!-- Pengaturan Umum -->
            <div id="umum" class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800">
                        <i class="fas fa-cog text-green-600 mr-2"></i>
                        Pengaturan Umum
                    </h2>
                </div>
                <form action="{{ route('admin.setting.update') }}" method="POST" enctype="multipart/form-data"
                    class="p-6">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="section" value="umum">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Website</label>
                            <input type="text" name="nama_website"
                                value="{{ $settings['nama_website'] ?? 'Website Desa Tanalum' }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Tagline</label>
                            <input type="text" name="tagline"
                                value="{{ $settings['tagline'] ?? 'Desa Maju, Mandiri, Sejahtera' }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Logo</label>
                            <div class="flex items-center gap-4">
                                @if ($settings['logo'] ?? false)
                                    <img src="{{ Storage::url($settings['logo']) }}" alt="Logo"
                                        class="h-16 w-16 object-contain bg-gray-100 rounded-lg">
                                @endif
                                <input type="file" name="logo" accept="image/*"
                                    class="flex-1 text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Favicon</label>
                            <div class="flex items-center gap-4">
                                @if ($settings['favicon'] ?? false)
                                    <img src="{{ Storage::url($settings['favicon']) }}" alt="Favicon"
                                        class="h-8 w-8 object-contain bg-gray-100 rounded">
                                @endif
                                <input type="file" name="favicon" accept="image/*"
                                    class="flex-1 text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-green-50 file:text-green-700 hover:file:bg-green-100">
                            </div>
                        </div>
                    </div>

                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Website</label>
                        <textarea name="deskripsi" rows="3"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">{{ $settings['deskripsi'] ?? '' }}</textarea>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                            <i class="fas fa-save mr-2"></i>
                            Simpan Pengaturan
                        </button>
                    </div>
                </form>
            </div>

            <!-- Profil Desa -->
            <div id="profil" class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800">
                        <i class="fas fa-building text-green-600 mr-2"></i>
                        Profil Desa
                    </h2>
                </div>
                <form action="{{ route('admin.setting.update') }}" method="POST" class="p-6">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="section" value="profil">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Nama Desa</label>
                            <input type="text" name="nama_desa" value="{{ $profilDesa->nama ?? 'Tanalum' }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kode Desa</label>
                            <input type="text" name="kode_desa" value="{{ $profilDesa->kode_desa ?? '' }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kecamatan</label>
                            <input type="text" name="kecamatan" value="{{ $profilDesa->kecamatan ?? 'Marang Kayu' }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kabupaten/Kota</label>
                            <input type="text" name="kabupaten"
                                value="{{ $profilDesa->kabupaten ?? 'Kutai Kartanegara' }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Provinsi</label>
                            <input type="text" name="provinsi"
                                value="{{ $profilDesa->provinsi ?? 'Kalimantan Timur' }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kode Pos</label>
                            <input type="text" name="kode_pos" value="{{ $profilDesa->kode_pos ?? '75355' }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                        </div>
                    </div>

                    <div class="mt-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap</label>
                        <textarea name="alamat" rows="2"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">{{ $profilDesa->alamat ?? '' }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Latitude</label>
                            <input type="text" name="latitude" value="{{ $profilDesa->latitude ?? '' }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Longitude</label>
                            <input type="text" name="longitude" value="{{ $profilDesa->longitude ?? '' }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                            <i class="fas fa-save mr-2"></i>
                            Simpan Profil
                        </button>
                    </div>
                </form>
            </div>

            <!-- Kontak & Sosmed -->
            <div id="kontak" class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800">
                        <i class="fas fa-phone text-green-600 mr-2"></i>
                        Kontak & Media Sosial
                    </h2>
                </div>
                <form action="{{ route('admin.setting.update') }}" method="POST" class="p-6">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="section" value="kontak">

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-phone text-gray-400 mr-2"></i>Telepon
                            </label>
                            <input type="text" name="telepon" value="{{ $profilDesa->telepon ?? '' }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fab fa-whatsapp text-green-500 mr-2"></i>WhatsApp
                            </label>
                            <input type="text" name="whatsapp" value="{{ $profilDesa->whatsapp ?? '' }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-envelope text-red-500 mr-2"></i>Email
                            </label>
                            <input type="email" name="email" value="{{ $profilDesa->email ?? '' }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fas fa-globe text-blue-500 mr-2"></i>Website
                            </label>
                            <input type="url" name="website" value="{{ $profilDesa->website ?? '' }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                        </div>
                    </div>

                    <hr class="my-6">

                    <h3 class="font-medium text-gray-700 mb-4">Media Sosial</h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fab fa-facebook text-blue-600 mr-2"></i>Facebook
                            </label>
                            <input type="url" name="facebook" value="{{ $profilDesa->facebook ?? '' }}"
                                placeholder="https://facebook.com/..."
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fab fa-instagram text-pink-500 mr-2"></i>Instagram
                            </label>
                            <input type="url" name="instagram" value="{{ $profilDesa->instagram ?? '' }}"
                                placeholder="https://instagram.com/..."
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fab fa-youtube text-red-600 mr-2"></i>YouTube
                            </label>
                            <input type="url" name="youtube" value="{{ $profilDesa->youtube ?? '' }}"
                                placeholder="https://youtube.com/..."
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                <i class="fab fa-twitter text-sky-500 mr-2"></i>Twitter
                            </label>
                            <input type="url" name="twitter" value="{{ $profilDesa->twitter ?? '' }}"
                                placeholder="https://twitter.com/..."
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                        </div>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                            <i class="fas fa-save mr-2"></i>
                            Simpan Kontak
                        </button>
                    </div>
                </form>
            </div>

            <!-- Backup -->
            <div id="backup" class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-lg font-semibold text-gray-800">
                        <i class="fas fa-database text-green-600 mr-2"></i>
                        Backup & Restore Data
                    </h2>
                </div>
                <div class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="bg-blue-50 rounded-xl p-6">
                            <div class="flex items-center mb-4">
                                <div class="bg-blue-500 rounded-full p-3 mr-4">
                                    <i class="fas fa-download text-white text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800">Backup Database</h3>
                                    <p class="text-sm text-gray-600">Download semua data website</p>
                                </div>
                            </div>
                            <button type="button"
                                class="w-full px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                                <i class="fas fa-download mr-2"></i>
                                Download Backup
                            </button>
                        </div>

                        <div class="bg-orange-50 rounded-xl p-6">
                            <div class="flex items-center mb-4">
                                <div class="bg-orange-500 rounded-full p-3 mr-4">
                                    <i class="fas fa-upload text-white text-xl"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800">Restore Database</h3>
                                    <p class="text-sm text-gray-600">Upload file backup</p>
                                </div>
                            </div>
                            <input type="file"
                                class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-medium file:bg-orange-100 file:text-orange-700 hover:file:bg-orange-200">
                        </div>
                    </div>

                    <div class="mt-6 p-4 bg-yellow-50 border border-yellow-200 rounded-lg">
                        <div class="flex items-start">
                            <i class="fas fa-exclamation-triangle text-yellow-500 mr-3 mt-0.5"></i>
                            <div>
                                <p class="text-sm text-yellow-700 font-medium">Perhatian!</p>
                                <p class="text-sm text-yellow-600">Pastikan untuk melakukan backup secara berkala. Restore
                                    data akan menimpa semua data yang ada saat ini.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

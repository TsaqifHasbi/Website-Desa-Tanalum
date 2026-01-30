@extends('layouts.public')

@section('title', 'Kontak Kami - Desa Tanalum')

@section('content')
    <!-- Hero Section -->
    <section class="bg-gradient-to-r from-green-600 to-green-800 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center">
                <h1 class="text-3xl md:text-4xl font-bold mb-4">Hubungi Kami</h1>
                <p class="text-lg text-green-100">Kami siap melayani pertanyaan dan kebutuhan Anda</p>
            </div>
        </div>
    </section>

    <!-- Contact Content -->
    <section class="py-12 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                <!-- Contact Info Cards -->
                <div class="lg:col-span-1 space-y-6">
                    <!-- Address -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <div class="flex items-start">
                            <div class="bg-green-100 rounded-full p-3 mr-4">
                                <i class="fas fa-map-marker-alt text-green-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800 mb-2">Alamat Kantor Desa</h3>
                                <p class="text-gray-600 text-sm">
                                    {{ $profilDesa->alamat ?? 'Jl. Poros Desa Tanalum' }}<br>
                                    Kecamatan Marang Kayu<br>
                                    Kabupaten Kutai Kartanegara<br>
                                    Kalimantan Timur, 75355
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <div class="flex items-start">
                            <div class="bg-blue-100 rounded-full p-3 mr-4">
                                <i class="fas fa-phone text-blue-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800 mb-2">Telepon</h3>
                                <p class="text-gray-600 text-sm">
                                    <a href="tel:+62541123456" class="hover:text-green-600">
                                        {{ $profilDesa->telepon ?? '(0541) 123-456' }}
                                    </a>
                                </p>
                                <p class="text-gray-500 text-xs mt-1">Senin - Jumat, 08:00 - 16:00 WITA</p>
                            </div>
                        </div>
                    </div>

                    <!-- WhatsApp -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <div class="flex items-start">
                            <div class="bg-green-100 rounded-full p-3 mr-4">
                                <i class="fab fa-whatsapp text-green-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800 mb-2">WhatsApp</h3>
                                <p class="text-gray-600 text-sm">
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $profilDesa->whatsapp ?? '081234567890') }}"
                                        target="_blank" class="hover:text-green-600">
                                        {{ $profilDesa->whatsapp ?? '0812-3456-7890' }}
                                    </a>
                                </p>
                                <p class="text-gray-500 text-xs mt-1">Respon cepat via WhatsApp</p>
                            </div>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <div class="flex items-start">
                            <div class="bg-red-100 rounded-full p-3 mr-4">
                                <i class="fas fa-envelope text-red-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-semibold text-gray-800 mb-2">Email</h3>
                                <p class="text-gray-600 text-sm">
                                    <a href="mailto:{{ $profilDesa->email ?? 'desa.tanalum@gmail.com' }}"
                                        class="hover:text-green-600">
                                        {{ $profilDesa->email ?? 'desa.tanalum@gmail.com' }}
                                    </a>
                                </p>
                                <p class="text-gray-500 text-xs mt-1">Kirim pertanyaan via email</p>
                            </div>
                        </div>
                    </div>

                    <!-- Social Media -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h3 class="font-semibold text-gray-800 mb-4">Media Sosial</h3>
                        <div class="flex space-x-3">
                            <a href="{{ $profilDesa->facebook ?? '#' }}" target="_blank"
                                class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="{{ $profilDesa->instagram ?? '#' }}" target="_blank"
                                class="w-10 h-10 bg-gradient-to-br from-purple-600 to-pink-500 text-white rounded-full flex items-center justify-center hover:opacity-90 transition-opacity">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="{{ $profilDesa->youtube ?? '#' }}" target="_blank"
                                class="w-10 h-10 bg-red-600 text-white rounded-full flex items-center justify-center hover:bg-red-700 transition-colors">
                                <i class="fab fa-youtube"></i>
                            </a>
                            <a href="{{ $profilDesa->twitter ?? '#' }}" target="_blank"
                                class="w-10 h-10 bg-sky-500 text-white rounded-full flex items-center justify-center hover:bg-sky-600 transition-colors">
                                <i class="fab fa-twitter"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-md p-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-6">Kirim Pesan</h2>

                        @if (session('success'))
                            <div class="mb-6 p-4 bg-green-50 border border-green-200 rounded-lg">
                                <div class="flex items-center">
                                    <i class="fas fa-check-circle text-green-500 mr-3"></i>
                                    <p class="text-green-700">{{ session('success') }}</p>
                                </div>
                            </div>
                        @endif

                        <form action="{{ route('kontak.submit') }}" method="POST" class="space-y-6">
                            @csrf

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-2">
                                        Nama Lengkap <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" name="nama" id="nama" required
                                        value="{{ old('nama') }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 @error('nama') border-red-500 @enderror"
                                        placeholder="Masukkan nama lengkap">
                                    @error('nama')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">
                                        Email <span class="text-red-500">*</span>
                                    </label>
                                    <input type="email" name="email" id="email" required
                                        value="{{ old('email') }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 @error('email') border-red-500 @enderror"
                                        placeholder="Masukkan email">
                                    @error('email')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label for="telepon" class="block text-sm font-medium text-gray-700 mb-2">
                                        Nomor Telepon
                                    </label>
                                    <input type="tel" name="telepon" id="telepon" value="{{ old('telepon') }}"
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500"
                                        placeholder="08xxxxxxxxxx">
                                </div>

                                <div>
                                    <label for="subjek" class="block text-sm font-medium text-gray-700 mb-2">
                                        Subjek <span class="text-red-500">*</span>
                                    </label>
                                    <select name="subjek" id="subjek" required
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 @error('subjek') border-red-500 @enderror">
                                        <option value="">Pilih subjek</option>
                                        <option value="Pertanyaan Umum"
                                            {{ old('subjek') == 'Pertanyaan Umum' ? 'selected' : '' }}>Pertanyaan Umum
                                        </option>
                                        <option value="Pelayanan Administrasi"
                                            {{ old('subjek') == 'Pelayanan Administrasi' ? 'selected' : '' }}>Pelayanan
                                            Administrasi</option>
                                        <option value="Informasi Desa"
                                            {{ old('subjek') == 'Informasi Desa' ? 'selected' : '' }}>Informasi Desa
                                        </option>
                                        <option value="Kerjasama" {{ old('subjek') == 'Kerjasama' ? 'selected' : '' }}>
                                            Kerjasama</option>
                                        <option value="Saran & Kritik"
                                            {{ old('subjek') == 'Saran & Kritik' ? 'selected' : '' }}>Saran & Kritik
                                        </option>
                                        <option value="Lainnya" {{ old('subjek') == 'Lainnya' ? 'selected' : '' }}>Lainnya
                                        </option>
                                    </select>
                                    @error('subjek')
                                        <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label for="pesan" class="block text-sm font-medium text-gray-700 mb-2">
                                    Pesan <span class="text-red-500">*</span>
                                </label>
                                <textarea name="pesan" id="pesan" rows="6" required
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500 @error('pesan') border-red-500 @enderror"
                                    placeholder="Tulis pesan Anda...">{{ old('pesan') }}</textarea>
                                @error('pesan')
                                    <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <button type="submit"
                                    class="w-full md:w-auto px-8 py-4 bg-green-600 text-white rounded-lg font-semibold hover:bg-green-700 transition-colors flex items-center justify-center">
                                    <i class="fas fa-paper-plane mr-2"></i>
                                    Kirim Pesan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Map -->
            <div class="mt-12 bg-white rounded-xl shadow-md overflow-hidden">
                <div class="p-6 border-b border-gray-200">
                    <h2 class="text-xl font-bold text-gray-800">Lokasi Kantor Desa</h2>
                </div>
                <div class="h-96">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d127505.24870839887!2d117.0432!3d-0.4732!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2df67f7e6b8a69e7%3A0x1234567890abcdef!2sDesa%20Tanalum!5e0!3m2!1sid!2sid!4v1234567890123"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

            <!-- Operating Hours -->
            <div class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Office Hours -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">
                        <i class="fas fa-clock text-green-600 mr-2"></i>
                        Jam Pelayanan
                    </h3>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-3 border-b border-gray-100">
                            <span class="text-gray-600">Senin - Kamis</span>
                            <span class="font-medium text-gray-800">08:00 - 16:00 WITA</span>
                        </div>
                        <div class="flex justify-between items-center py-3 border-b border-gray-100">
                            <span class="text-gray-600">Jumat</span>
                            <span class="font-medium text-gray-800">08:00 - 11:30 WITA</span>
                        </div>
                        <div class="flex justify-between items-center py-3">
                            <span class="text-gray-600">Sabtu - Minggu</span>
                            <span class="font-medium text-red-500">Libur</span>
                        </div>
                    </div>
                    <p class="text-sm text-gray-500 mt-4">
                        <i class="fas fa-info-circle mr-1"></i>
                        Pelayanan dilakukan di Kantor Desa Tanalum
                    </p>
                </div>

                <!-- FAQ Quick Links -->
                <div class="bg-white rounded-xl shadow-md p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">
                        <i class="fas fa-question-circle text-green-600 mr-2"></i>
                        Pertanyaan Umum
                    </h3>
                    <div class="space-y-3">
                        <a href="#" class="block p-3 bg-gray-50 rounded-lg hover:bg-green-50 transition-colors">
                            <span class="text-gray-700">Bagaimana cara mengurus surat pengantar?</span>
                        </a>
                        <a href="#" class="block p-3 bg-gray-50 rounded-lg hover:bg-green-50 transition-colors">
                            <span class="text-gray-700">Apa saja persyaratan membuat KTP?</span>
                        </a>
                        <a href="#" class="block p-3 bg-gray-50 rounded-lg hover:bg-green-50 transition-colors">
                            <span class="text-gray-700">Bagaimana cara mengajukan bantuan sosial?</span>
                        </a>
                        <a href="#" class="block p-3 bg-gray-50 rounded-lg hover:bg-green-50 transition-colors">
                            <span class="text-gray-700">Dimana lokasi kantor desa?</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

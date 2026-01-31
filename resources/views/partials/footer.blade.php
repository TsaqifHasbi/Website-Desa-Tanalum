<footer class="bg-gray-900 text-white">
    <!-- Main Footer -->
    <div class="container mx-auto px-6 md:px-12 lg:px-32 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- About -->
            <div>
                <div class="flex items-center space-x-3 mb-4">
                    @php $logo = App\Models\Setting::getValue('site_logo', 'slider/logo-tanalum.png'); @endphp
                    @if ($logo && Storage::disk('public')->exists($logo))
                        <img src="{{ Storage::url($logo) }}" alt="Logo" class="h-12 w-auto">
                    @else
                        <div class="w-12 h-12 bg-primary-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-landmark text-white text-lg"></i>
                        </div>
                    @endif
                    <div>
                        <h3 class="font-bold text-lg">{{ $profil->nama_desa ?? 'Desa Tanalum' }}</h3>
                        <p class="text-sm text-gray-400">{{ $profil->kecamatan ?? 'Kec. Marang Kayu' }}</p>
                    </div>
                </div>
                <p class="text-gray-400 text-sm leading-relaxed">
                    {{ App\Models\Setting::getValue('site_description', 'Website Resmi Pemerintah Desa Tanalum, Kecamatan Marang Kayu, Kabupaten Kutai Kartanegara, Provinsi Kalimantan Timur.') }}
                </p>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="font-semibold text-lg mb-4">Tautan Cepat</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="{{ route('profil.index') }}" class="text-gray-400 hover:text-white transition">Profil
                            Desa</a></li>
                    <li><a href="{{ route('berita.index') }}" class="text-gray-400 hover:text-white transition">Berita
                            Desa</a></li>
                    <li><a href="{{ route('infografis.apbdes') }}"
                            class="text-gray-400 hover:text-white transition">APBDes</a></li>
                    <li><a href="{{ route('ppid.index') }}" class="text-gray-400 hover:text-white transition">PPID</a>
                    </li>
                    <li><a href="{{ route('belanja.index') }}" class="text-gray-400 hover:text-white transition">Produk
                            UMKM</a></li>
                    <li><a href="{{ route('wisata.index') }}" class="text-gray-400 hover:text-white transition">Wisata
                            Desa</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h4 class="font-semibold text-lg mb-4">Kontak Kami</h4>
                <ul class="space-y-3 text-sm">
                    <li class="flex items-start">
                        <i class="fas fa-map-marker-alt mt-1 mr-3 text-primary-500"></i>
                        <span
                            class="text-gray-400">{{ App\Models\Setting::getValue('contact_address', $profil->alamat_kantor ?? 'Jl. Desa Tanalum, Kec. Marang Kayu, Kab. Kutai Kartanegara') }}</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-phone mr-3 text-primary-500"></i>
                        <a href="tel:{{ App\Models\Setting::getValue('contact_phone', $profil->telepon ?? '0541-123456') }}"
                            class="text-gray-400 hover:text-white transition">
                            {{ App\Models\Setting::getValue('contact_phone', $profil->telepon ?? '0541-123456') }}
                        </a>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-envelope mr-3 text-primary-500"></i>
                        <a href="mailto:{{ App\Models\Setting::getValue('contact_email', $profil->email ?? 'desa@tanalum.desa.id') }}"
                            class="text-gray-400 hover:text-white transition">
                            {{ App\Models\Setting::getValue('contact_email', $profil->email ?? 'desa@tanalum.desa.id') }}
                        </a>
                    </li>
                    @php $whatsapp = App\Models\Setting::getValue('contact_whatsapp'); @endphp
                    @if ($whatsapp)
                        <li class="flex items-center">
                            <i class="fab fa-whatsapp mr-3 text-primary-500"></i>
                            <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $whatsapp) }}" target="_blank"
                                class="text-gray-400 hover:text-white transition">
                                {{ $whatsapp }}
                            </a>
                        </li>
                    @endif
                </ul>
            </div>

            <!-- Social Media -->
            <div>
                <h4 class="font-semibold text-lg mb-4">Media Sosial</h4>
                <div class="flex space-x-3 mb-6">
                    @php
                        $facebook = App\Models\Setting::getValue('social_facebook');
                        $instagram = App\Models\Setting::getValue('social_instagram');
                        $youtube = App\Models\Setting::getValue('social_youtube');
                        $twitter = App\Models\Setting::getValue('social_twitter');
                        $tiktok = App\Models\Setting::getValue('social_tiktok');
                    @endphp
                    @if ($facebook)
                        <a href="{{ $facebook }}" target="_blank"
                            class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center text-gray-400 hover:bg-primary-600 hover:text-white transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    @endif
                    @if ($instagram)
                        <a href="{{ $instagram }}" target="_blank"
                            class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center text-gray-400 hover:bg-primary-600 hover:text-white transition">
                            <i class="fab fa-instagram"></i>
                        </a>
                    @endif
                    @if ($youtube)
                        <a href="{{ $youtube }}" target="_blank"
                            class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center text-gray-400 hover:bg-primary-600 hover:text-white transition">
                            <i class="fab fa-youtube"></i>
                        </a>
                    @endif
                    @if ($twitter)
                        <a href="{{ $twitter }}" target="_blank"
                            class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center text-gray-400 hover:bg-primary-600 hover:text-white transition">
                            <i class="fab fa-twitter"></i>
                        </a>
                    @endif
                    @if ($tiktok)
                        <a href="{{ $tiktok }}" target="_blank"
                            class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center text-gray-400 hover:bg-primary-600 hover:text-white transition">
                            <i class="fab fa-tiktok"></i>
                        </a>
                    @endif
                </div>

                <!-- Maps -->
                @php $mapsEmbed = App\Models\Setting::getValue('maps_embed'); @endphp
                @if ($mapsEmbed)
                    <div class="aspect-video rounded-lg overflow-hidden">
                        {!! $mapsEmbed !!}
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Bottom Footer -->
    <div class="border-t border-gray-800">
        <div class="container mx-auto px-6 md:px-12 lg:px-28 py-4">
            <div class="flex flex-col md:flex-row items-center justify-between text-sm text-gray-400">
                <p>© {{ date('Y') }} Desa Tanalum. All rights reserved.</p>
                <p class="mt-2 md:mt-0">
                    {{ App\Models\Setting::getValue('footer_text', 'Dibangun dengan ❤️ untuk Desa Tanalum') }}</p>
            </div>
        </div>
    </div>
</footer>

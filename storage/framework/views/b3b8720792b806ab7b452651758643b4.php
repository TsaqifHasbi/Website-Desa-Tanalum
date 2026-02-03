<footer class="bg-gray-900 text-white">
    <!-- Main Footer -->
    <div class="container mx-auto px-6 md:px-12 lg:px-32 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- About -->
            <div>
                <div class="flex items-center space-x-3 mb-4">
                    <?php $logo = App\Models\Setting::getValue('site_logo', 'slider/logo-tanalum.png'); ?>
                    <?php if($logo && Storage::disk('public')->exists($logo)): ?>
                        <img src="<?php echo e(Storage::url($logo)); ?>" alt="Logo" class="h-12 w-auto">
                    <?php else: ?>
                        <div class="w-12 h-12 bg-primary-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-landmark text-white text-lg"></i>
                        </div>
                    <?php endif; ?>
                    <div>
                        <h3 class="font-bold text-lg"><?php echo e($profil->nama_desa ?? 'Desa Tanalum'); ?></h3>
                        <p class="text-sm text-gray-400"><?php echo e($profil->kecamatan ?? 'Kec. Marang Kayu'); ?></p>
                    </div>
                </div>
                <p class="text-gray-400 text-sm leading-relaxed">
                    <?php echo e(App\Models\Setting::getValue('site_description', 'Website Resmi Pemerintah Desa Tanalum, Kecamatan Marang Kayu, Kabupaten Kutai Kartanegara, Provinsi Kalimantan Timur.')); ?>

                </p>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="font-semibold text-lg mb-4">Tautan Cepat</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="<?php echo e(route('profil.index')); ?>" class="text-gray-400 hover:text-white transition">Profil
                            Desa</a></li>
                    <li><a href="<?php echo e(route('berita.index')); ?>" class="text-gray-400 hover:text-white transition">Berita
                            Desa</a></li>
                    <li><a href="<?php echo e(route('infografis.apbdes')); ?>"
                            class="text-gray-400 hover:text-white transition">APBDes</a></li>
                    <li><a href="<?php echo e(route('ppid.index')); ?>" class="text-gray-400 hover:text-white transition">PPID</a>
                    </li>
                    <li><a href="<?php echo e(route('belanja.index')); ?>" class="text-gray-400 hover:text-white transition">Produk
                            UMKM</a></li>
                    <li><a href="<?php echo e(route('wisata.index')); ?>" class="text-gray-400 hover:text-white transition">Wisata
                            Desa</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h4 class="font-semibold text-lg mb-4">Kontak Kami</h4>
                <ul class="space-y-3 text-sm">
                    <?php if($profil?->alamat_kantor || App\Models\Setting::getValue('contact_address')): ?>
                        <li class="flex items-start">
                            <i class="fas fa-map-marker-alt mt-1 mr-3 text-primary-500"></i>
                            <span
                                class="text-gray-400"><?php echo e($profil?->alamat_kantor ?? App\Models\Setting::getValue('contact_address', 'Alamat belum diatur')); ?></span>
                        </li>
                    <?php endif; ?>
                    <?php if($profil?->telepon || App\Models\Setting::getValue('contact_phone')): ?>
                        <li class="flex items-center">
                            <i class="fas fa-phone mr-3 text-primary-500"></i>
                            <?php $telepon = $profil?->telepon ?? App\Models\Setting::getValue('contact_phone'); ?>
                            <a href="tel:<?php echo e($telepon); ?>" class="text-gray-400 hover:text-white transition">
                                <?php echo e($telepon); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                    <?php if($profil?->email || App\Models\Setting::getValue('contact_email')): ?>
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-3 text-primary-500"></i>
                            <?php $email = $profil?->email ?? App\Models\Setting::getValue('contact_email'); ?>
                            <a href="mailto:<?php echo e($email); ?>" class="text-gray-400 hover:text-white transition">
                                <?php echo e($email); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                    <?php $whatsapp = $profil?->sosial_media['whatsapp'] ?? App\Models\Setting::getValue('contact_whatsapp'); ?>
                    <?php if($whatsapp): ?>
                        <li class="flex items-center">
                            <i class="fab fa-whatsapp mr-3 text-primary-500"></i>
                            <a href="https://wa.me/<?php echo e(preg_replace('/[^0-9]/', '', $whatsapp)); ?>" target="_blank"
                                class="text-gray-400 hover:text-white transition">
                                <?php echo e($whatsapp); ?>

                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>

            <!-- Social Media -->
            <div>
                <h4 class="font-semibold text-lg mb-4">Media Sosial</h4>
                <div class="flex space-x-3 mb-6">
                    <?php
                        $sosmed = $profil?->sosial_media ?? [];
                        $facebook = $sosmed['facebook'] ?? App\Models\Setting::getValue('social_facebook');
                        $instagram = $sosmed['instagram'] ?? App\Models\Setting::getValue('social_instagram');
                        $youtube = $sosmed['youtube'] ?? App\Models\Setting::getValue('social_youtube');
                        $twitter = $sosmed['twitter'] ?? App\Models\Setting::getValue('social_twitter');
                        $tiktok = $sosmed['tiktok'] ?? App\Models\Setting::getValue('social_tiktok');
                    ?>
                    <?php if($facebook): ?>
                        <a href="<?php echo e($facebook); ?>" target="_blank"
                            class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center text-gray-400 hover:bg-primary-600 hover:text-white transition">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    <?php endif; ?>
                    <?php if($instagram): ?>
                        <a href="<?php echo e($instagram); ?>" target="_blank"
                            class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center text-gray-400 hover:bg-primary-600 hover:text-white transition">
                            <i class="fab fa-instagram"></i>
                        </a>
                    <?php endif; ?>
                    <?php if($youtube): ?>
                        <a href="<?php echo e($youtube); ?>" target="_blank"
                            class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center text-gray-400 hover:bg-primary-600 hover:text-white transition">
                            <i class="fab fa-youtube"></i>
                        </a>
                    <?php endif; ?>
                    <?php if($twitter): ?>
                        <a href="<?php echo e($twitter); ?>" target="_blank"
                            class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center text-gray-400 hover:bg-primary-600 hover:text-white transition">
                            <i class="fab fa-twitter"></i>
                        </a>
                    <?php endif; ?>
                    <?php if($tiktok): ?>
                        <a href="<?php echo e($tiktok); ?>" target="_blank"
                            class="w-10 h-10 bg-gray-800 rounded-lg flex items-center justify-center text-gray-400 hover:bg-primary-600 hover:text-white transition">
                            <i class="fab fa-tiktok"></i>
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Maps -->
                <?php $mapsEmbed = App\Models\Setting::getValue('maps_embed'); ?>
                <?php if($mapsEmbed): ?>
                    <div class="aspect-video rounded-lg overflow-hidden">
                        <?php echo $mapsEmbed; ?>

                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Bottom Footer -->
    <div class="border-t border-gray-800">
        <div class="container mx-auto px-6 md:px-12 lg:px-28 py-4">
            <div class="flex flex-col md:flex-row items-center justify-between text-sm text-gray-400">
                <p>© <?php echo e(date('Y')); ?> <?php echo e($profil?->nama_desa ?? 'Desa Tanalum'); ?>. All rights reserved.</p>
                <p class="mt-2 md:mt-0">
                    <?php echo e(App\Models\Setting::getValue('footer_text', 'Dibangun oleh Mahasiswa KKN Unsoed untuk ' . ($profil?->nama_desa ?? 'Desa Tanalum'))); ?>

                </p>
            </div>
        </div>
    </div>
</footer>
<?php /**PATH C:\laragon\www\website-desa-tanalum\resources\views/partials/footer.blade.php ENDPATH**/ ?>
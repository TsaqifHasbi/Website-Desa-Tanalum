

<?php $__env->startSection('title', 'Data Geografis'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Hero Section -->
    <section class="relative py-20 bg-gradient-to-r from-primary-600 to-primary-700">
        <div class="container mx-auto px-4">
            <div class="text-center text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Data Geografis</h1>
                <p class="text-lg text-primary-100"><?php echo e($profil->nama_desa ?? 'Desa Tanalum'); ?></p>
            </div>
        </div>
    </section>

    <!-- Breadcrumb -->
    <div class="bg-white shadow-sm">
        <div class="container mx-auto px-4">
            <nav class="flex items-center space-x-2 py-4 text-sm">
                <a href="<?php echo e(route('home')); ?>" class="text-gray-500 hover:text-primary-600">Beranda</a>
                <span class="text-gray-400">/</span>
                <a href="<?php echo e(route('profil.index')); ?>" class="text-gray-500 hover:text-primary-600">Profil Desa</a>
                <span class="text-gray-400">/</span>
                <span class="text-primary-600 font-medium">Data Geografis</span>
            </nav>
        </div>
    </div>

    <!-- Content -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-8">
                    <!-- Peta -->
                    <div class="bg-white rounded-2xl shadow-sm overflow-hidden" data-aos="fade-up">
                        <div class="p-6 border-b border-gray-100">
                            <h2 class="text-xl font-bold text-gray-800">Peta Lokasi</h2>
                        </div>
                        <div class="aspect-video relative overflow-hidden">
                            <?php if($profil->peta_desa): ?>
                                <div class="absolute inset-0 w-full h-full [&>iframe]:w-full [&>iframe]:h-full [&>iframe]:border-0">
                                    <?php echo $profil->peta_desa; ?>

                                </div>
                            <?php elseif($profil->latitude && $profil->longitude): ?>
                                <iframe
                                    src="https://maps.google.com/maps?q=<?php echo e($profil->latitude); ?>,<?php echo e($profil->longitude); ?>&z=14&output=embed"
                                    class="absolute inset-0 w-full h-full border-0" loading="lazy" allowfullscreen>
                                </iframe>
                            <?php else: ?>
                                <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                                    <div class="text-center text-gray-500">
                                        <i class="fas fa-map text-4xl mb-2"></i>
                                        <p>Peta belum tersedia</p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Batas Wilayah -->
                    <div class="bg-white rounded-2xl shadow-sm p-6" data-aos="fade-up">
                        <h2 class="text-xl font-bold text-gray-800 mb-6">Batas Wilayah</h2>
                        <div class="grid md:grid-cols-2 gap-4">
                            <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center mr-4">
                                    <i class="fas fa-arrow-up text-blue-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Utara</p>
                                    <p class="font-medium text-gray-800"><?php echo e($profil->batas_utara ?? '-'); ?></p>
                                </div>
                            </div>
                            <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center mr-4">
                                    <i class="fas fa-arrow-right text-green-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Timur</p>
                                    <p class="font-medium text-gray-800"><?php echo e($profil->batas_timur ?? '-'); ?></p>
                                </div>
                            </div>
                            <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center mr-4">
                                    <i class="fas fa-arrow-down text-yellow-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Selatan</p>
                                    <p class="font-medium text-gray-800"><?php echo e($profil->batas_selatan ?? '-'); ?></p>
                                </div>
                            </div>
                            <div class="flex items-center p-4 bg-gray-50 rounded-xl">
                                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center mr-4">
                                    <i class="fas fa-arrow-left text-red-600"></i>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-500">Barat</p>
                                    <p class="font-medium text-gray-800"><?php echo e($profil->batas_barat ?? '-'); ?></p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Topografi -->
                    <?php if($profil->topografi || $profil->iklim): ?>
                        <div class="bg-white rounded-2xl shadow-sm p-6" data-aos="fade-up">
                            <h2 class="text-xl font-bold text-gray-800 mb-6">Kondisi Alam</h2>
                            <div class="grid md:grid-cols-2 gap-6">
                                <?php if($profil->topografi): ?>
                                    <div>
                                        <h3 class="font-semibold text-gray-700 mb-2">Topografi</h3>
                                        <p class="text-gray-600"><?php echo e($profil->topografi); ?></p>
                                    </div>
                                <?php endif; ?>
                                <?php if($profil->iklim): ?>
                                    <div>
                                        <h3 class="font-semibold text-gray-700 mb-2">Iklim</h3>
                                        <p class="text-gray-600"><?php echo e($profil->iklim); ?></p>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Data Wilayah -->
                    <div class="bg-white rounded-2xl shadow-sm p-6" data-aos="fade-left">
                        <h3 class="font-bold text-gray-800 mb-4">Data Wilayah</h3>
                        <div class="space-y-4">
                            <div class="flex justify-between items-center pb-3 border-b border-gray-100">
                                <span class="text-gray-500">Luas Wilayah</span>
                                <span
                                    class="font-semibold text-gray-800"><?php echo e($profil->luas_wilayah ? number_format($profil->luas_wilayah, 2) . ' Ha' : '-'); ?></span>
                            </div>
                            <div class="flex justify-between items-center pb-3 border-b border-gray-100">
                                <span class="text-gray-500">Jumlah Dusun</span>
                                <span class="font-semibold text-gray-800"><?php echo e($profil->jumlah_dusun ?? '4'); ?></span>
                            </div>
                            <div class="flex justify-between items-center pb-3 border-b border-gray-100">
                                <span class="text-gray-500">Jumlah RT</span>
                                <span class="font-semibold text-gray-800"><?php echo e($profil->jumlah_rt ?? '20'); ?></span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-500">Jumlah RW</span>
                                <span class="font-semibold text-gray-800"><?php echo e($profil->jumlah_rw ?? '4'); ?></span>
                            </div>
                        </div>
                    </div>

                    <!-- Koordinat -->
                    <?php if($profil->latitude && $profil->longitude): ?>
                        <div class="bg-white rounded-2xl shadow-sm p-6" data-aos="fade-left" data-aos-delay="100">
                            <h3 class="font-bold text-gray-800 mb-4">Koordinat</h3>
                            <div class="space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-500">Latitude</span>
                                    <span class="font-mono text-gray-800"><?php echo e($profil->latitude ?? '-7.288503'); ?></span>
                                </div>
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-500">Longitude</span>
                                    <span class="font-mono text-gray-800"><?php echo e($profil->longitude ?? '109.529823'); ?></span>
                                </div>
                            </div>
                            <a href="https://www.google.com/maps?q=<?php echo e($profil->latitude); ?>,<?php echo e($profil->longitude); ?>"
                                target="_blank"
                                class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium mt-4 text-sm">
                                <i class="fas fa-external-link-alt mr-2"></i>
                                Buka di Google Maps
                            </a>
                        </div>
                    <?php endif; ?>

                    <!-- Administrasi -->
                    <div class="bg-white rounded-2xl shadow-sm p-6" data-aos="fade-left" data-aos-delay="200">
                        <h3 class="font-bold text-gray-800 mb-4">Wilayah Administrasi</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between items-center pb-3 border-b border-gray-100">
                                <span class="text-gray-500">Provinsi</span>
                                <span
                                    class="font-medium text-gray-800"><?php echo e($profil->provinsi ?? 'Jawa Tengah'); ?></span>
                            </div>
                            <div class="flex justify-between items-center pb-3 border-b border-gray-100">
                                <span class="text-gray-500">Kabupaten</span>
                                <span
                                    class="font-medium text-gray-800"><?php echo e($profil->kabupaten ?? 'Purbalingga'); ?></span>
                            </div>
                            <div class="flex justify-between items-center pb-3 border-b border-gray-100">
                                <span class="text-gray-500">Kecamatan</span>
                                <span class="font-medium text-gray-800"><?php echo e($profil->kecamatan ?? 'Rembang'); ?></span>
                            </div>
                            <div class="flex justify-between items-center">
                                <span class="text-gray-500">Kode Pos</span>
                                <span class="font-medium text-gray-800"><?php echo e($profil->kode_pos ?? '-'); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Navigation -->
            <div class="flex flex-col sm:flex-row justify-between gap-4 mt-12">
                <a href="<?php echo e(route('profil.struktur')); ?>"
                    class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-gray-700 hover:bg-gray-50 rounded-lg transition">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Struktur Organisasi
                </a>
                <a href="<?php echo e(route('infografis.index')); ?>"
                    class="inline-flex items-center justify-center px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white rounded-lg transition">
                    Infografis
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\website-desa-tanalum\resources\views/profil/peta.blade.php ENDPATH**/ ?>
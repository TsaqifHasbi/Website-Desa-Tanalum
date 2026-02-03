

<?php $__env->startSection('title', $wisata->nama); ?>

<?php $__env->startSection('content'); ?>
    <!-- Hero Section -->
    <section class="relative h-[50vh] min-h-[400px]">
        <?php if($wisata->gambar_utama): ?>
            <img src="<?php echo e(Storage::url($wisata->gambar_utama)); ?>" alt="<?php echo e($wisata->nama); ?>" class="w-full h-full object-cover">
        <?php else: ?>
            <div class="w-full h-full bg-gradient-to-br from-primary-600 to-primary-700"></div>
        <?php endif; ?>
        <div class="absolute inset-0 bg-black/50"></div>
        <div class="absolute inset-0 flex items-center justify-center">
            <div class="text-center text-white px-4">
                <?php if($wisata->kategori): ?>
                    <span
                        class="inline-block px-4 py-1 bg-white/20 backdrop-blur rounded-full text-sm font-medium mb-4"><?php echo e($wisata->kategori); ?></span>
                <?php endif; ?>
                <h1 class="text-4xl md:text-5xl font-bold mb-4"><?php echo e($wisata->nama); ?></h1>
                <?php if($wisata->lokasi): ?>
                    <p class="text-lg text-white/80"><i class="fas fa-map-marker-alt mr-2"></i><?php echo e($wisata->lokasi); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Breadcrumb -->
    <div class="bg-white shadow-sm">
        <div class="container mx-auto px-4">
            <nav class="flex items-center space-x-2 py-4 text-sm">
                <a href="<?php echo e(route('home')); ?>" class="text-gray-500 hover:text-primary-600">Beranda</a>
                <span class="text-gray-400">/</span>
                <a href="<?php echo e(route('wisata.index')); ?>" class="text-gray-500 hover:text-primary-600">Wisata</a>
                <span class="text-gray-400">/</span>
                <span class="text-primary-600 font-medium"><?php echo e($wisata->nama); ?></span>
            </nav>
        </div>
    </div>

    <!-- Content -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <article class="bg-white rounded-2xl shadow-sm p-8" data-aos="fade-up">
                        <div class="prose prose-lg max-w-none">
                            <?php echo $wisata->deskripsi; ?>

                        </div>

                        <!-- Gallery -->
                        <?php if($wisata->galeri && count($wisata->galeri) > 0): ?>
                            <div class="mt-8 pt-8 border-t border-gray-100">
                                <h3 class="text-xl font-bold text-gray-800 mb-4">Galeri Foto</h3>
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                                    <?php $__currentLoopData = $wisata->galeri; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $foto): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="aspect-square rounded-xl overflow-hidden">
                                            <img src="<?php echo e(Storage::url($foto)); ?>" alt="Galeri <?php echo e($wisata->nama); ?>"
                                                class="w-full h-full object-cover hover:scale-110 transition duration-300">
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Facilities -->
                        <?php if($wisata->fasilitas && count($wisata->fasilitas) > 0): ?>
                            <div class="mt-8 pt-8 border-t border-gray-100">
                                <h3 class="text-xl font-bold text-gray-800 mb-4">Fasilitas</h3>
                                <div class="flex flex-wrap gap-2">
                                    <?php $__currentLoopData = $wisata->fasilitas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $fasilitas): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <span class="px-4 py-2 bg-primary-50 text-primary-700 rounded-lg text-sm">
                                            <i class="fas fa-check mr-1"></i> <?php echo e($fasilitas); ?>

                                        </span>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php endif; ?>
                    </article>

                    <!-- Map -->
                    <?php if($wisata->koordinat): ?>
                        <div class="mt-6 bg-white rounded-2xl shadow-sm p-6" data-aos="fade-up">
                            <h3 class="text-xl font-bold text-gray-800 mb-4">Lokasi</h3>
                            <div class="aspect-video rounded-xl overflow-hidden">
                                <iframe src="https://maps.google.com/maps?q=<?php echo e($wisata->koordinat); ?>&z=15&output=embed"
                                    width="100%" height="100%" frameborder="0" style="border:0;" allowfullscreen>
                                </iframe>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Info Card -->
                    <div class="bg-white rounded-2xl shadow-sm p-6" data-aos="fade-left">
                        <h3 class="font-bold text-gray-800 mb-4">Informasi</h3>
                        <div class="space-y-4">
                            <?php if($wisata->jam_buka): ?>
                                <div class="flex items-start">
                                    <div
                                        class="w-10 h-10 bg-primary-100 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                                        <i class="fas fa-clock text-primary-600"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Jam Operasional</p>
                                        <p class="font-medium text-gray-800"><?php echo e($wisata->jam_buka); ?></p>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if($wisata->harga_tiket): ?>
                                <div class="flex items-start">
                                    <div
                                        class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                                        <i class="fas fa-ticket-alt text-green-600"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Harga Tiket</p>
                                        <p class="font-medium text-gray-800">Rp
                                            <?php echo e(number_format($wisata->harga_tiket, 0, ',', '.')); ?></p>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if($wisata->kontak): ?>
                                <div class="flex items-start">
                                    <div
                                        class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center mr-3 flex-shrink-0">
                                        <i class="fas fa-phone text-green-600"></i>
                                    </div>
                                    <div>
                                        <p class="text-sm text-gray-500">Kontak</p>
                                        <p class="font-medium text-gray-800"><?php echo e($wisata->kontak); ?></p>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>

                        <?php if($wisata->koordinat): ?>
                            <a href="https://www.google.com/maps/search/?api=1&query=<?php echo e($wisata->koordinat); ?>"
                                target="_blank"
                                class="mt-6 w-full flex items-center justify-center px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition">
                                <i class="fas fa-directions mr-2"></i>
                                Petunjuk Arah
                            </a>
                        <?php endif; ?>
                    </div>

                    <!-- Related -->
                    <?php if($relatedWisatas->count() > 0): ?>
                        <div class="bg-white rounded-2xl shadow-sm p-6" data-aos="fade-left" data-aos-delay="100">
                            <h3 class="font-bold text-gray-800 mb-4">Wisata Lainnya</h3>
                            <div class="space-y-4">
                                <?php $__currentLoopData = $relatedWisatas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e(route('wisata.show', $related->slug)); ?>" class="flex items-center group">
                                        <div class="w-16 h-16 rounded-lg overflow-hidden flex-shrink-0">
                                            <?php if($related->gambar_utama): ?>
                                                <img src="<?php echo e(Storage::url($related->gambar_utama)); ?>"
                                                    alt="<?php echo e($related->nama); ?>" class="w-full h-full object-cover">
                                            <?php else: ?>
                                                <div class="w-full h-full bg-primary-100 flex items-center justify-center">
                                                    <i class="fas fa-mountain text-primary-400"></i>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div class="ml-3">
                                            <h4 class="font-medium text-gray-800 group-hover:text-primary-600 transition">
                                                <?php echo e($related->nama); ?></h4>
                                            <p class="text-sm text-gray-500"><?php echo e($related->kategori ?? 'Wisata'); ?></p>
                                        </div>
                                    </a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\website-desa-tanalum\resources\views/wisata/show.blade.php ENDPATH**/ ?>
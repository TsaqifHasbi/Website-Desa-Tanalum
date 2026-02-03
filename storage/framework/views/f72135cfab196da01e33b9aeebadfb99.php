

<?php $__env->startSection('title', 'Wisata Desa'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Hero Section -->
    <section class="relative py-20 bg-gradient-to-r from-primary-600 to-primary-700">
        <div class="container mx-auto px-4">
            <div class="text-center text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Wisata Desa</h1>
                <p class="text-lg text-primary-100">Jelajahi keindahan dan potensi wisata
                    <?php echo e($profil->nama_desa ?? 'Desa Tanalum'); ?></p>
            </div>
        </div>
    </section>

    <!-- Breadcrumb -->
    <div class="bg-white shadow-sm">
        <div class="container mx-auto px-4">
            <nav class="flex items-center space-x-2 py-4 text-sm">
                <a href="<?php echo e(route('home')); ?>" class="text-gray-500 hover:text-primary-600">Beranda</a>
                <span class="text-gray-400">/</span>
                <span class="text-primary-600 font-medium">Wisata</span>
            </nav>
        </div>
    </div>

    <!-- Content -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <?php if($wisatas->count() > 0): ?>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <?php $__currentLoopData = $wisatas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $wisata): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <article class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-lg transition group"
                            data-aos="fade-up" data-aos-delay="<?php echo e($index * 100); ?>">
                            <a href="<?php echo e(route('wisata.show', $wisata->slug)); ?>">
                                <div class="aspect-video overflow-hidden relative">
                                    <?php if($wisata->gambar_utama): ?>
                                        <img src="<?php echo e(Storage::url($wisata->gambar_utama)); ?>" alt="<?php echo e($wisata->nama); ?>"
                                            class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                    <?php else: ?>
                                        <div
                                            class="w-full h-full bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center">
                                            <i class="fas fa-mountain text-4xl text-primary-400"></i>
                                        </div>
                                    <?php endif; ?>
                                    <?php if($wisata->kategori): ?>
                                        <span
                                            class="absolute top-3 left-3 px-3 py-1 bg-white/90 text-primary-700 text-xs font-medium rounded-full">
                                            <?php echo e($wisata->kategori); ?>

                                        </span>
                                    <?php endif; ?>
                                </div>
                            </a>
                            <div class="p-6">
                                <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-primary-600 transition">
                                    <a href="<?php echo e(route('wisata.show', $wisata->slug)); ?>"><?php echo e($wisata->nama); ?></a>
                                </h3>
                                <?php if($wisata->lokasi): ?>
                                    <p class="text-sm text-gray-500 mb-3">
                                        <i class="fas fa-map-marker-alt mr-1"></i> <?php echo e($wisata->lokasi); ?>

                                    </p>
                                <?php endif; ?>
                                <p class="text-gray-600 line-clamp-3"><?php echo e(Str::limit(strip_tags($wisata->deskripsi), 120)); ?>

                                </p>
                                <a href="<?php echo e(route('wisata.show', $wisata->slug)); ?>"
                                    class="inline-flex items-center text-primary-600 hover:text-primary-700 font-medium mt-4">
                                    Selengkapnya
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </article>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    <?php echo e($wisatas->links()); ?>

                </div>
            <?php else: ?>
                <div class="text-center py-16 bg-white rounded-2xl shadow-sm">
                    <i class="fas fa-mountain text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Data Wisata</h3>
                    <p class="text-gray-500">Data wisata desa belum tersedia.</p>
                </div>
            <?php endif; ?>

            <!-- Potensi Section -->
            <?php if($potensis->count() > 0): ?>
                <div class="mt-16">
                    <div class="text-center mb-12" data-aos="fade-up">
                        <h2 class="text-3xl font-bold text-gray-800">Potensi Desa</h2>
                        <p class="text-gray-600 mt-2">Berbagai potensi unggulan yang dimiliki desa</p>
                    </div>

                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                        <?php $__currentLoopData = $potensis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $potensi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <article class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-lg transition group"
                                data-aos="fade-up" data-aos-delay="<?php echo e($index * 100); ?>">
                                <div class="aspect-video overflow-hidden relative">
                                    <?php if($potensi->gambar_utama): ?>
                                        <img src="<?php echo e(Storage::url($potensi->gambar_utama)); ?>" alt="<?php echo e($potensi->nama); ?>"
                                            class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                    <?php else: ?>
                                        <div
                                            class="w-full h-full bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center">
                                            <i class="fas fa-leaf text-4xl text-white/50"></i>
                                        </div>
                                    <?php endif; ?>
                                    <?php if($potensi->kategori): ?>
                                        <span
                                            class="absolute top-3 left-3 px-3 py-1 bg-white/90 text-primary-700 text-xs font-medium rounded-full shadow-sm">
                                            <?php echo e($potensi->kategori->nama); ?>

                                        </span>
                                    <?php endif; ?>
                                </div>
                                <div class="p-6">
                                    <h3 class="text-xl font-bold text-gray-800 mb-2">
                                        <?php echo e($potensi->nama); ?>

                                    </h3>
                                    <p class="text-gray-600 line-clamp-3 mb-4">
                                        <?php echo e(Str::limit(strip_tags($potensi->deskripsi), 120)); ?>

                                    </p>
                                    <?php if($potensi->lokasi): ?>
                                        <p class="text-sm text-gray-500">
                                            <i class="fas fa-map-marker-alt mr-1 text-primary-500"></i> <?php echo e($potensi->lokasi); ?>

                                        </p>
                                    <?php endif; ?>
                                </div>
                            </article>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\website-desa-tanalum\resources\views/wisata/index.blade.php ENDPATH**/ ?>
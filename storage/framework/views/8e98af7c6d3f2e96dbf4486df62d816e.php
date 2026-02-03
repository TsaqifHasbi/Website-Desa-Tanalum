

<?php $__env->startSection('title', 'PPID - Pejabat Pengelola Informasi dan Dokumentasi'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Hero Section -->
    <section class="relative py-16 bg-gradient-to-r from-green-600 to-green-700">
        <div class="container mx-auto px-6 md:px-8 lg:px-12">
            <div class="max-w-7xl mx-auto">
                <div class="flex flex-col lg:flex-row items-center justify-between gap-8">
                    <!-- Text Content -->
                    <div class="text-white max-w-2xl">
                        <h1 class="text-4xl md:text-5xl font-bold mb-4">PPID</h1>
                        <p class="text-lg text-green-100 mb-6">
                            Pejabat Pengelola Informasi dan Dokumentasi (PPID) adalah pejabat yang bertanggung jawab di bidang
                            penyimpanan, pendokumentasian, penyediaan, dan/atau pelayanan informasi di badan publik.
                        </p>
                        <a href="<?php echo e(route('ppid.dasar-hukum')); ?>"
                            class="inline-flex items-center px-6 py-3 border-2 border-white text-white hover:bg-white hover:text-green-700 rounded-lg transition-colors font-medium">
                            Dasar Hukum PPID
                        </a>
                    </div>

                    <!-- Category Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 w-full lg:w-auto">
                        <a href="<?php echo e(route('ppid.berkala')); ?>"
                            class="bg-white rounded-xl p-6 text-center hover:shadow-lg transition-shadow">
                            <div class="w-16 h-16 mx-auto mb-3 bg-green-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-calendar-check text-green-600 text-2xl"></i>
                            </div>
                            <h3 class="font-bold text-gray-800 text-xs sm:text-sm">INFORMASI SECARA BERKALA</h3>
                        </a>
                        <a href="<?php echo e(route('ppid.serta-merta')); ?>"
                            class="bg-white rounded-xl p-6 text-center hover:shadow-lg transition-shadow">
                            <div class="w-16 h-16 mx-auto mb-3 bg-orange-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-bullhorn text-orange-600 text-2xl"></i>
                            </div>
                            <h3 class="font-bold text-gray-800 text-xs sm:text-sm">INFORMASI SERTA MERTA</h3>
                        </a>
                        <a href="<?php echo e(route('ppid.setiap-saat')); ?>"
                            class="bg-white rounded-xl p-6 text-center hover:shadow-lg transition-shadow">
                            <div class="w-16 h-16 mx-auto mb-3 bg-blue-100 rounded-full flex items-center justify-center">
                                <i class="fas fa-clock text-blue-600 text-2xl"></i>
                            </div>
                            <h3 class="font-bold text-gray-800 text-xs sm:text-sm">INFORMASI SETIAP SAAT</h3>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest Documents Section -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-6 md:px-8 lg:px-12">
            <div class="max-w-7xl mx-auto">
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-green-600 mb-2">INFORMASI PUBLIK TERBARU</h2>
                    <?php if($dokumenTerbaru->isNotEmpty()): ?>
                        <p class="text-gray-600">Update terakhir <?php echo e($dokumenTerbaru->first()->updated_at->diffForHumans()); ?></p>
                    <?php else: ?>
                        <p class="text-gray-600">Belum ada dokumen informasi publik</p>
                    <?php endif; ?>
                </div>

                <div class="space-y-4">
                    <?php $__empty_1 = true; $__currentLoopData = $dokumenTerbaru; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dokumen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                            <div class="p-6 flex flex-col lg:flex-row lg:items-center justify-between gap-4">
                                <div class="flex-1">
                                    <h3 class="text-lg font-bold text-gray-800 uppercase mb-2">
                                        <?php echo e($dokumen->judul); ?>

                                    </h3>
                                    <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500">
                                        <span class="inline-flex items-center">
                                            <i class="fas fa-folder mr-2 text-green-600"></i>
                                            <?php echo e($dokumen->kategori->nama ?? 'Informasi Publik'); ?>

                                        </span>
                                        <span class="inline-flex items-center">
                                            <i class="fas fa-calendar mr-2 text-green-600"></i>
                                            <?php echo e($dokumen->tanggal_dokumen ? $dokumen->tanggal_dokumen->translatedFormat('l, d F Y') : $dokumen->created_at->translatedFormat('l, d F Y')); ?>

                                        </span>
                                    </div>
                                </div>
                                <div class="flex flex-col sm:flex-row gap-2 lg:items-end">
                                    <a href="<?php echo e(route('ppid.view', $dokumen->slug)); ?>" target="_blank"
                                        class="inline-flex items-center justify-center px-6 py-2 border border-green-600 text-green-600 hover:bg-green-50 rounded-lg transition-colors">
                                        <i class="fas fa-eye mr-2"></i>
                                        Lihat Berkas
                                    </a>
                                    <a href="<?php echo e(route('ppid.download', $dokumen->slug)); ?>"
                                        class="inline-flex items-center justify-center px-6 py-2 text-gray-600 hover:text-green-600 transition-colors">
                                        <i class="fas fa-download mr-2"></i>
                                        Unduh (<?php echo e($dokumen->download_count ?? 0); ?>x)
                                    </a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="bg-white rounded-xl shadow-sm p-12 text-center">
                            <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-folder-open text-gray-400 text-3xl"></i>
                            </div>
                            <h3 class="text-xl font-semibold text-gray-800 mb-2">Belum Ada Dokumen</h3>
                            <p class="text-gray-600">Dokumen informasi publik belum tersedia.</p>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Request Information CTA -->
    <section class="py-12">
        <div class="container mx-auto px-6 md:px-8 lg:px-12">
            <div class="max-w-7xl mx-auto">
                <div class="bg-white rounded-2xl shadow-sm p-8 md:p-12 text-center">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Ingin mengajukan permohonan informasi?</h2>
                    <p class="text-gray-600 mb-6 max-w-2xl mx-auto">
                        Ajukan permohonan informasi publik secara resmi melalui formulir PPID Desa Tanalum.
                    </p>
                    <a href="<?php echo e(route('ppid.permohonan')); ?>"
                        class="inline-flex items-center px-8 py-3 bg-green-600 text-white hover:bg-green-700 rounded-lg transition-colors font-medium">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Ajukan Permohonan Informasi
                    </a>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        // Any additional scripts for PPID page
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\website-desa-tanalum\resources\views/ppid/index.blade.php ENDPATH**/ ?>
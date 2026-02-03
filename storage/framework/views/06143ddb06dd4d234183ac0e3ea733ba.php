

<?php $__env->startSection('title', 'Struktur Organisasi'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Hero Section -->
    <section class="relative py-20 bg-gradient-to-r from-primary-600 to-primary-700">
        <div class="container mx-auto px-4">
            <div class="text-center text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Struktur Organisasi</h1>
                <p class="text-lg text-primary-100">Pemerintah <?php echo e($profil->nama_desa ?? 'Desa Tanalum'); ?></p>
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
                <span class="text-primary-600 font-medium">Struktur Organisasi</span>
            </nav>
        </div>
    </div>

    <!-- Content -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <!-- Kepala Desa -->
            <?php if($kepalaDesa): ?>
                <div class="text-center mb-12" data-aos="fade-up">
                    <div class="inline-block">
                        <div
                            class="w-40 h-40 mx-auto rounded-full overflow-hidden mb-4 border-4 border-primary-200 shadow-xl">
                            <?php if($kepalaDesa->foto): ?>
                                <img src="<?php echo e(Storage::url($kepalaDesa->foto)); ?>" alt="<?php echo e($kepalaDesa->nama); ?>"
                                    class="w-full h-full object-cover">
                            <?php else: ?>
                                <div class="w-full h-full bg-primary-100 flex items-center justify-center">
                                    <i class="fas fa-user text-5xl text-primary-400"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        <h3 class="text-xl font-bold text-gray-800"><?php echo e($kepalaDesa->nama); ?></h3>
                        <p class="text-primary-600 font-medium"><?php echo e($kepalaDesa->jabatan); ?></p>
                        <?php if($kepalaDesa->nip): ?>
                            <p class="text-sm text-gray-500 mt-1">NIP: <?php echo e($kepalaDesa->nip); ?></p>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Connector Line -->
            <div class="hidden lg:block w-0.5 h-12 bg-primary-200 mx-auto mb-8"></div>

            <!-- Sekretaris & Kasi -->
            <?php
                $sekretaris = $aparaturs->where('jabatan', 'like', '%sekretaris%')->first();
                $perangkat = $aparaturs
                    ->whereNotIn('jabatan', ['Kepala Desa'])
                    ->where('jabatan', 'not like', '%sekretaris%');
            ?>

            <?php if($sekretaris): ?>
                <div class="text-center mb-8" data-aos="fade-up">
                    <div class="inline-block">
                        <div class="w-32 h-32 mx-auto rounded-full overflow-hidden mb-3 border-4 border-white shadow-lg">
                            <?php if($sekretaris->foto): ?>
                                <img src="<?php echo e(Storage::url($sekretaris->foto)); ?>" alt="<?php echo e($sekretaris->nama); ?>"
                                    class="w-full h-full object-cover">
                            <?php else: ?>
                                <div class="w-full h-full bg-primary-100 flex items-center justify-center">
                                    <i class="fas fa-user text-3xl text-primary-400"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        <h3 class="font-semibold text-gray-800"><?php echo e($sekretaris->nama); ?></h3>
                        <p class="text-sm text-gray-500"><?php echo e($sekretaris->jabatan); ?></p>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Connector Line -->
            <div class="hidden lg:block w-0.5 h-12 bg-primary-200 mx-auto mb-8"></div>

            <!-- Perangkat Desa -->
            <?php if($perangkat->count() > 0): ?>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6 mb-12">
                    <?php $__currentLoopData = $perangkat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $aparatur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="text-center" data-aos="fade-up" data-aos-delay="<?php echo e($index * 50); ?>">
                            <div class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-md transition">
                                <div class="w-24 h-24 mx-auto rounded-full overflow-hidden mb-4 border-4 border-gray-100">
                                    <?php if($aparatur->foto): ?>
                                        <img src="<?php echo e(Storage::url($aparatur->foto)); ?>" alt="<?php echo e($aparatur->nama); ?>"
                                            class="w-full h-full object-cover">
                                    <?php else: ?>
                                        <div class="w-full h-full bg-primary-100 flex items-center justify-center">
                                            <i class="fas fa-user text-2xl text-primary-400"></i>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <h3 class="font-semibold text-gray-800 text-sm"><?php echo e($aparatur->nama); ?></h3>
                                <p class="text-xs text-gray-500 mt-1"><?php echo e($aparatur->jabatan); ?></p>
                                <?php if($aparatur->nip): ?>
                                    <p class="text-xs text-gray-400 mt-1">NIP: <?php echo e($aparatur->nip); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            <?php endif; ?>

            <?php if($aparaturs->isEmpty()): ?>
                <div class="text-center py-12 bg-white rounded-2xl shadow-sm">
                    <i class="fas fa-users text-4xl text-gray-300 mb-4"></i>
                    <p class="text-gray-500">Data aparatur desa belum tersedia</p>
                </div>
            <?php endif; ?>

            <!-- BPD Section -->
            <?php
                $bpdMembers = App\Models\AparaturDesa::where('jenis', 'bpd')
                    ->where('is_active', true)
                    ->orderBy('urutan')
                    ->get();
            ?>

            <?php if($bpdMembers->count() > 0): ?>
                <div class="mt-16">
                    <div class="text-center mb-8" data-aos="fade-up">
                        <h2 class="text-2xl font-bold text-gray-800">Badan Permusyawaratan Desa (BPD)</h2>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                        <?php $__currentLoopData = $bpdMembers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $anggota): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="text-center" data-aos="fade-up" data-aos-delay="<?php echo e($index * 50); ?>">
                                <div class="bg-white rounded-2xl shadow-sm p-6 hover:shadow-md transition">
                                    <div
                                        class="w-20 h-20 mx-auto rounded-full overflow-hidden mb-4 border-4 border-gray-100">
                                        <?php if($anggota->foto): ?>
                                            <img src="<?php echo e(Storage::url($anggota->foto)); ?>" alt="<?php echo e($anggota->nama); ?>"
                                                class="w-full h-full object-cover">
                                        <?php else: ?>
                                            <div class="w-full h-full bg-blue-100 flex items-center justify-center">
                                                <i class="fas fa-user text-xl text-blue-400"></i>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <h3 class="font-semibold text-gray-800 text-sm"><?php echo e($anggota->nama); ?></h3>
                                    <p class="text-xs text-gray-500 mt-1"><?php echo e($anggota->jabatan); ?></p>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Navigation -->
            <div class="flex flex-col sm:flex-row justify-between gap-4 mt-12">
                <a href="<?php echo e(route('profil.visi-misi')); ?>"
                    class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-gray-700 hover:bg-gray-50 rounded-lg transition">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Visi & Misi
                </a>
                <a href="<?php echo e(route('profil.peta')); ?>"
                    class="inline-flex items-center justify-center px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white rounded-lg transition">
                    Data Geografis
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\website-desa-tanalum\resources\views/profil/struktur.blade.php ENDPATH**/ ?>
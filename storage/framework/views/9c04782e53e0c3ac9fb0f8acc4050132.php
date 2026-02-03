

<?php $__env->startSection('title', 'Sejarah Desa'); ?>

<?php $__env->startSection('content'); ?>
    <div class="space-y-6">
        <!-- Header -->
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Sejarah Desa</h1>
            <p class="text-gray-600">Kelola konten sejarah desa: Cerita Rakyat dan Riwayat Kepemimpinan</p>
        </div>

        <!-- Tabs -->
        <div x-data="{ activeTab: 'cerita-rakyat' }">
            <div class="bg-white rounded-xl shadow-sm">
                <!-- Tab Navigation -->
                <div class="border-b border-gray-200">
                    <nav class="flex overflow-x-auto">
                        <button type="button" @click="activeTab = 'cerita-rakyat'"
                            :class="activeTab === 'cerita-rakyat' ? 'border-primary-500 text-primary-600' :
                                'border-transparent text-gray-500 hover:text-gray-700'"
                            class="px-6 py-4 text-sm font-medium border-b-2 whitespace-nowrap transition">
                            <i class="fas fa-book-reader mr-2"></i> Cerita Rakyat
                        </button>
                        <button type="button" @click="activeTab = 'kepala-desa'"
                            :class="activeTab === 'kepala-desa' ? 'border-primary-500 text-primary-600' :
                                'border-transparent text-gray-500 hover:text-gray-700'"
                            class="px-6 py-4 text-sm font-medium border-b-2 whitespace-nowrap transition">
                            <i class="fas fa-user-tie mr-2"></i> Riwayat Kepemimpinan
                        </button>
                    </nav>
                </div>

                <!-- Tab Content -->
                <div class="p-6">
                    <!-- Cerita Rakyat -->
                    <div x-show="activeTab === 'cerita-rakyat'" class="space-y-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">Cerita Rakyat - Cikal Bakal Desa Tanalum</h3>
                                <p class="text-sm text-gray-600">Kelola cerita rakyat dan legenda desa</p>
                            </div>
                            <a href="<?php echo e(route('admin.sejarah.cerita.create')); ?>"
                                class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition">
                                <i class="fas fa-plus mr-2"></i>
                                Tambah Cerita
                            </a>
                        </div>

                        <!-- Cerita List -->
                        <div class="space-y-4">
                            <?php $__empty_1 = true; $__currentLoopData = $ceritaRakyat ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cerita): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div class="flex items-start gap-4 p-4 bg-gray-50 rounded-xl hover:bg-gray-100 transition">
                                    <?php if($cerita->gambar_utama): ?>
                                        <div class="w-24 h-20 rounded-lg overflow-hidden bg-gray-200 flex-shrink-0">
                                            <img src="<?php echo e(Storage::url($cerita->gambar_utama)); ?>" alt="<?php echo e($cerita->judul); ?>"
                                                class="w-full h-full object-cover">
                                        </div>
                                    <?php else: ?>
                                        <div class="w-24 h-20 rounded-lg bg-primary-100 flex items-center justify-center flex-shrink-0">
                                            <i class="fas fa-book text-2xl text-primary-600"></i>
                                        </div>
                                    <?php endif; ?>
                                    <div class="flex-1 min-w-0">
                                        <h4 class="font-semibold text-gray-800"><?php echo e($cerita->judul); ?></h4>
                                        <p class="text-sm text-gray-600 line-clamp-2 mt-1">
                                            <?php echo e(Str::limit(strip_tags($cerita->konten), 150)); ?>

                                        </p>
                                        <div class="flex items-center gap-3 mt-2">
                                            <?php if($cerita->is_active): ?>
                                                <span class="px-2 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-full">Aktif</span>
                                            <?php else: ?>
                                                <span class="px-2 py-1 bg-gray-100 text-gray-700 text-xs font-medium rounded-full">Nonaktif</span>
                                            <?php endif; ?>
                                            <span class="text-sm text-gray-500">Urutan: <?php echo e($cerita->urutan); ?></span>
                                        </div>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <a href="<?php echo e(route('admin.sejarah.cerita.edit', $cerita)); ?>"
                                            class="p-2 text-gray-500 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="<?php echo e(route('admin.sejarah.cerita.destroy', $cerita)); ?>" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus cerita ini?')">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit"
                                                class="p-2 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition"
                                                title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="text-center py-12">
                                    <i class="fas fa-book-reader text-4xl text-gray-300 mb-3"></i>
                                    <p class="text-gray-500">Belum ada cerita rakyat.</p>
                                    <a href="<?php echo e(route('admin.sejarah.cerita.create')); ?>"
                                        class="inline-flex items-center mt-4 text-primary-600 hover:text-primary-700">
                                        <i class="fas fa-plus mr-1"></i> Tambah cerita pertama
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Kepala Desa -->
                    <div x-show="activeTab === 'kepala-desa'" class="space-y-6">
                        <div class="flex items-center justify-between">
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800">Tanalum dalam Riwayat Kepemerintahan</h3>
                                <p class="text-sm text-gray-600">Daftar kepala desa dari tahun ke tahun</p>
                            </div>
                            <a href="<?php echo e(route('admin.sejarah.kepala.create')); ?>"
                                class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition">
                                <i class="fas fa-plus mr-2"></i>
                                Tambah Kepala Desa
                            </a>
                        </div>

                        <!-- Kepala Desa List -->
                        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <?php $__empty_1 = true; $__currentLoopData = $kepalaDesa ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kepala): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                <div class="bg-gray-50 rounded-xl p-4 hover:bg-gray-100 transition">
                                    <div class="flex items-start gap-4">
                                        <?php if($kepala->foto): ?>
                                            <div class="w-20 h-24 rounded-lg overflow-hidden bg-gray-200 flex-shrink-0">
                                                <img src="<?php echo e(Storage::url($kepala->foto)); ?>" alt="<?php echo e($kepala->nama); ?>"
                                                    class="w-full h-full object-cover">
                                            </div>
                                        <?php else: ?>
                                            <div class="w-20 h-24 rounded-lg bg-primary-100 flex items-center justify-center flex-shrink-0">
                                                <i class="fas fa-user text-2xl text-primary-600"></i>
                                            </div>
                                        <?php endif; ?>
                                        <div class="flex-1 min-w-0">
                                            <h4 class="font-semibold text-gray-800"><?php echo e($kepala->nama); ?></h4>
                                            <p class="text-sm text-primary-600 font-medium mt-1">
                                                <?php echo e($kepala->periode); ?>

                                            </p>
                                            <?php if($kepala->keterangan): ?>
                                                <p class="text-xs text-gray-500 mt-1 line-clamp-2">
                                                    <?php echo e($kepala->keterangan); ?>

                                                </p>
                                            <?php endif; ?>
                                            <?php if($kepala->is_active): ?>
                                                <span class="inline-flex mt-2 px-2 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-full">Aktif</span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <div class="flex items-center justify-end gap-2 mt-3 pt-3 border-t border-gray-200">
                                        <a href="<?php echo e(route('admin.sejarah.kepala.edit', $kepala)); ?>"
                                            class="p-2 text-gray-500 hover:text-primary-600 hover:bg-white rounded-lg transition"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="<?php echo e(route('admin.sejarah.kepala.destroy', $kepala)); ?>" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus data kepala desa ini?')">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit"
                                                class="p-2 text-gray-500 hover:text-red-600 hover:bg-white rounded-lg transition"
                                                title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                <div class="md:col-span-2 lg:col-span-3 text-center py-12">
                                    <i class="fas fa-user-tie text-4xl text-gray-300 mb-3"></i>
                                    <p class="text-gray-500">Belum ada data kepala desa.</p>
                                    <a href="<?php echo e(route('admin.sejarah.kepala.create')); ?>"
                                        class="inline-flex items-center mt-4 text-primary-600 hover:text-primary-700">
                                        <i class="fas fa-plus mr-1"></i> Tambah kepala desa pertama
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\website-desa-tanalum\resources\views/admin/sejarah-desa/index.blade.php ENDPATH**/ ?>
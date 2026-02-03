

<?php $__env->startSection('title', 'Manajemen Galeri'); ?>

<?php $__env->startSection('content'); ?>
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Galeri</h1>
                <p class="text-gray-600">Kelola foto dan video desa</p>
            </div>
            <a href="<?php echo e(route('admin.galeri.create')); ?>"
                class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition">
                <i class="fas fa-plus mr-2"></i>
                Tambah Galeri
            </a>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <form action="<?php echo e(route('admin.galeri.index')); ?>" method="GET" class="grid md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Cari</label>
                    <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Judul galeri..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Tipe</label>
                    <select name="tipe"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                        <option value="">Semua Tipe</option>
                        <option value="foto" <?php echo e(request('tipe') == 'foto' ? 'selected' : ''); ?>>Foto</option>
                        <option value="video" <?php echo e(request('tipe') == 'video' ? 'selected' : ''); ?>>Video</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                    <select name="kategori"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                        <option value="">Semua Kategori</option>
                        <?php $__currentLoopData = $kategoris ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($kategori); ?>" <?php echo e(request('kategori') == $kategori ? 'selected' : ''); ?>>
                                <?php echo e($kategori); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="flex items-end gap-2">
                    <button type="submit"
                        class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition">
                        <i class="fas fa-search mr-1"></i> Filter
                    </button>
                    <a href="<?php echo e(route('admin.galeri.index')); ?>"
                        class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Gallery Grid -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <?php if(session('success')): ?>
                <div class="mb-4 p-4 bg-green-100 border border-green-200 text-green-700 rounded-lg">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <?php if($galeris->count() > 0): ?>
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    <?php $__currentLoopData = $galeris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $galeri): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="group relative bg-gray-100 rounded-xl overflow-hidden aspect-square">
                            <?php if($galeri->tipe == 'foto'): ?>
                                <img src="<?php echo e($galeri->file_path ? Storage::url($galeri->file_path) : asset('img/placeholder.jpg')); ?>"
                                    alt="<?php echo e($galeri->judul); ?>" class="w-full h-full object-cover">
                            <?php else: ?>
                                <div class="w-full h-full flex items-center justify-center bg-gray-800">
                                    <i class="fas fa-play-circle text-5xl text-white/80"></i>
                                </div>
                                <?php if($galeri->thumbnail): ?>
                                    <img src="<?php echo e(Storage::url($galeri->thumbnail)); ?>" alt="<?php echo e($galeri->judul); ?>"
                                        class="absolute inset-0 w-full h-full object-cover">
                                    <div class="absolute inset-0 flex items-center justify-center">
                                        <i class="fas fa-play-circle text-5xl text-white drop-shadow-lg"></i>
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>

                            <!-- Overlay -->
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <div class="absolute bottom-0 left-0 right-0 p-4">
                                    <h4 class="text-white font-medium text-sm line-clamp-2 mb-2"><?php echo e($galeri->judul); ?></h4>
                                    <div class="flex items-center justify-between">
                                        <span class="text-white/70 text-xs">
                                            <?php if($galeri->tipe == 'foto'): ?>
                                                <i class="fas fa-image mr-1"></i>
                                            <?php else: ?>
                                                <i class="fas fa-video mr-1"></i>
                                            <?php endif; ?>
                                            <?php echo e(ucfirst($galeri->tipe)); ?>

                                        </span>
                                        <div class="flex items-center gap-1">
                                            <a href="<?php echo e(route('admin.galeri.edit', $galeri->id)); ?>"
                                                class="p-2 bg-white/20 hover:bg-white/30 rounded-lg text-white transition"
                                                title="Edit">
                                                <i class="fas fa-edit text-sm"></i>
                                            </a>
                                            <form action="<?php echo e(route('admin.galeri.destroy', $galeri->id)); ?>" method="POST"
                                                onsubmit="return confirm('Yakin ingin menghapus galeri ini?')">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>
                                                <button type="submit"
                                                    class="p-2 bg-red-500/80 hover:bg-red-600 rounded-lg text-white transition"
                                                    title="Hapus">
                                                    <i class="fas fa-trash text-sm"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Status Badge -->
                            <?php if(!$galeri->is_active): ?>
                                <div class="absolute top-2 left-2">
                                    <span
                                        class="px-2 py-1 bg-yellow-500 text-white text-xs font-medium rounded">Draft</span>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!-- Pagination -->
                <div class="mt-6">
                    <?php echo e($galeris->withQueryString()->links()); ?>

                </div>
            <?php else: ?>
                <div class="text-center py-12">
                    <i class="fas fa-images text-5xl text-gray-300 mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-600 mb-2">Belum Ada Galeri</h3>
                    <p class="text-gray-500 mb-4">Mulai dengan menambahkan foto atau video pertama.</p>
                    <a href="<?php echo e(route('admin.galeri.create')); ?>"
                        class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Galeri
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\website-desa-tanalum\resources\views/admin/galeri/index.blade.php ENDPATH**/ ?>
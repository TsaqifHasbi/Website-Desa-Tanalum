

<?php $__env->startSection('title', 'Potensi Desa'); ?>

<?php $__env->startSection('content'); ?>
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Potensi Desa</h1>
                <p class="text-gray-600">Kelola data potensi desa</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="<?php echo e(route('admin.potensi.kategori')); ?>"
                    class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition flex items-center gap-2">
                    <i class="fas fa-tags"></i>
                    <span>Kategori</span>
                </a>
                <a href="<?php echo e(route('admin.potensi.create')); ?>"
                    class="px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition flex items-center gap-2">
                    <i class="fas fa-plus"></i>
                    <span>Tambah Potensi</span>
                </a>
            </div>
        </div>

        <?php if(session('success')): ?>
            <div class="p-4 bg-green-100 border border-green-200 text-green-700 rounded-lg">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <!-- Filter -->
        <div class="bg-white rounded-xl shadow-sm p-4">
            <form action="<?php echo e(route('admin.potensi.index')); ?>" method="GET" class="flex flex-wrap gap-4">
                <div class="flex-1 min-w-[200px]">
                    <input type="text" name="q" value="<?php echo e(request('q')); ?>" placeholder="Cari potensi..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                </div>
                <div class="w-48">
                    <select name="kategori"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                        <option value="">Semua Kategori</option>
                        <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($kategori->id); ?>"
                                <?php echo e(request('kategori') == $kategori->id ? 'selected' : ''); ?>>
                                <?php echo e($kategori->nama); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <button type="submit"
                    class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition">
                    <i class="fas fa-search mr-2"></i>
                    Filter
                </button>
            </form>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Potensi</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Kategori</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php $__empty_1 = true; $__currentLoopData = $potensis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $potensi): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-4">
                                        <?php if($potensi->gambar_utama): ?>
                                            <img src="<?php echo e(asset('storage/' . $potensi->gambar_utama)); ?>" alt="<?php echo e($potensi->nama); ?>"
                                                class="w-16 h-16 object-cover rounded-lg">
                                        <?php else: ?>
                                            <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                                <i class="fas fa-image text-gray-400 text-xl"></i>
                                            </div>
                                        <?php endif; ?>
                                        <div>
                                            <h3 class="font-semibold text-gray-800"><?php echo e($potensi->nama); ?></h3>
                                            <p class="text-sm text-gray-500 line-clamp-1">
                                                <?php echo e(Str::limit(strip_tags($potensi->deskripsi), 60)); ?></p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <?php if($potensi->kategori): ?>
                                        <span class="px-3 py-1 bg-primary-100 text-primary-700 rounded-full text-sm">
                                            <?php echo e($potensi->kategori->nama); ?>

                                        </span>
                                    <?php else: ?>
                                        <span class="text-gray-400">-</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php if($potensi->is_active): ?>
                                        <span
                                            class="inline-flex items-center gap-1 px-3 py-1 bg-green-100 text-green-700 rounded-full text-sm">
                                            <i class="fas fa-check-circle text-xs"></i>
                                            Aktif
                                        </span>
                                    <?php else: ?>
                                        <span
                                            class="inline-flex items-center gap-1 px-3 py-1 bg-gray-100 text-gray-600 rounded-full text-sm">
                                            <i class="fas fa-times-circle text-xs"></i>
                                            Nonaktif
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="<?php echo e(route('admin.potensi.edit', $potensi)); ?>"
                                            class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="<?php echo e(route('admin.potensi.destroy', $potensi)); ?>" method="POST"
                                            class="inline"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus potensi ini?')">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit"
                                                class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition"
                                                title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-gray-500">
                                    <div class="flex flex-col items-center">
                                        <i class="fas fa-leaf text-4xl text-gray-300 mb-3"></i>
                                        <p>Belum ada data potensi desa</p>
                                        <a href="<?php echo e(route('admin.potensi.create')); ?>"
                                            class="mt-2 text-primary-600 hover:underline">
                                            Tambah potensi pertama
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <?php if($potensis->hasPages()): ?>
                <div class="px-6 py-4 border-t border-gray-200">
                    <?php echo e($potensis->links()); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\website-desa-tanalum\resources\views/admin/potensi/index.blade.php ENDPATH**/ ?>
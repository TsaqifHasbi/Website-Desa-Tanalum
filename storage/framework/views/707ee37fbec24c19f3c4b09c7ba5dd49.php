

<?php $__env->startSection('title', 'Manajemen Produk UMKM'); ?>

<?php $__env->startSection('content'); ?>
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Produk UMKM</h1>
                <p class="text-gray-600">Kelola produk UMKM Desa</p>
            </div>
            <a href="<?php echo e(route('admin.produk.create')); ?>"
                class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition">
                <i class="fas fa-plus mr-2"></i>
                Tambah Produk
            </a>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <form action="<?php echo e(route('admin.produk.index')); ?>" method="GET" class="grid md:grid-cols-5 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Cari</label>
                    <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Nama produk..."
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                    <select name="kategori"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                        <option value="">Semua</option>
                        <?php $__currentLoopData = $kategoris ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($kategori); ?>" <?php echo e(request('kategori') == $kategori ? 'selected' : ''); ?>>
                                <?php echo e($kategori); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status"
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                        <option value="">Semua</option>
                        <option value="1" <?php echo e(request('status') === '1' ? 'selected' : ''); ?>>Aktif</option>
                        <option value="0" <?php echo e(request('status') === '0' ? 'selected' : ''); ?>>Nonaktif</option>
                    </select>
                </div>
                <div class="flex items-end gap-2">
                    <button type="submit"
                        class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition">
                        <i class="fas fa-search mr-1"></i> Filter
                    </button>
                    <a href="<?php echo e(route('admin.produk.index')); ?>"
                        class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Products Table -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <?php if(session('success')): ?>
                <div class="m-6 mb-0 p-4 bg-green-100 border border-green-200 text-green-700 rounded-lg">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Produk</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Kategori</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Harga</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Pemilik</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php $__empty_1 = true; $__currentLoopData = $produks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $produk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="w-16 h-16 rounded-lg overflow-hidden bg-gray-100 mr-4 flex-shrink-0">
                                            <?php if($produk->gambar_utama): ?>
                                                <img src="<?php echo e(Storage::url($produk->gambar_utama)); ?>"
                                                    alt="<?php echo e($produk->nama); ?>" class="w-full h-full object-cover">
                                            <?php else: ?>
                                                <div class="w-full h-full flex items-center justify-center">
                                                    <i class="fas fa-box text-2xl text-gray-300"></i>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-800"><?php echo e($produk->nama); ?></p>
                                            <p class="text-sm text-gray-500 line-clamp-1">
                                                <?php echo e(Str::limit($produk->deskripsi, 50)); ?></p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <span
                                        class="px-3 py-1 bg-gray-100 text-gray-700 text-sm font-medium rounded-full"><?php echo e($produk->kategori->nama ?? '-'); ?></span>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="font-semibold text-primary-600">Rp
                                        <?php echo e(number_format($produk->harga, 0, ',', '.')); ?></p>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-gray-800"><?php echo e($produk->pemilik ?? '-'); ?></p>
                                    <?php if($produk->kontak_pemilik): ?>
                                        <p class="text-sm text-gray-500"><?php echo e($produk->kontak_pemilik); ?></p>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php if($produk->is_active): ?>
                                        <span
                                            class="px-3 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-full">Aktif</span>
                                    <?php else: ?>
                                        <span
                                            class="px-3 py-1 bg-gray-100 text-gray-600 text-xs font-medium rounded-full">Nonaktif</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="<?php echo e(route('admin.produk.edit', $produk->id)); ?>"
                                            class="p-2 text-gray-500 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="<?php echo e(route('admin.produk.destroy', $produk->id)); ?>" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit"
                                                class="p-2 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition"
                                                title="Hapus">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <i class="fas fa-box-open text-4xl text-gray-300 mb-3"></i>
                                    <p class="text-gray-500">Belum ada produk UMKM.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <?php if($produks->hasPages()): ?>
                <div class="px-6 py-4 border-t border-gray-200">
                    <?php echo e($produks->withQueryString()->links()); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\website-desa-tanalum\resources\views/admin/produk/index.blade.php ENDPATH**/ ?>
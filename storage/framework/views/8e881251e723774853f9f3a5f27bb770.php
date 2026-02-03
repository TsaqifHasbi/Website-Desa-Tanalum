

<?php $__env->startSection('title', 'Manajemen Berita'); ?>

<?php $__env->startSection('content'); ?>
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Berita & Artikel</h1>
                <p class="text-gray-600">Kelola berita dan artikel desa</p>
            </div>
            <a href="<?php echo e(route('admin.berita.create')); ?>"
                class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition">
                <i class="fas fa-plus mr-2"></i>
                Tambah Berita
            </a>
        </div>

        <!-- Filters -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <form action="<?php echo e(route('admin.berita.index')); ?>" method="GET" class="grid md:grid-cols-5 gap-4">
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Cari</label>
                    <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Judul berita..."
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
                        <option value="published" <?php echo e(request('status') == 'published' ? 'selected' : ''); ?>>Dipublikasi
                        </option>
                        <option value="draft" <?php echo e(request('status') == 'draft' ? 'selected' : ''); ?>>Draft</option>
                    </select>
                </div>
                <div class="flex items-end gap-2">
                    <button type="submit"
                        class="px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition">
                        <i class="fas fa-search mr-1"></i> Filter
                    </button>
                    <a href="<?php echo e(route('admin.berita.index')); ?>"
                        class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition">
                        Reset
                    </a>
                </div>
            </form>
        </div>

        <!-- Berita Table -->
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
                                Berita</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Kategori</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Status</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Views</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Tanggal</th>
                            <th class="px-6 py-4 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        <?php $__empty_1 = true; $__currentLoopData = $beritas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $berita): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center">
                                        <div class="w-16 h-12 rounded-lg overflow-hidden bg-gray-100 mr-4 flex-shrink-0">
                                            <?php if($berita->gambar_utama): ?>
                                                <img src="<?php echo e(Storage::url($berita->gambar_utama)); ?>"
                                                    alt="<?php echo e($berita->judul); ?>" class="w-full h-full object-cover">
                                            <?php else: ?>
                                                <div class="w-full h-full flex items-center justify-center">
                                                    <i class="fas fa-newspaper text-gray-300"></i>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-800 line-clamp-1"><?php echo e($berita->judul); ?></p>
                                            <p class="text-sm text-gray-500"><?php echo e($berita->author->name ?? 'Admin'); ?></p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <?php if($berita->kategori): ?>
                                        <span
                                            class="px-3 py-1 bg-gray-100 text-gray-700 text-sm font-medium rounded-full"><?php echo e($berita->kategori->nama); ?></span>
                                    <?php else: ?>
                                        <span class="text-gray-400">-</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php if($berita->status == 'published'): ?>
                                        <span
                                            class="px-3 py-1 bg-green-100 text-green-700 text-xs font-medium rounded-full">Dipublikasi</span>
                                    <?php elseif($berita->status == 'archived'): ?>
                                        <span
                                            class="px-3 py-1 bg-gray-100 text-gray-700 text-xs font-medium rounded-full">Diarsipkan</span>
                                    <?php else: ?>
                                        <span
                                            class="px-3 py-1 bg-yellow-100 text-yellow-700 text-xs font-medium rounded-full">Draft</span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center text-gray-600">
                                        <i class="far fa-eye mr-1 text-sm"></i>
                                        <?php echo e(number_format($berita->views ?? 0)); ?>

                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="text-gray-800">
                                        <?php echo e($berita->published_at ? $berita->published_at->format('d M Y') : '-'); ?></p>
                                    <p class="text-sm text-gray-500">
                                        <?php echo e($berita->published_at ? $berita->published_at->format('H:i') : ''); ?></p>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="<?php echo e(route('berita.show', $berita->slug)); ?>" target="_blank"
                                            class="p-2 text-gray-500 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition"
                                            title="Lihat">
                                            <i class="fas fa-external-link-alt"></i>
                                        </a>
                                        <a href="<?php echo e(route('admin.berita.edit', $berita->id)); ?>"
                                            class="p-2 text-gray-500 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition"
                                            title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="<?php echo e(route('admin.berita.destroy', $berita->id)); ?>" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus berita ini?')">
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
                                    <i class="fas fa-newspaper text-4xl text-gray-300 mb-3"></i>
                                    <p class="text-gray-500">Belum ada berita.</p>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <?php if($beritas->hasPages()): ?>
                <div class="px-6 py-4 border-t border-gray-200">
                    <?php echo e($beritas->withQueryString()->links()); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\website-desa-tanalum\resources\views/admin/berita/index.blade.php ENDPATH**/ ?>
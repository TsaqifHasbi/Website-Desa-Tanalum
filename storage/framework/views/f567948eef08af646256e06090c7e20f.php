

<?php $__env->startSection('title', 'Kelola Aparatur Desa'); ?>

<?php $__env->startSection('content'); ?>
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Aparatur Desa</h1>
            <p class="text-gray-600">Kelola data aparatur dan perangkat desa</p>
        </div>
        <a href="<?php echo e(route('admin.aparatur.create')); ?>"
            class="inline-flex items-center px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
            <i class="fas fa-plus mr-2"></i>
            Tambah Aparatur
        </a>
    </div>

    <!-- Filter -->
    <div class="bg-white rounded-xl shadow-sm p-4 mb-6">
        <form action="" method="GET" class="flex flex-wrap gap-4 items-end">
            <div>
                <label class="block text-sm text-gray-600 mb-1">Jenis</label>
                <select name="jenis"
                    class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                    <option value="">Semua Jenis</option>
                    <option value="perangkat" <?php echo e(request('jenis') == 'perangkat' ? 'selected' : ''); ?>>Perangkat Desa
                    </option>
                    <option value="bpd" <?php echo e(request('jenis') == 'bpd' ? 'selected' : ''); ?>>BPD</option>
                    <option value="lpm" <?php echo e(request('jenis') == 'lpm' ? 'selected' : ''); ?>>LPM</option>
                    <option value="pkk" <?php echo e(request('jenis') == 'pkk' ? 'selected' : ''); ?>>PKK</option>
                    <option value="karang_taruna" <?php echo e(request('jenis') == 'karang_taruna' ? 'selected' : ''); ?>>Karang Taruna
                    </option>
                    <option value="lembaga_lain" <?php echo e(request('jenis') == 'lembaga_lain' ? 'selected' : ''); ?>>Lembaga Lain
                    </option>
                </select>
            </div>
            <div class="flex-1">
                <label class="block text-sm text-gray-600 mb-1">Cari</label>
                <input type="text" name="search" value="<?php echo e(request('search')); ?>"
                    placeholder="Cari nama, jabatan, NIP..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
            </div>
            <button type="submit" class="px-6 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                <i class="fas fa-search mr-2"></i>Filter
            </button>
        </form>
    </div>

    <!-- Aparatur List -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aparatur
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jabatan
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Status
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Urutan
                        </th>
                        <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                        </th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php $__empty_1 = true; $__currentLoopData = $aparaturs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $aparatur): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">
                                <div class="flex items-center">
                                    <div class="w-12 h-12 rounded-full overflow-hidden bg-gray-200 mr-4 flex-shrink-0">
                                        <?php if($aparatur->foto): ?>
                                            <img src="<?php echo e(Storage::url($aparatur->foto)); ?>" alt="<?php echo e($aparatur->nama); ?>"
                                                class="w-full h-full object-cover">
                                        <?php else: ?>
                                            <div class="w-full h-full flex items-center justify-center">
                                                <i class="fas fa-user text-gray-400"></i>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div>
                                        <p class="font-medium text-gray-900"><?php echo e($aparatur->nama); ?></p>
                                        <?php if($aparatur->nip): ?>
                                            <p class="text-sm text-gray-500">NIP: <?php echo e($aparatur->nip); ?></p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4">
                                <p class="text-gray-900"><?php echo e($aparatur->jabatan); ?></p>
                                <?php if($aparatur->masa_jabatan): ?>
                                    <p class="text-sm text-gray-500"><?php echo e($aparatur->masa_jabatan); ?></p>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4">
                                <?php switch($aparatur->jenis):
                                    case ('perangkat'): ?>
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">Perangkat
                                            Desa</span>
                                    <?php break; ?>

                                    <?php case ('bpd'): ?>
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">BPD</span>
                                    <?php break; ?>

                                    <?php case ('lpm'): ?>
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">LPM</span>
                                    <?php break; ?>

                                    <?php case ('pkk'): ?>
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-pink-100 text-pink-800">PKK</span>
                                    <?php break; ?>

                                    <?php case ('karang_taruna'): ?>
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">Karang
                                            Taruna</span>
                                    <?php break; ?>

                                    <?php default: ?>
                                        <span
                                            class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Lembaga
                                            Lain</span>
                                <?php endswitch; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <?php if($aparatur->is_active): ?>
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        Aktif
                                    </span>
                                <?php else: ?>
                                    <span
                                        class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                        Nonaktif
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 text-center text-gray-500">
                                <?php echo e($aparatur->urutan); ?>

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="<?php echo e(route('admin.aparatur.edit', $aparatur)); ?>"
                                        class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="<?php echo e(route('admin.aparatur.destroy', $aparatur)); ?>" method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus data aparatur ini?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg"
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
                                    <div class="flex flex-col items-center">
                                        <div class="bg-gray-100 rounded-full p-4 mb-4">
                                            <i class="fas fa-users text-gray-400 text-3xl"></i>
                                        </div>
                                        <p class="text-gray-500 font-medium">Belum ada data aparatur</p>
                                        <a href="<?php echo e(route('admin.aparatur.create')); ?>"
                                            class="mt-4 text-green-600 hover:text-green-700">
                                            <i class="fas fa-plus mr-1"></i>Tambah Aparatur
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>

            <?php if($aparaturs->hasPages()): ?>
                <div class="px-6 py-4 border-t border-gray-200">
                    <?php echo e($aparaturs->withQueryString()->links()); ?>

                </div>
            <?php endif; ?>
        </div>
    <?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\website-desa-tanalum\resources\views/admin/aparatur/index.blade.php ENDPATH**/ ?>
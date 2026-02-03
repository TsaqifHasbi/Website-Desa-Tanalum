

<?php $__env->startSection('title', 'Permohonan Informasi PPID'); ?>

<?php $__env->startSection('content'); ?>
    <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Permohonan Informasi</h1>
            <p class="text-gray-600">Daftar permohonan informasi publik dari masyarakat</p>
        </div>
    </div>

    <!-- Stats -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        <?php
            $statusCounts = [
                'menunggu' => $permohonans->where('status', 'menunggu')->count(),
                'diproses' => $permohonans->where('status', 'diproses')->count(),
                'selesai' => $permohonans->where('status', 'selesai')->count(),
                'ditolak' => $permohonans->where('status', 'ditolak')->count(),
            ];
        ?>
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Menunggu</p>
                    <p class="text-2xl font-bold text-yellow-600"><?php echo e($statusCounts['menunggu']); ?></p>
                </div>
                <div class="w-12 h-12 bg-yellow-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-clock text-yellow-600 text-xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Diproses</p>
                    <p class="text-2xl font-bold text-blue-600"><?php echo e($statusCounts['diproses']); ?></p>
                </div>
                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-spinner text-blue-600 text-xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Selesai</p>
                    <p class="text-2xl font-bold text-green-600"><?php echo e($statusCounts['selesai']); ?></p>
                </div>
                <div class="w-12 h-12 bg-green-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-check text-green-600 text-xl"></i>
                </div>
            </div>
        </div>
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm text-gray-500">Ditolak</p>
                    <p class="text-2xl font-bold text-red-600"><?php echo e($statusCounts['ditolak']); ?></p>
                </div>
                <div class="w-12 h-12 bg-red-100 rounded-lg flex items-center justify-center">
                    <i class="fas fa-times text-red-600 text-xl"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- Filter -->
    <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
        <form action="" method="GET" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Cari nama/email/nomor..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
            </div>
            <div>
                <select name="status"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                    <option value="">Semua Status</option>
                    <option value="menunggu" <?php echo e(request('status') == 'menunggu' ? 'selected' : ''); ?>>Menunggu</option>
                    <option value="diproses" <?php echo e(request('status') == 'diproses' ? 'selected' : ''); ?>>Diproses</option>
                    <option value="selesai" <?php echo e(request('status') == 'selesai' ? 'selected' : ''); ?>>Selesai</option>
                    <option value="ditolak" <?php echo e(request('status') == 'ditolak' ? 'selected' : ''); ?>>Ditolak</option>
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    <i class="fas fa-search"></i>
                </button>
                <a href="<?php echo e(route('admin.ppid.permohonan')); ?>"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No.
                            Permohonan</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pemohon
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Informasi
                            Diminta</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php $__empty_1 = true; $__currentLoopData = $permohonans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $permohonan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                <?php echo e($permohonan->nomor_permohonan); ?>

                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm font-medium text-gray-800"><?php echo e($permohonan->nama_pemohon); ?></div>
                                <div class="text-xs text-gray-500"><?php echo e($permohonan->email); ?></div>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-sm text-gray-600 line-clamp-2">
                                    <?php echo e(Str::limit($permohonan->informasi_diminta, 50)); ?></div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                <?php echo e($permohonan->created_at->format('d M Y')); ?>

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php
                                    $statusColors = [
                                        'menunggu' => 'yellow',
                                        'diproses' => 'blue',
                                        'selesai' => 'green',
                                        'ditolak' => 'red',
                                    ];
                                ?>
                                <span
                                    class="px-2 py-1 text-xs font-medium rounded-full bg-<?php echo e($statusColors[$permohonan->status] ?? 'gray'); ?>-100 text-<?php echo e($statusColors[$permohonan->status] ?? 'gray'); ?>-800">
                                    <?php echo e(ucfirst($permohonan->status)); ?>

                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="<?php echo e(route('admin.ppid.permohonan.show', $permohonan)); ?>"
                                    class="text-blue-600 hover:text-blue-800">
                                    <i class="fas fa-eye mr-1"></i>Detail
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-inbox text-4xl text-gray-300 mb-4"></i>
                                    <p>Belum ada permohonan informasi</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if($permohonans->hasPages()): ?>
            <div class="px-6 py-4 border-t border-gray-200">
                <?php echo e($permohonans->links()); ?>

            </div>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\website-desa-tanalum\resources\views/admin/ppid/permohonan.blade.php ENDPATH**/ ?>
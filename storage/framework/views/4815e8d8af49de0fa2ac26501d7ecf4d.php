

<?php $__env->startSection('title', 'Data Stunting'); ?>

<?php $__env->startSection('content'); ?>
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Data Stunting</h1>
                <p class="text-gray-600">Kelola data stunting desa</p>
            </div>
            <button type="button" onclick="document.getElementById('add-modal').classList.remove('hidden')"
                class="inline-flex items-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition">
                <i class="fas fa-plus mr-2"></i>
                Tambah Data
            </button>
        </div>

        <?php if(session('success')): ?>
            <div class="p-4 bg-green-100 border border-green-200 text-green-700 rounded-lg">
                <?php echo e(session('success')); ?>

            </div>
        <?php endif; ?>

        <!-- Table -->
        <div class="bg-white rounded-xl shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tahun
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Bulan
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Jumlah Balita</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Jumlah Stunting</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Gizi Buruk</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Gizi Kurang</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Persentase</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Catatan</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <?php $__empty_1 = true; $__currentLoopData = $stuntings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $stunting): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    <?php echo e($stuntings->firstItem() + $index); ?>

                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                    <?php echo e($stunting->tahun); ?>

                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?php echo e($stunting->bulan ? \Carbon\Carbon::create()->month($stunting->bulan)->format('F') : '-'); ?>

                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?php echo e(number_format($stunting->jumlah_balita)); ?>

                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?php echo e(number_format($stunting->jumlah_stunting)); ?>

                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?php echo e(number_format($stunting->jumlah_gizi_buruk ?? 0)); ?>

                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                    <?php echo e(number_format($stunting->jumlah_gizi_kurang ?? 0)); ?>

                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <?php
                                        $persentase =
                                            $stunting->jumlah_balita > 0
                                                ? ($stunting->jumlah_stunting / $stunting->jumlah_balita) * 100
                                                : 0;
                                    ?>
                                    <span
                                        class="px-2 py-1 text-xs font-medium <?php echo e($persentase > 20 ? 'bg-red-100 text-red-800' : ($persentase > 10 ? 'bg-yellow-100 text-yellow-800' : 'bg-green-100 text-green-800')); ?> rounded-full">
                                        <?php echo e(number_format($persentase, 1)); ?>%
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-sm text-gray-500 max-w-xs truncate" title="<?php echo e($stunting->catatan); ?>">
                                    <?php echo e(Str::limit($stunting->catatan, 30) ?? '-'); ?>

                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <button type="button" onclick="editStunting(<?php echo e(json_encode($stunting)); ?>)"
                                        class="text-blue-600 hover:text-blue-900 mr-3">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="<?php echo e(route('admin.data.stunting.destroy', $stunting->id)); ?>" method="POST"
                                        class="inline" onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                            <tr>
                                <td colspan="10" class="px-6 py-4 text-center text-gray-500">
                                    Belum ada data stunting
                                </td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
            <?php if($stuntings->hasPages()): ?>
                <div class="px-6 py-4 border-t border-gray-200">
                    <?php echo e($stuntings->links()); ?>

                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Add Modal -->
    <div id="add-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl max-w-lg w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Tambah Data Stunting</h3>
                    <button type="button" onclick="document.getElementById('add-modal').classList.add('hidden')"
                        class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <form action="<?php echo e(route('admin.data.stunting.store')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <div class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tahun *</label>
                                <input type="number" name="tahun" required min="2000" max="<?php echo e(date('Y') + 1); ?>"
                                    value="<?php echo e(date('Y')); ?>"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Bulan</label>
                                <select name="bulan"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                                    <option value="">Pilih Bulan</option>
                                    <?php for($i = 1; $i <= 12; $i++): ?>
                                        <option value="<?php echo e($i); ?>">
                                            <?php echo e(\Carbon\Carbon::create()->month($i)->format('F')); ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Balita *</label>
                                <input type="number" name="jumlah_balita" required min="0"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Stunting *</label>
                                <input type="number" name="jumlah_stunting" required min="0"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Gizi Buruk</label>
                                <input type="number" name="jumlah_gizi_buruk" min="0"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Gizi Kurang</label>
                                <input type="number" name="jumlah_gizi_kurang" min="0"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Catatan</label>
                            <textarea name="catatan" rows="3"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500"></textarea>
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end gap-3">
                        <button type="button" onclick="document.getElementById('add-modal').classList.add('hidden')"
                            class="px-4 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition">
                            Simpan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="edit-modal" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center p-4">
        <div class="bg-white rounded-xl max-w-lg w-full max-h-[90vh] overflow-y-auto">
            <div class="p-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-semibold text-gray-800">Edit Data Stunting</h3>
                    <button type="button" onclick="document.getElementById('edit-modal').classList.add('hidden')"
                        class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <form id="edit-form" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>
                    <div class="space-y-4">
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Tahun *</label>
                                <input type="number" name="tahun" id="edit-tahun" required min="2000"
                                    max="<?php echo e(date('Y') + 1); ?>"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Bulan</label>
                                <select name="bulan" id="edit-bulan"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                                    <option value="">Pilih Bulan</option>
                                    <?php for($i = 1; $i <= 12; $i++): ?>
                                        <option value="<?php echo e($i); ?>">
                                            <?php echo e(\Carbon\Carbon::create()->month($i)->format('F')); ?></option>
                                    <?php endfor; ?>
                                </select>
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Balita *</label>
                                <input type="number" name="jumlah_balita" id="edit-jumlah_balita" required
                                    min="0"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Stunting *</label>
                                <input type="number" name="jumlah_stunting" id="edit-jumlah_stunting" required
                                    min="0"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                            </div>
                        </div>
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Gizi Buruk</label>
                                <input type="number" name="jumlah_gizi_buruk" id="edit-jumlah_gizi_buruk"
                                    min="0"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Gizi Kurang</label>
                                <input type="number" name="jumlah_gizi_kurang" id="edit-jumlah_gizi_kurang"
                                    min="0"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Catatan</label>
                            <textarea name="catatan" id="edit-catatan" rows="3"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500"></textarea>
                        </div>
                    </div>
                    <div class="mt-6 flex justify-end gap-3">
                        <button type="button" onclick="document.getElementById('edit-modal').classList.add('hidden')"
                            class="px-4 py-2 text-gray-700 bg-gray-100 hover:bg-gray-200 rounded-lg transition">
                            Batal
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-green-600 hover:bg-green-700 text-white rounded-lg transition">
                            Update
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function editStunting(stunting) {
            document.getElementById('edit-form').action = '<?php echo e(url('admin/data/stunting')); ?>/' + stunting.id;
            document.getElementById('edit-tahun').value = stunting.tahun;
            document.getElementById('edit-bulan').value = stunting.bulan || '';
            document.getElementById('edit-jumlah_balita').value = stunting.jumlah_balita;
            document.getElementById('edit-jumlah_stunting').value = stunting.jumlah_stunting;
            document.getElementById('edit-jumlah_gizi_buruk').value = stunting.jumlah_gizi_buruk || '';
            document.getElementById('edit-jumlah_gizi_kurang').value = stunting.jumlah_gizi_kurang || '';
            document.getElementById('edit-catatan').value = stunting.catatan || '';
            document.getElementById('edit-modal').classList.remove('hidden');
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\website-desa-tanalum\resources\views/admin/data-desa/stunting.blade.php ENDPATH**/ ?>


<?php $__env->startSection('title', 'Data Bantuan Sosial'); ?>

<?php $__env->startSection('content'); ?>
    <div class="mb-6 flex flex-col md:flex-row md:items-center md:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Data Bantuan Sosial</h1>
            <p class="text-gray-600">Kelola data penerima bantuan sosial desa</p>
        </div>
        <div>
            <button type="button" onclick="openModal()"
                class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                <i class="fas fa-plus mr-2"></i>Tambah Penerima
            </button>
        </div>
    </div>

    <!-- Summary Cards -->
    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-<?php echo e(min(count($jenisBansosList), 6)); ?> gap-4 mb-8">
        <?php $__currentLoopData = $jenisBansosList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jenis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="bg-white rounded-xl shadow-sm p-4">
                <div class="flex items-center justify-between mb-2">
                    <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                        <i class="fas fa-hand-holding-heart text-green-600"></i>
                    </div>
                </div>
                <div class="text-2xl font-bold text-gray-800"><?php echo e($jenis->penerima_count ?? 0); ?></div>
                <div class="text-sm text-gray-500"><?php echo e($jenis->singkatan ?? $jenis->nama); ?></div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <!-- Filter & Search -->
    <div class="bg-white rounded-xl shadow-sm p-6 mb-6">
        <form action="" method="GET" class="flex flex-col md:flex-row gap-4">
            <div class="flex-1">
                <input type="text" name="search" value="<?php echo e(request('search')); ?>" placeholder="Cari nama atau NIK..."
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
            </div>
            <div>
                <select name="jenis"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                    <option value="">Semua Jenis</option>
                    <?php $__currentLoopData = $jenisBansosList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jenis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($jenis->id); ?>" <?php echo e(request('jenis') == $jenis->id ? 'selected' : ''); ?>>
                            <?php echo e($jenis->singkatan ?? $jenis->nama); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div>
                <select name="tahun"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                    <option value="">Semua Tahun</option>
                    <?php for($y = date('Y'); $y >= 2020; $y--): ?>
                        <option value="<?php echo e($y); ?>" <?php echo e(request('tahun') == $y ? 'selected' : ''); ?>>
                            <?php echo e($y); ?></option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                    <i class="fas fa-search mr-2"></i>Cari
                </button>
                <a href="<?php echo e(route('admin.data.bansos')); ?>"
                    class="px-4 py-2 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400">
                    Reset
                </a>
            </div>
        </form>
    </div>

    <!-- Data Table -->
    <div class="bg-white rounded-xl shadow-sm overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">NIK</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis
                            Bansos</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tahun
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    <?php $__empty_1 = true; $__currentLoopData = $penerimaBansos ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $penerima): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                <?php echo e(($penerimaBansos->currentPage() - 1) * $penerimaBansos->perPage() + $index + 1); ?>

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-800">
                                <?php echo e($penerima->nik); ?>

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-800">
                                <?php echo e($penerima->nama); ?>

                            </td>
                            <td class="px-6 py-4 text-sm text-gray-600">
                                <?php echo e(Str::limit($penerima->alamat, 30)); ?>

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php if($penerima->jenisBansos): ?>
                                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                        <?php echo e($penerima->jenisBansos->nama); ?>

                                    </span>
                                <?php else: ?>
                                    <span class="px-2 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-800">
                                        -
                                    </span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                <?php echo e($penerima->tahun_penerima); ?>

                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <?php if($penerima->status == 'aktif'): ?>
                                    <span
                                        class="px-2 py-1 text-xs font-medium rounded-full bg-green-100 text-green-800">Aktif</span>
                                <?php else: ?>
                                    <span
                                        class="px-2 py-1 text-xs font-medium rounded-full bg-red-100 text-red-800">Nonaktif</span>
                                <?php endif; ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <div class="flex items-center gap-2">
                                    <button onclick="editPenerima(<?php echo e($penerima->id); ?>)"
                                        class="text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <form action="<?php echo e(route('admin.data.bansos.penerima.destroy', $penerima)); ?>"
                                        method="POST" class="inline"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="text-red-600 hover:text-red-800">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <tr>
                            <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                                <div class="flex flex-col items-center">
                                    <i class="fas fa-inbox text-4xl text-gray-300 mb-4"></i>
                                    <p>Belum ada data penerima bansos</p>
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php if(isset($penerimaBansos) && $penerimaBansos->hasPages()): ?>
            <div class="px-6 py-4 border-t border-gray-200">
                <?php echo e($penerimaBansos->links()); ?>

            </div>
        <?php endif; ?>
    </div>

    <!-- Import Section -->
    <div class="bg-white rounded-xl shadow-sm p-6 mt-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">Import Data</h3>
        <form action="<?php echo e(route('admin.data.bansos.import')); ?>" method="POST" enctype="multipart/form-data"
            class="flex flex-col md:flex-row gap-4">
            <?php echo csrf_field(); ?>
            <div class="flex-1">
                <input type="file" name="file" accept=".xlsx,.xls,.csv" required
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                <p class="text-xs text-gray-500 mt-1">Format: Excel (.xlsx, .xls) atau CSV</p>
            </div>
            <div>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    <i class="fas fa-upload mr-2"></i>Import
                </button>
            </div>
            <div>
                <a href="#"
                    class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 inline-block">
                    <i class="fas fa-download mr-2"></i>Template
                </a>
            </div>
        </form>
    </div>

    <!-- Modal -->
    <div id="modal" class="fixed inset-0 bg-black/50 z-50 hidden items-center justify-center">
        <div class="bg-white rounded-xl shadow-xl max-w-lg w-full mx-4 max-h-[90vh] overflow-y-auto">
            <div class="p-6 border-b border-gray-200">
                <h3 class="text-xl font-semibold text-gray-800" id="modalTitle">Tambah Penerima Bansos</h3>
            </div>
            <form id="bansosForm" method="POST" class="p-6">
                <?php echo csrf_field(); ?>
                <div id="methodField"></div>

                <div class="grid gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">NIK <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="nik" id="nik" required maxlength="16"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nama <span
                                class="text-red-500">*</span></label>
                        <input type="text" name="nama" id="nama" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                        <textarea name="alamat" id="alamat" rows="2"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500"></textarea>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jenis Bansos <span
                                    class="text-red-500">*</span></label>
                            <select name="jenis_bansos_id" id="jenis_bansos_id" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                                <?php $__currentLoopData = $jenisBansosList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $jenis): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($jenis->id); ?>"><?php echo e($jenis->singkatan ?? $jenis->nama); ?></option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tahun <span
                                    class="text-red-500">*</span></label>
                            <select name="tahun_penerima" id="tahun_penerima" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-green-500 focus:border-green-500">
                                <?php for($y = date('Y'); $y >= 2020; $y--): ?>
                                    <option value="<?php echo e($y); ?>"><?php echo e($y); ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="status" id="status" value="aktif" checked
                                class="rounded border-gray-300 text-green-600 focus:ring-green-500 mr-2">
                            <span class="text-sm text-gray-700">Status Aktif</span>
                        </label>
                    </div>
                </div>

                <div class="flex justify-end gap-4 mt-6 pt-6 border-t border-gray-200">
                    <button type="button" onclick="closeModal()"
                        class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50">
                        Batal
                    </button>
                    <button type="submit" class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                        Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        function openModal() {
            document.getElementById('modal').classList.remove('hidden');
            document.getElementById('modal').classList.add('flex');
            document.getElementById('modalTitle').textContent = 'Tambah Penerima Bansos';
            document.getElementById('bansosForm').action = '<?php echo e(route('admin.data.bansos.penerima.store')); ?>';
            document.getElementById('methodField').innerHTML = '';
            document.getElementById('bansosForm').reset();
        }

        function closeModal() {
            document.getElementById('modal').classList.add('hidden');
            document.getElementById('modal').classList.remove('flex');
        }

        function editPenerima(id) {
            // Fetch data and populate form
            fetch('/admin/data/bansos/penerima/' + id + '/edit')
                .then(response => response.json())
                .then(data => {
                    document.getElementById('modal').classList.remove('hidden');
                    document.getElementById('modal').classList.add('flex');
                    document.getElementById('modalTitle').textContent = 'Edit Penerima Bansos';
                    document.getElementById('bansosForm').action = '/admin/data/bansos/penerima/' + id;
                    document.getElementById('methodField').innerHTML = '<?php echo method_field('PUT'); ?>';

                    document.getElementById('nik').value = data.nik;
                    document.getElementById('nama').value = data.nama;
                    document.getElementById('alamat').value = data.alamat || '';
                    document.getElementById('jenis_bansos_id').value = data.jenis_bansos_id;
                    document.getElementById('tahun_penerima').value = data.tahun_penerima;
                    document.getElementById('status').checked = data.status == 'aktif';
                });
        }

        // Close modal when clicking outside
        document.getElementById('modal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeModal();
            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\website-desa-tanalum\resources\views/admin/data-desa/bansos.blade.php ENDPATH**/ ?>
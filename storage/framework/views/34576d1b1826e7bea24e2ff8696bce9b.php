

<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-800">Dashboard</h1>
        <p class="text-gray-600">Selamat datang, <?php echo e(Auth::user()->name); ?>!</p>
    </div>

    <!-- Stats Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Total Berita</p>
                    <p class="text-3xl font-bold text-gray-800"><?php echo e($stats['total_berita']); ?></p>
                    <p class="text-sm text-green-600 mt-1">+<?php echo e($stats['berita_bulan_ini']); ?> bulan ini</p>
                </div>
                <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-newspaper text-2xl text-blue-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Produk UMKM</p>
                    <p class="text-3xl font-bold text-gray-800"><?php echo e($stats['total_produk']); ?></p>
                    <p class="text-sm text-gray-500 mt-1"><?php echo e($stats['produk_aktif']); ?> aktif</p>
                </div>
                <div class="w-14 h-14 bg-green-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-store text-2xl text-green-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Pengaduan</p>
                    <p class="text-3xl font-bold text-gray-800"><?php echo e($stats['total_pengaduan']); ?></p>
                    <?php if($stats['pengaduan_baru'] > 0): ?>
                        <p class="text-sm text-red-600 mt-1"><?php echo e($stats['pengaduan_baru']); ?> baru</p>
                    <?php else: ?>
                        <p class="text-sm text-gray-500 mt-1">Tidak ada pengaduan baru</p>
                    <?php endif; ?>
                </div>
                <div class="w-14 h-14 bg-orange-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-headset text-2xl text-orange-600"></i>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-medium text-gray-500">Dokumen PPID</p>
                    <p class="text-3xl font-bold text-gray-800"><?php echo e($stats['total_dokumen']); ?></p>
                    <?php if($stats['permohonan_baru'] > 0): ?>
                        <p class="text-sm text-red-600 mt-1"><?php echo e($stats['permohonan_baru']); ?> permohonan baru</p>
                    <?php else: ?>
                        <p class="text-sm text-gray-500 mt-1">Tidak ada permohonan baru</p>
                    <?php endif; ?>
                </div>
                <div class="w-14 h-14 bg-purple-100 rounded-xl flex items-center justify-center">
                    <i class="fas fa-file-alt text-2xl text-purple-600"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="grid lg:grid-cols-3 gap-6 mb-8">
        <!-- Data Penduduk Card -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-semibold text-gray-800">Data Penduduk</h3>
                <a href="<?php echo e(route('admin.data.penduduk')); ?>"
                    class="text-sm text-primary-600 hover:text-primary-700">Kelola</a>
            </div>
            <?php if($penduduk): ?>
                <div class="space-y-4">
                    <div class="flex justify-between items-center pb-3 border-b border-gray-100">
                        <span class="text-gray-600">Total Penduduk</span>
                        <span class="font-bold text-gray-800"><?php echo e(number_format($penduduk->jumlah_penduduk)); ?></span>
                    </div>
                    <div class="flex justify-between items-center pb-3 border-b border-gray-100">
                        <span class="text-gray-600">Laki-laki</span>
                        <span class="font-semibold text-blue-600"><?php echo e(number_format($penduduk->jumlah_laki_laki)); ?></span>
                    </div>
                    <div class="flex justify-between items-center pb-3 border-b border-gray-100">
                        <span class="text-gray-600">Perempuan</span>
                        <span class="font-semibold text-pink-600"><?php echo e(number_format($penduduk->jumlah_perempuan)); ?></span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600">Jumlah KK</span>
                        <span class="font-bold text-gray-800"><?php echo e(number_format($penduduk->jumlah_kk)); ?></span>
                    </div>
                </div>
            <?php else: ?>
                <div class="text-center py-8 text-gray-500">
                    <i class="fas fa-users text-3xl mb-2"></i>
                    <p>Belum ada data penduduk</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- APBDes Card -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-semibold text-gray-800">APBDes <?php echo e($apbdes ? $apbdes->tahun : date('Y')); ?></h3>
                <a href="<?php echo e(route('admin.data.apbdes')); ?>"
                    class="text-sm text-primary-600 hover:text-primary-700">Kelola</a>
            </div>
            <?php if($apbdes): ?>
                <div class="space-y-4">
                    <div class="pb-3 border-b border-gray-100">
                        <span class="text-sm text-gray-600">Total Pendapatan</span>
                        <p class="font-bold text-green-600">Rp <?php echo e(number_format($apbdes->total_pendapatan)); ?></p>
                    </div>
                    <div class="pb-3 border-b border-gray-100">
                        <span class="text-sm text-gray-600">Total Belanja</span>
                        <p class="font-bold text-red-600">Rp <?php echo e(number_format($apbdes->total_belanja)); ?></p>
                    </div>
                    <div>
                        <span class="text-sm text-gray-600">Surplus/Defisit</span>
                        <p class="font-bold <?php echo e($apbdes->surplus_defisit >= 0 ? 'text-green-600' : 'text-red-600'); ?>">
                            Rp <?php echo e(number_format($apbdes->surplus_defisit)); ?>

                        </p>
                    </div>
                </div>
            <?php else: ?>
                <div class="text-center py-8 text-gray-500">
                    <i class="fas fa-money-bill-wave text-3xl mb-2"></i>
                    <p>Belum ada data APBDes</p>
                </div>
            <?php endif; ?>
        </div>

        <!-- IDM Card -->
        <div class="bg-white rounded-xl shadow-sm p-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-semibold text-gray-800">IDM <?php echo e($idm ? $idm->tahun : date('Y')); ?></h3>
                <a href="<?php echo e(route('admin.data.idm')); ?>" class="text-sm text-primary-600 hover:text-primary-700">Kelola</a>
            </div>
            <?php if($idm): ?>
                <div class="text-center py-4">
                    <div class="text-4xl font-bold text-primary-600 mb-2"><?php echo e(number_format($idm->skor_idm, 4)); ?></div>
                    <span
                        class="inline-block px-4 py-1 rounded-full text-sm font-semibold <?php echo e($idm->status_idm === 'mandiri' ? 'bg-green-100 text-green-700' : ($idm->status_idm === 'maju' ? 'bg-blue-100 text-blue-700' : ($idm->status_idm === 'berkembang' ? 'bg-yellow-100 text-yellow-700' : 'bg-red-100 text-red-700'))); ?>">
                        <?php echo e(ucfirst(str_replace('_', ' ', $idm->status_idm))); ?>

                    </span>
                </div>
                <div class="grid grid-cols-3 gap-2 mt-4 pt-4 border-t border-gray-100">
                    <div class="text-center">
                        <p class="text-xs text-gray-500">IKS</p>
                        <p class="font-semibold text-gray-800"><?php echo e($idm->iks ? number_format($idm->iks, 4) : '-'); ?></p>
                    </div>
                    <div class="text-center">
                        <p class="text-xs text-gray-500">IKE</p>
                        <p class="font-semibold text-gray-800"><?php echo e($idm->ike ? number_format($idm->ike, 4) : '-'); ?></p>
                    </div>
                    <div class="text-center">
                        <p class="text-xs text-gray-500">IKL</p>
                        <p class="font-semibold text-gray-800"><?php echo e($idm->ikl ? number_format($idm->ikl, 4) : '-'); ?></p>
                    </div>
                </div>
            <?php else: ?>
                <div class="text-center py-8 text-gray-500">
                    <i class="fas fa-chart-line text-3xl mb-2"></i>
                    <p>Belum ada data IDM</p>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="grid lg:grid-cols-2 gap-6">
        <!-- Recent Berita -->
        <div class="bg-white rounded-xl shadow-sm">
            <div class="flex items-center justify-between p-6 border-b border-gray-100">
                <h3 class="font-semibold text-gray-800">Berita Terbaru</h3>
                <a href="<?php echo e(route('admin.berita.index')); ?>" class="text-sm text-primary-600 hover:text-primary-700">Lihat
                    Semua</a>
            </div>
            <div class="p-6">
                <?php $__empty_1 = true; $__currentLoopData = $recentBeritas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $berita): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div class="flex items-start space-x-4 <?php echo e(!$loop->last ? 'pb-4 mb-4 border-b border-gray-100' : ''); ?>">
                        <div class="w-16 h-16 rounded-lg overflow-hidden flex-shrink-0">
                            <?php if($berita->gambar_utama): ?>
                                <img src="<?php echo e(Storage::url($berita->gambar_utama)); ?>" alt="<?php echo e($berita->judul); ?>"
                                    class="w-full h-full object-cover">
                            <?php else: ?>
                                <div class="w-full h-full bg-gray-100 flex items-center justify-center">
                                    <i class="fas fa-newspaper text-gray-400"></i>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="font-medium text-gray-800 truncate"><?php echo e($berita->judul); ?></h4>
                            <p class="text-sm text-gray-500 mt-1"><?php echo e($berita->created_at->format('d M Y')); ?></p>
                        </div>
                        <span
                            class="px-2 py-1 text-xs rounded <?php echo e($berita->status === 'published' ? 'bg-green-100 text-green-700' : 'bg-yellow-100 text-yellow-700'); ?>">
                            <?php echo e(ucfirst($berita->status)); ?>

                        </span>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-newspaper text-3xl mb-2"></i>
                        <p>Belum ada berita</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <!-- Recent Pengaduan -->
        <div class="bg-white rounded-xl shadow-sm">
            <div class="flex items-center justify-between p-6 border-b border-gray-100">
                <h3 class="font-semibold text-gray-800">Pengaduan Terbaru</h3>
                <a href="<?php echo e(route('admin.pengaduan.index')); ?>"
                    class="text-sm text-primary-600 hover:text-primary-700">Lihat Semua</a>
            </div>
            <div class="p-6">
                <?php $__empty_1 = true; $__currentLoopData = $recentPengaduans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pengaduan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                    <div
                        class="flex items-start space-x-4 <?php echo e(!$loop->last ? 'pb-4 mb-4 border-b border-gray-100' : ''); ?>">
                        <div
                            class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 <?php echo e($pengaduan->status === 'baru' ? 'bg-red-100' : ($pengaduan->status === 'diproses' ? 'bg-yellow-100' : 'bg-green-100')); ?>">
                            <i
                                class="fas fa-headset <?php echo e($pengaduan->status === 'baru' ? 'text-red-600' : ($pengaduan->status === 'diproses' ? 'text-yellow-600' : 'text-green-600')); ?>"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="font-medium text-gray-800 truncate"><?php echo e($pengaduan->judul); ?></h4>
                            <p class="text-sm text-gray-500 mt-1"><?php echo e($pengaduan->nama); ?> -
                                <?php echo e($pengaduan->created_at->format('d M Y')); ?></p>
                        </div>
                        <span
                            class="px-2 py-1 text-xs rounded capitalize <?php echo e($pengaduan->status === 'baru' ? 'bg-red-100 text-red-700' : ($pengaduan->status === 'diproses' ? 'bg-yellow-100 text-yellow-700' : 'bg-green-100 text-green-700')); ?>">
                            <?php echo e($pengaduan->status); ?>

                        </span>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="text-center py-8 text-gray-500">
                        <i class="fas fa-headset text-3xl mb-2"></i>
                        <p>Belum ada pengaduan</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\website-desa-tanalum\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>
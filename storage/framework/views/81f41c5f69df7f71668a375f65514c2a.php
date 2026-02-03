

<?php $__env->startSection('title', 'APBDes'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Hero Section -->
    <section class="relative py-20 bg-gradient-to-r from-green-600 to-green-700">
        <div class="container mx-auto px-4">
            <div class="text-center text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">APBDes <?php echo e($apbdes->tahun ?? date('Y')); ?></h1>
                <p class="text-lg text-green-100">Anggaran Pendapatan dan Belanja <?php echo e($profil->nama_desa ?? 'Desa Tanalum'); ?>

                </p>
            </div>
        </div>
    </section>

    <!-- Breadcrumb -->
    <div class="bg-white shadow-sm">
        <div class="container mx-auto px-4">
            <nav class="flex items-center space-x-2 py-4 text-sm">
                <a href="<?php echo e(route('home')); ?>" class="text-gray-500 hover:text-primary-600">Beranda</a>
                <span class="text-gray-400">/</span>
                <a href="<?php echo e(route('infografis.index')); ?>" class="text-gray-500 hover:text-primary-600">Infografis</a>
                <span class="text-gray-400">/</span>
                <span class="text-primary-600 font-medium">APBDes</span>
            </nav>
        </div>
    </div>

    <!-- Tab Navigation -->
    <?php echo $__env->make('infografis.partials.tabs', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- Content -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <?php if($apbdes): ?>
                <!-- Year Selector -->
                <?php if($years->count() > 1): ?>
                    <div class="mb-8 flex justify-center" data-aos="fade-up">
                        <div class="inline-flex bg-white rounded-lg shadow-sm p-1">
                            <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('infografis.apbdes', ['tahun' => $year->tahun])); ?>"
                                    class="px-6 py-2 rounded-md transition <?php echo e($apbdes->tahun == $year->tahun ? 'bg-green-600 text-white' : 'text-gray-600 hover:bg-gray-100'); ?>">
                                    <?php echo e($year->tahun); ?>

                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Stats Overview -->
                <div class="grid md:grid-cols-3 gap-6 mb-12">
                    <div class="bg-gradient-to-br from-green-500 to-green-600 rounded-2xl p-6 text-white"
                        data-aos="fade-up">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                <i class="fas fa-arrow-down text-xl"></i>
                            </div>
                            <span class="text-green-100 text-sm">Pendapatan</span>
                        </div>
                        <p class="text-3xl font-bold">Rp <?php echo e(number_format($apbdes->total_pendapatan)); ?></p>
                    </div>
                    <div class="bg-gradient-to-br from-red-500 to-red-600 rounded-2xl p-6 text-white" data-aos="fade-up"
                        data-aos-delay="100">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                <i class="fas fa-arrow-up text-xl"></i>
                            </div>
                            <span class="text-red-100 text-sm">Belanja</span>
                        </div>
                        <p class="text-3xl font-bold">Rp <?php echo e(number_format($apbdes->total_belanja)); ?></p>
                    </div>
                    <div class="bg-gradient-to-br <?php echo e($apbdes->surplus_defisit >= 0 ? 'from-blue-500 to-blue-600' : 'from-orange-500 to-orange-600'); ?> rounded-2xl p-6 text-white"
                        data-aos="fade-up" data-aos-delay="200">
                        <div class="flex items-center justify-between mb-4">
                            <div class="w-12 h-12 bg-white/20 rounded-xl flex items-center justify-center">
                                <i class="fas fa-balance-scale text-xl"></i>
                            </div>
                            <span
                                class="text-white/80 text-sm"><?php echo e($apbdes->surplus_defisit >= 0 ? 'Surplus' : 'Defisit'); ?></span>
                        </div>
                        <p class="text-3xl font-bold">Rp <?php echo e(number_format(abs($apbdes->surplus_defisit))); ?></p>
                    </div>
                </div>

                <div class="grid lg:grid-cols-2 gap-8">
                    <!-- Pendapatan Chart -->
                    <div class="bg-white rounded-2xl shadow-sm p-6" data-aos="fade-up">
                        <h3 class="text-xl font-bold text-gray-800 mb-6">Rincian Pendapatan</h3>
                        <canvas id="pendapatanChart" height="300"></canvas>
                        <?php if($apbdes->rincian_pendapatan): ?>
                            <div class="mt-6 space-y-2">
                                <?php $__currentLoopData = $apbdes->rincian_pendapatan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item => $nilai): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                        <span class="text-gray-600"><?php echo e($item); ?></span>
                                        <span class="font-semibold text-gray-800">Rp <?php echo e(number_format($nilai)); ?></span>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Belanja Chart -->
                    <div class="bg-white rounded-2xl shadow-sm p-6" data-aos="fade-up" data-aos-delay="100">
                        <h3 class="text-xl font-bold text-gray-800 mb-6">Rincian Belanja</h3>
                        <canvas id="belanjaChart" height="300"></canvas>
                        <?php if($apbdes->rincian_belanja): ?>
                            <div class="mt-6 space-y-2">
                                <?php $__currentLoopData = $apbdes->rincian_belanja; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item => $nilai): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="flex justify-between items-center py-2 border-b border-gray-100">
                                        <span class="text-gray-600"><?php echo e($item); ?></span>
                                        <span class="font-semibold text-gray-800">Rp <?php echo e(number_format($nilai)); ?></span>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Pembiayaan -->
                <?php if($apbdes->pembiayaan_penerimaan || $apbdes->pembiayaan_pengeluaran): ?>
                    <div class="bg-white rounded-2xl shadow-sm p-6 mt-8" data-aos="fade-up">
                        <h3 class="text-xl font-bold text-gray-800 mb-6">Pembiayaan</h3>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <h4 class="font-semibold text-gray-700 mb-4">Penerimaan Pembiayaan</h4>
                                <p class="text-2xl font-bold text-green-600">Rp
                                    <?php echo e(number_format($apbdes->pembiayaan_penerimaan ?? 0)); ?></p>
                            </div>
                            <div>
                                <h4 class="font-semibold text-gray-700 mb-4">Pengeluaran Pembiayaan</h4>
                                <p class="text-2xl font-bold text-red-600">Rp
                                    <?php echo e(number_format($apbdes->pembiayaan_pengeluaran ?? 0)); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <p class="text-sm text-gray-500 mt-6 text-center">
                    <i class="fas fa-info-circle mr-1"></i>
                    Data terakhir diperbarui: <?php echo e($apbdes->updated_at->format('d M Y')); ?>

                </p>
            <?php else: ?>
                <div class="text-center py-16 bg-white rounded-2xl shadow-sm">
                    <i class="fas fa-money-bill-wave text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">Data Belum Tersedia</h3>
                    <p class="text-gray-500">Data APBDes belum diinput ke dalam sistem.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <?php if($apbdes): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Pendapatan Chart
                <?php
                    $pendapatan = $apbdes->rincian_pendapatan ?? ['Dana Desa' => $apbdes->total_pendapatan];
                ?>
                new Chart(document.getElementById('pendapatanChart'), {
                    type: 'doughnut',
                    data: {
                        labels: <?php echo json_encode(array_keys($pendapatan)); ?>,
                        datasets: [{
                            data: <?php echo json_encode(array_values($pendapatan)); ?>,
                            backgroundColor: ['#22C55E', '#3B82F6', '#F59E0B', '#EF4444', '#8B5CF6',
                                '#EC4899'
                            ],
                            borderWidth: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });

                // Belanja Chart
                <?php
                    $belanja = $apbdes->rincian_belanja ?? ['Belanja Desa' => $apbdes->total_belanja];
                ?>
                new Chart(document.getElementById('belanjaChart'), {
                    type: 'doughnut',
                    data: {
                        labels: <?php echo json_encode(array_keys($belanja)); ?>,
                        datasets: [{
                            data: <?php echo json_encode(array_values($belanja)); ?>,
                            backgroundColor: ['#EF4444', '#F59E0B', '#3B82F6', '#22C55E', '#8B5CF6',
                                '#EC4899'
                            ],
                            borderWidth: 0
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }
                });
            });
        </script>
    <?php endif; ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\website-desa-tanalum\resources\views/infografis/apbdes.blade.php ENDPATH**/ ?>
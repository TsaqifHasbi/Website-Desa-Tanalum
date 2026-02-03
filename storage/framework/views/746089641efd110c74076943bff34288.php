

<?php $__env->startSection('title', 'Bantuan Sosial'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Hero Section -->
    <section class="relative py-20 bg-gradient-to-r from-pink-600 to-pink-700">
        <div class="container mx-auto px-4">
            <div class="text-center text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Bantuan Sosial</h1>
                <p class="text-lg text-pink-100">Data Penerima Bantuan Tahun <?php echo e($tahun); ?> -
                    <?php echo e($profil->nama_desa ?? 'Desa Tanalum'); ?></p>
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
                <span class="text-primary-600 font-medium">Bantuan Sosial</span>
            </nav>
        </div>
    </div>

    <!-- Tab Navigation -->
    <?php echo $__env->make('infografis.partials.tabs', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- Content -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <?php if($dataBansos->count() > 0): ?>
                <!-- Year Selector -->
                <?php if($years->count() > 1): ?>
                    <div class="mb-8 flex justify-center" data-aos="fade-up">
                        <div class="inline-flex bg-white rounded-lg shadow-sm p-1">
                            <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $y): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('infografis.bansos', ['tahun' => $y])); ?>"
                                    class="px-6 py-2 rounded-md transition <?php echo e($tahun == $y ? 'bg-pink-600 text-white' : 'text-gray-600 hover:bg-gray-100'); ?>">
                                    <?php echo e($y); ?>

                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Stats Overview -->
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
                    <?php $__currentLoopData = $dataBansos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bansos): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="bg-white rounded-2xl shadow-sm p-6" data-aos="fade-up"
                            data-aos-delay="<?php echo e($loop->index * 100); ?>">
                            <div class="flex items-center justify-between mb-4">
                                <div class="w-12 h-12 bg-pink-100 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-hand-holding-heart text-xl text-pink-600"></i>
                                </div>
                                <span class="text-xs text-gray-400"><?php echo e($bansos->tahun); ?></span>
                            </div>
                            <h3 class="font-semibold text-gray-800 mb-1"><?php echo e($bansos->nama_program); ?></h3>
                            <p class="text-2xl font-bold text-pink-600"><?php echo e(number_format($bansos->jumlah_penerima)); ?></p>
                            <p class="text-sm text-gray-500">Penerima</p>
                            <?php if($bansos->total_anggaran): ?>
                                <p class="text-sm text-gray-600 mt-2">
                                    Anggaran: Rp <?php echo e(number_format($bansos->total_anggaran)); ?>

                                </p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!-- Chart -->
                <div class="bg-white rounded-2xl shadow-sm p-6 mb-8" data-aos="fade-up">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Distribusi Penerima Bantuan</h3>
                    <canvas id="bansosChart" height="300"></canvas>
                </div>
            <?php endif; ?>

            <!-- Cek Bansos Form -->
            <div class="bg-gradient-to-br from-teal-500 to-teal-600 rounded-2xl p-8 text-white" data-aos="fade-up">
                <div class="max-w-2xl mx-auto text-center">
                    <div class="w-16 h-16 bg-white/20 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-search text-3xl"></i>
                    </div>
                    <h2 class="text-2xl font-bold mb-4">Cek Status Penerima Bantuan</h2>
                    <p class="text-teal-100 mb-8">Masukkan NIK Anda untuk mengecek status penerimaan bantuan sosial.</p>

                    <form action="<?php echo e(route('cek-bansos')); ?>" method="GET" class="max-w-md mx-auto">
                        <div class="flex flex-col sm:flex-row gap-3">
                            <input type="text" name="nik" placeholder="Masukkan NIK (16 digit)"
                                class="flex-1 px-4 py-3 rounded-lg text-gray-800 focus:ring-2 focus:ring-white/50 focus:outline-none"
                                maxlength="16" pattern="[0-9]{16}">
                            <button type="submit"
                                class="px-6 py-3 bg-white text-teal-600 hover:bg-gray-100 font-semibold rounded-lg transition">
                                <i class="fas fa-search mr-2"></i>
                                Cek
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <?php if($dataBansos->isEmpty()): ?>
                <div class="text-center py-16 bg-white rounded-2xl shadow-sm mt-8">
                    <i class="fas fa-hand-holding-heart text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">Data Belum Tersedia</h3>
                    <p class="text-gray-500">Data bantuan sosial belum diinput ke dalam sistem.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <?php if($dataBansos->count() > 0): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                new Chart(document.getElementById('bansosChart'), {
                    type: 'bar',
                    data: {
                        labels: <?php echo json_encode($dataBansos->pluck('nama_program')); ?>,
                        datasets: [{
                            label: 'Jumlah Penerima',
                            data: <?php echo json_encode($dataBansos->pluck('jumlah_penerima')); ?>,
                            backgroundColor: ['#EC4899', '#8B5CF6', '#3B82F6', '#22C55E', '#F59E0B',
                                '#EF4444'
                            ]
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            });
        </script>
    <?php endif; ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\website-desa-tanalum\resources\views/infografis/bansos.blade.php ENDPATH**/ ?>
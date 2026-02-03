

<?php $__env->startSection('title', 'Demografi Desa - ' . ($profil->nama_desa ?? 'Desa Tanalum')); ?>

<?php $__env->startSection('content'); ?>
    <!-- Hero Section -->
    <section class="relative bg-gradient-to-br from-primary-600 to-primary-800 py-20">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center text-white">
                <nav class="flex items-center justify-center space-x-2 text-sm mb-4" data-aos="fade-down">
                    <a href="<?php echo e(route('home')); ?>" class="hover:text-primary-200">Beranda</a>
                    <span>/</span>
                    <a href="<?php echo e(route('profil.index')); ?>" class="hover:text-primary-200">Profil</a>
                    <span>/</span>
                    <span class="text-primary-200">Demografi</span>
                </nav>
                <h1 class="text-4xl md:text-5xl font-bold mb-4" data-aos="fade-up">Data Demografi</h1>
                <p class="text-lg text-primary-100 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">
                    Statistik kependudukan <?php echo e($profil->nama_desa ?? 'Desa Tanalum'); ?>

                </p>
            </div>
        </div>
        <div class="absolute bottom-0 left-0 right-0">
            <svg viewBox="0 0 1440 100" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill="white" d="M0,50 C360,100 1080,0 1440,50 L1440,100 L0,100 Z"></path>
            </svg>
        </div>
    </section>

    <!-- Statistics Overview -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <!-- Summary Cards -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-12">
                <div class="bg-white rounded-2xl shadow-sm p-6 text-center" data-aos="fade-up">
                    <div class="w-14 h-14 bg-blue-100 rounded-xl flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-users text-2xl text-blue-600"></i>
                    </div>
                    <p class="text-3xl font-bold text-gray-800"><?php echo e(number_format($statistik->total_penduduk ?? 0)); ?></p>
                    <p class="text-gray-500 text-sm mt-1">Total Penduduk</p>
                </div>

                <div class="bg-white rounded-2xl shadow-sm p-6 text-center" data-aos="fade-up" data-aos-delay="50">
                    <div class="w-14 h-14 bg-cyan-100 rounded-xl flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-male text-2xl text-cyan-600"></i>
                    </div>
                    <p class="text-3xl font-bold text-gray-800"><?php echo e(number_format($statistik->laki_laki ?? 0)); ?></p>
                    <p class="text-gray-500 text-sm mt-1">Laki-laki</p>
                </div>

                <div class="bg-white rounded-2xl shadow-sm p-6 text-center" data-aos="fade-up" data-aos-delay="100">
                    <div class="w-14 h-14 bg-pink-100 rounded-xl flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-female text-2xl text-pink-600"></i>
                    </div>
                    <p class="text-3xl font-bold text-gray-800"><?php echo e(number_format($statistik->perempuan ?? 0)); ?></p>
                    <p class="text-gray-500 text-sm mt-1">Perempuan</p>
                </div>

                <div class="bg-white rounded-2xl shadow-sm p-6 text-center" data-aos="fade-up" data-aos-delay="150">
                    <div class="w-14 h-14 bg-amber-100 rounded-xl flex items-center justify-center mx-auto mb-4">
                        <i class="fas fa-home text-2xl text-amber-600"></i>
                    </div>
                    <p class="text-3xl font-bold text-gray-800"><?php echo e(number_format($statistik->jumlah_kk ?? 0)); ?></p>
                    <p class="text-gray-500 text-sm mt-1">Kepala Keluarga</p>
                </div>
            </div>

            <div class="grid lg:grid-cols-2 gap-8">
                <!-- Gender Distribution -->
                <div class="bg-white rounded-2xl shadow-sm p-6" data-aos="fade-right">
                    <h3 class="font-bold text-gray-800 mb-6">Distribusi Jenis Kelamin</h3>
                    <div class="flex items-center justify-center">
                        <canvas id="genderChart" height="250"></canvas>
                    </div>
                    <div class="grid grid-cols-2 gap-4 mt-6">
                        <div class="flex items-center">
                            <span class="w-4 h-4 bg-cyan-500 rounded-full mr-3"></span>
                            <div>
                                <p class="text-sm text-gray-500">Laki-laki</p>
                                <p class="font-semibold text-gray-800">
                                    <?php echo e($statistik->total_penduduk > 0 ? round(($statistik->laki_laki / $statistik->total_penduduk) * 100, 1) : 0); ?>%
                                </p>
                            </div>
                        </div>
                        <div class="flex items-center">
                            <span class="w-4 h-4 bg-pink-500 rounded-full mr-3"></span>
                            <div>
                                <p class="text-sm text-gray-500">Perempuan</p>
                                <p class="font-semibold text-gray-800">
                                    <?php echo e($statistik->total_penduduk > 0 ? round(($statistik->perempuan / $statistik->total_penduduk) * 100, 1) : 0); ?>%
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Age Distribution -->
                <div class="bg-white rounded-2xl shadow-sm p-6" data-aos="fade-left">
                    <h3 class="font-bold text-gray-800 mb-6">Distribusi Usia</h3>
                    <canvas id="ageChart" height="250"></canvas>
                </div>
            </div>

            <!-- Additional Statistics -->
            <div class="grid lg:grid-cols-3 gap-8 mt-8">
                <!-- Education -->
                <div class="bg-white rounded-2xl shadow-sm p-6" data-aos="fade-up">
                    <h3 class="font-bold text-gray-800 mb-6">
                        <i class="fas fa-graduation-cap text-primary-600 mr-2"></i>
                        Tingkat Pendidikan
                    </h3>
                    <div class="space-y-4">
                        <?php
                            $pendidikan = [
                                ['label' => 'Tidak/Belum Sekolah', 'value' => $statistik->tidak_sekolah ?? 0],
                                ['label' => 'SD/Sederajat', 'value' => $statistik->sd ?? 0],
                                ['label' => 'SMP/Sederajat', 'value' => $statistik->smp ?? 0],
                                ['label' => 'SMA/Sederajat', 'value' => $statistik->sma ?? 0],
                                ['label' => 'D1-D3', 'value' => $statistik->diploma ?? 0],
                                ['label' => 'S1/Sederajat', 'value' => $statistik->sarjana ?? 0],
                                ['label' => 'S2/S3', 'value' => $statistik->pascasarjana ?? 0],
                            ];
                            $totalPendidikan = array_sum(array_column($pendidikan, 'value'));
                        ?>
                        <?php $__currentLoopData = $pendidikan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="text-gray-600"><?php echo e($item['label']); ?></span>
                                    <span class="font-medium text-gray-800"><?php echo e(number_format($item['value'])); ?></span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-primary-500 h-2 rounded-full"
                                        style="width: <?php echo e($totalPendidikan > 0 ? ($item['value'] / $totalPendidikan) * 100 : 0); ?>%">
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                <!-- Occupation -->
                <div class="bg-white rounded-2xl shadow-sm p-6" data-aos="fade-up" data-aos-delay="100">
                    <h3 class="font-bold text-gray-800 mb-6">
                        <i class="fas fa-briefcase text-primary-600 mr-2"></i>
                        Mata Pencaharian
                    </h3>
                    <div class="space-y-4">
                        <?php
                            $pekerjaan = [
                                ['label' => 'Petani', 'value' => $statistik->petani ?? 0],
                                ['label' => 'Nelayan', 'value' => $statistik->nelayan ?? 0],
                                ['label' => 'Pedagang', 'value' => $statistik->pedagang ?? 0],
                                ['label' => 'PNS/TNI/Polri', 'value' => $statistik->pns ?? 0],
                                ['label' => 'Karyawan Swasta', 'value' => $statistik->karyawan ?? 0],
                                ['label' => 'Wiraswasta', 'value' => $statistik->wiraswasta ?? 0],
                                ['label' => 'Lainnya', 'value' => $statistik->pekerjaan_lain ?? 0],
                            ];
                            $totalPekerjaan = array_sum(array_column($pekerjaan, 'value'));
                        ?>
                        <?php $__currentLoopData = $pekerjaan; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="text-gray-600"><?php echo e($item['label']); ?></span>
                                    <span class="font-medium text-gray-800"><?php echo e(number_format($item['value'])); ?></span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-amber-500 h-2 rounded-full"
                                        style="width: <?php echo e($totalPekerjaan > 0 ? ($item['value'] / $totalPekerjaan) * 100 : 0); ?>%">
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>

                <!-- Religion -->
                <div class="bg-white rounded-2xl shadow-sm p-6" data-aos="fade-up" data-aos-delay="200">
                    <h3 class="font-bold text-gray-800 mb-6">
                        <i class="fas fa-pray text-primary-600 mr-2"></i>
                        Agama
                    </h3>
                    <div class="space-y-4">
                        <?php
                            $agama = [
                                ['label' => 'Islam', 'value' => $statistik->islam ?? 0],
                                ['label' => 'Kristen', 'value' => $statistik->kristen ?? 0],
                                ['label' => 'Katolik', 'value' => $statistik->katolik ?? 0],
                                ['label' => 'Hindu', 'value' => $statistik->hindu ?? 0],
                                ['label' => 'Buddha', 'value' => $statistik->buddha ?? 0],
                                ['label' => 'Konghucu', 'value' => $statistik->konghucu ?? 0],
                            ];
                            $totalAgama = array_sum(array_column($agama, 'value'));
                        ?>
                        <?php $__currentLoopData = $agama; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="text-gray-600"><?php echo e($item['label']); ?></span>
                                    <span class="font-medium text-gray-800"><?php echo e(number_format($item['value'])); ?></span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-green-500 h-2 rounded-full"
                                        style="width: <?php echo e($totalAgama > 0 ? ($item['value'] / $totalAgama) * 100 : 0); ?>%">
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>

            <!-- Dusun Statistics -->
            <?php if($dusuns->count() > 0): ?>
                <div class="mt-12">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center" data-aos="fade-up">
                        Statistik Per Dusun
                    </h2>
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <?php $__currentLoopData = $dusuns; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $dusun): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="bg-white rounded-2xl shadow-sm p-6" data-aos="fade-up"
                                data-aos-delay="<?php echo e($index * 50); ?>">
                                <h4 class="font-bold text-gray-800 mb-4"><?php echo e($dusun->nama); ?></h4>
                                <div class="space-y-3">
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">Jumlah RT</span>
                                        <span class="font-semibold"><?php echo e($dusun->jumlah_rt ?? '-'); ?></span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">Jumlah KK</span>
                                        <span class="font-semibold"><?php echo e(number_format($dusun->jumlah_kk ?? 0)); ?></span>
                                    </div>
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">Penduduk</span>
                                        <span
                                            class="font-semibold"><?php echo e(number_format($dusun->jumlah_penduduk ?? 0)); ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Navigation -->
            <div class="flex justify-between items-center mt-12" data-aos="fade-up">
                <a href="<?php echo e(route('profil.peta')); ?>"
                    class="inline-flex items-center px-6 py-3 border border-gray-300 text-gray-700 hover:bg-gray-50 rounded-lg transition">
                    <i class="fas fa-arrow-left mr-2"></i>
                    Peta Desa
                </a>
                <a href="<?php echo e(route('infografis.penduduk')); ?>"
                    class="inline-flex items-center px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white rounded-lg transition">
                    Infografis Penduduk
                    <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Gender Chart
        const genderCtx = document.getElementById('genderChart').getContext('2d');
        new Chart(genderCtx, {
            type: 'doughnut',
            data: {
                labels: ['Laki-laki', 'Perempuan'],
                datasets: [{
                    data: [<?php echo e($statistik->laki_laki ?? 0); ?>, <?php echo e($statistik->perempuan ?? 0); ?>],
                    backgroundColor: ['#06b6d4', '#ec4899'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                cutout: '65%'
            }
        });

        // Age Chart
        const ageCtx = document.getElementById('ageChart').getContext('2d');
        new Chart(ageCtx, {
            type: 'bar',
            data: {
                labels: ['0-5', '6-12', '13-17', '18-25', '26-40', '41-60', '60+'],
                datasets: [{
                    label: 'Jumlah',
                    data: [
                        <?php echo e($statistik->usia_0_5 ?? 0); ?>,
                        <?php echo e($statistik->usia_6_12 ?? 0); ?>,
                        <?php echo e($statistik->usia_13_17 ?? 0); ?>,
                        <?php echo e($statistik->usia_18_25 ?? 0); ?>,
                        <?php echo e($statistik->usia_26_40 ?? 0); ?>,
                        <?php echo e($statistik->usia_41_60 ?? 0); ?>,
                        <?php echo e($statistik->usia_60_plus ?? 0); ?>

                    ],
                    backgroundColor: '#16a34a',
                    borderRadius: 6
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
                        beginAtZero: true,
                        grid: {
                            display: true,
                            drawBorder: false
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\website-desa-tanalum\resources\views/profil/demografi.blade.php ENDPATH**/ ?>
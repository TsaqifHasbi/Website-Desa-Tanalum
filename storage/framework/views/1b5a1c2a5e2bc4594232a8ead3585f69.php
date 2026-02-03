

<?php $__env->startSection('title', 'SDGs Desa'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Hero Section -->
    <section class="relative py-20 bg-gradient-to-r from-orange-600 to-orange-700">
        <div class="container mx-auto px-4">
            <div class="text-center text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">SDGs Desa</h1>
                <p class="text-lg text-orange-100">Sustainable Development Goals <?php echo e($profil->nama_desa ?? 'Desa Tanalum'); ?>

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
                <span class="text-primary-600 font-medium">SDGs Desa</span>
            </nav>
        </div>
    </div>

    <!-- Tab Navigation -->
    <?php echo $__env->make('infografis.partials.tabs', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- Content -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <?php if($sdgs): ?>
                <!-- Overall Score -->
                <div class="bg-white rounded-2xl shadow-sm p-8 mb-8 text-center" data-aos="fade-up">
                    <p class="text-gray-500 mb-2">Skor SDGs Desa <?php echo e($sdgs->tahun); ?></p>
                    <p class="text-6xl font-bold text-orange-600 mb-4"><?php echo e(number_format($sdgs->skor_sdgs, 2)); ?></p>
                    <div class="w-full bg-gray-200 rounded-full h-4 max-w-md mx-auto">
                        <div class="bg-gradient-to-r from-orange-500 to-orange-600 h-4 rounded-full transition-all duration-500"
                            style="width: <?php echo e(min($sdgs->skor_sdgs, 100)); ?>%"></div>
                    </div>
                    <p class="text-sm text-gray-500 mt-2">Dari skala 0-100</p>
                </div>

                <!-- SDGs Goals Grid -->
                <?php
                    $goals = [
                        1 => ['title' => 'Tanpa Kemiskinan', 'color' => '#E5243B', 'icon' => 'fa-hand-holding-usd'],
                        2 => ['title' => 'Tanpa Kelaparan', 'color' => '#DDA63A', 'icon' => 'fa-utensils'],
                        3 => ['title' => 'Kehidupan Sehat', 'color' => '#4C9F38', 'icon' => 'fa-heartbeat'],
                        4 => ['title' => 'Pendidikan Berkualitas', 'color' => '#C5192D', 'icon' => 'fa-graduation-cap'],
                        5 => ['title' => 'Kesetaraan Gender', 'color' => '#FF3A21', 'icon' => 'fa-venus-mars'],
                        6 => ['title' => 'Air Bersih & Sanitasi', 'color' => '#26BDE2', 'icon' => 'fa-tint'],
                        7 => ['title' => 'Energi Bersih', 'color' => '#FCC30B', 'icon' => 'fa-bolt'],
                        8 => ['title' => 'Pertumbuhan Ekonomi', 'color' => '#A21942', 'icon' => 'fa-chart-line'],
                        9 => ['title' => 'Infrastruktur', 'color' => '#FD6925', 'icon' => 'fa-industry'],
                        10 => [
                            'title' => 'Berkurangnya Ketimpangan',
                            'color' => '#DD1367',
                            'icon' => 'fa-balance-scale',
                        ],
                        11 => ['title' => 'Kota & Permukiman', 'color' => '#FD9D24', 'icon' => 'fa-city'],
                        12 => ['title' => 'Konsumsi Berkelanjutan', 'color' => '#BF8B2E', 'icon' => 'fa-recycle'],
                        13 => ['title' => 'Penanganan Iklim', 'color' => '#3F7E44', 'icon' => 'fa-cloud-sun'],
                        14 => ['title' => 'Ekosistem Laut', 'color' => '#0A97D9', 'icon' => 'fa-fish'],
                        15 => ['title' => 'Ekosistem Daratan', 'color' => '#56C02B', 'icon' => 'fa-tree'],
                        16 => [
                            'title' => 'Perdamaian & Keadilan',
                            'color' => '#00689D',
                            'icon' => 'fa-balance-scale-right',
                        ],
                        17 => ['title' => 'Kemitraan', 'color' => '#19486A', 'icon' => 'fa-handshake'],
                        18 => ['title' => 'Kelembagaan Desa', 'color' => '#8F1838', 'icon' => 'fa-landmark'],
                    ];
                    $skorGoals = $sdgs->skor_per_tujuan ?? [];
                ?>

                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4 mb-12">
                    <?php $__currentLoopData = $goals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $num => $goal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="rounded-xl p-4 text-white text-center hover:scale-105 transition-transform cursor-pointer"
                            style="background-color: <?php echo e($goal['color']); ?>" data-aos="fade-up"
                            data-aos-delay="<?php echo e(($num - 1) * 30); ?>">
                            <div class="text-2xl font-bold mb-2"><?php echo e($num); ?></div>
                            <i class="fas <?php echo e($goal['icon']); ?> text-xl mb-2 opacity-80"></i>
                            <p class="text-xs leading-tight opacity-90"><?php echo e($goal['title']); ?></p>
                            <?php if(isset($skorGoals[$num])): ?>
                                <div class="mt-2 pt-2 border-t border-white/30">
                                    <span class="font-bold"><?php echo e(number_format($skorGoals[$num], 1)); ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!-- Detail Scores Chart -->
                <?php if($skorGoals && count($skorGoals) > 0): ?>
                    <div class="bg-white rounded-2xl shadow-sm p-6 mb-8" data-aos="fade-up">
                        <h3 class="text-xl font-bold text-gray-800 mb-6">Capaian per Tujuan SDGs</h3>
                        <canvas id="sdgsChart" height="400"></canvas>
                    </div>
                <?php endif; ?>

                <!-- About SDGs -->
                <div class="bg-white rounded-2xl shadow-sm p-6" data-aos="fade-up">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Tentang SDGs Desa</h3>
                    <div class="prose max-w-none text-gray-600">
                        <p>SDGs Desa adalah upaya pencapaian Tujuan Pembangunan Berkelanjutan (Sustainable Development
                            Goals) di tingkat desa. SDGs Desa terdiri dari 18 tujuan yang mencakup:</p>
                        <ul>
                            <li><strong>Tujuan 1-17:</strong> Mengadaptasi 17 Tujuan Pembangunan Berkelanjutan global ke
                                dalam konteks pembangunan desa</li>
                            <li><strong>Tujuan 18:</strong> Kelembagaan desa dinamis dan budaya desa adaptif - tujuan khusus
                                untuk pembangunan desa di Indonesia</li>
                        </ul>
                        <p>Capaian SDGs Desa diukur melalui berbagai indikator yang mencerminkan kondisi dan kemajuan
                            pembangunan di berbagai bidang.</p>
                    </div>
                </div>

                <p class="text-sm text-gray-500 mt-6 text-center">
                    <i class="fas fa-info-circle mr-1"></i>
                    Data terakhir diperbarui: <?php echo e($sdgs->updated_at->format('d M Y')); ?>

                </p>
            <?php else: ?>
                <div class="text-center py-16 bg-white rounded-2xl shadow-sm">
                    <i class="fas fa-globe text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">Data Belum Tersedia</h3>
                    <p class="text-gray-500">Data SDGs Desa belum diinput ke dalam sistem.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <?php if($sdgs && isset($skorGoals) && count($skorGoals) > 0): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const labels = [];
                const data = [];
                const colors = ['#E5243B', '#DDA63A', '#4C9F38', '#C5192D', '#FF3A21', '#26BDE2', '#FCC30B', '#A21942',
                    '#FD6925', '#DD1367', '#FD9D24', '#BF8B2E', '#3F7E44', '#0A97D9', '#56C02B', '#00689D',
                    '#19486A', '#8F1838'
                ];

                <?php $__currentLoopData = $skorGoals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $num => $skor): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    labels.push('Tujuan <?php echo e($num); ?>');
                    data.push(<?php echo e($skor); ?>);
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                new Chart(document.getElementById('sdgsChart'), {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            label: 'Skor',
                            data: data,
                            backgroundColor: colors.slice(0, data.length)
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
                                max: 100
                            },
                            x: {
                                ticks: {
                                    maxRotation: 45
                                }
                            }
                        }
                    }
                });
            });
        </script>
    <?php endif; ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\website-desa-tanalum\resources\views/infografis/sdgs.blade.php ENDPATH**/ ?>


<?php $__env->startSection('title', 'IDM - Indeks Desa Membangun'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Hero Section -->
    <section class="relative py-20 bg-gradient-to-r from-purple-600 to-purple-700">
        <div class="container mx-auto px-4">
            <div class="text-center text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Indeks Desa Membangun</h1>
                <p class="text-lg text-purple-100">Tahun <?php echo e($idm->tahun ?? date('Y')); ?> -
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
                <span class="text-primary-600 font-medium">IDM</span>
            </nav>
        </div>
    </div>

    <!-- Tab Navigation -->
    <?php echo $__env->make('infografis.partials.tabs', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <!-- Content -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <?php if($idm): ?>
                <!-- Year Selector -->
                <?php if($years->count() > 1): ?>
                    <div class="mb-8 flex justify-center" data-aos="fade-up">
                        <div class="inline-flex bg-white rounded-lg shadow-sm p-1">
                            <?php $__currentLoopData = $years; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $year): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('infografis.idm', ['tahun' => $year->tahun])); ?>"
                                    class="px-6 py-2 rounded-md transition <?php echo e($idm->tahun == $year->tahun ? 'bg-purple-600 text-white' : 'text-gray-600 hover:bg-gray-100'); ?>">
                                    <?php echo e($year->tahun); ?>

                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Main IDM Score -->
                <div class="bg-white rounded-2xl shadow-sm p-8 mb-8 text-center" data-aos="fade-up">
                    <p class="text-gray-500 mb-2">Skor IDM</p>
                    <p class="text-6xl font-bold text-purple-600 mb-4"><?php echo e(number_format($idm->skor_idm, 4)); ?></p>
                    <?php
                        $statusColors = [
                            'mandiri' => 'bg-green-100 text-green-700',
                            'maju' => 'bg-blue-100 text-blue-700',
                            'berkembang' => 'bg-yellow-100 text-yellow-700',
                            'tertinggal' => 'bg-orange-100 text-orange-700',
                            'sangat_tertinggal' => 'bg-red-100 text-red-700',
                        ];
                    ?>
                    <span
                        class="inline-block px-6 py-2 rounded-full text-lg font-semibold <?php echo e($statusColors[$idm->status_idm] ?? 'bg-gray-100 text-gray-700'); ?>">
                        DESA <?php echo e(strtoupper(str_replace('_', ' ', $idm->status_idm))); ?>

                    </span>
                </div>

                <!-- IDM Components -->
                <div class="grid md:grid-cols-3 gap-6 mb-12">
                    <div class="bg-white rounded-2xl shadow-sm p-6" data-aos="fade-up">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-users text-2xl text-blue-600"></i>
                            </div>
                            <h3 class="font-semibold text-gray-700 mb-2">IKS</h3>
                            <p class="text-sm text-gray-500 mb-4">Indeks Ketahanan Sosial</p>
                            <p class="text-4xl font-bold text-blue-600"><?php echo e($idm->iks ? number_format($idm->iks, 4) : '-'); ?>

                            </p>
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl shadow-sm p-6" data-aos="fade-up" data-aos-delay="100">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-chart-line text-2xl text-green-600"></i>
                            </div>
                            <h3 class="font-semibold text-gray-700 mb-2">IKE</h3>
                            <p class="text-sm text-gray-500 mb-4">Indeks Ketahanan Ekonomi</p>
                            <p class="text-4xl font-bold text-green-600">
                                <?php echo e($idm->ike ? number_format($idm->ike, 4) : '-'); ?></p>
                        </div>
                    </div>
                    <div class="bg-white rounded-2xl shadow-sm p-6" data-aos="fade-up" data-aos-delay="200">
                        <div class="text-center">
                            <div class="w-16 h-16 bg-orange-100 rounded-full flex items-center justify-center mx-auto mb-4">
                                <i class="fas fa-tree text-2xl text-orange-600"></i>
                            </div>
                            <h3 class="font-semibold text-gray-700 mb-2">IKL</h3>
                            <p class="text-sm text-gray-500 mb-4">Indeks Ketahanan Lingkungan</p>
                            <p class="text-4xl font-bold text-orange-600">
                                <?php echo e($idm->ikl ? number_format($idm->ikl, 4) : '-'); ?></p>
                        </div>
                    </div>
                </div>

                <!-- Chart -->
                <div class="bg-white rounded-2xl shadow-sm p-6 mb-8" data-aos="fade-up">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Visualisasi Komponen IDM</h3>
                    <canvas id="idmChart" height="200"></canvas>
                </div>

                <!-- IDM Explanation -->
                <div class="bg-white rounded-2xl shadow-sm p-6" data-aos="fade-up">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Tentang IDM</h3>
                    <div class="prose max-w-none text-gray-600">
                        <p>Indeks Desa Membangun (IDM) merupakan indeks komposit yang dibentuk dari tiga dimensi utama:</p>
                        <ul>
                            <li><strong>Indeks Ketahanan Sosial (IKS)</strong> - mengukur ketahanan sosial desa melalui
                                indikator kesehatan, pendidikan, modal sosial, dan pemukiman.</li>
                            <li><strong>Indeks Ketahanan Ekonomi (IKE)</strong> - mengukur ketahanan ekonomi desa melalui
                                indikator keragaman produksi, akses distribusi/logistik, akses kredit, dan lembaga ekonomi.
                            </li>
                            <li><strong>Indeks Ketahanan Lingkungan (IKL)</strong> - mengukur ketahanan ekologi desa melalui
                                indikator kualitas lingkungan dan potensi bencana.</li>
                        </ul>

                        <h4>Klasifikasi Status Desa</h4>
                        <table class="w-full">
                            <thead>
                                <tr>
                                    <th class="text-left">Status</th>
                                    <th class="text-left">Nilai IDM</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span class="px-2 py-1 bg-green-100 text-green-700 rounded text-sm">Mandiri</span>
                                    </td>
                                    <td>> 0.8155</td>
                                </tr>
                                <tr>
                                    <td><span class="px-2 py-1 bg-blue-100 text-blue-700 rounded text-sm">Maju</span></td>
                                    <td>0.7072 - 0.8155</td>
                                </tr>
                                <tr>
                                    <td><span
                                            class="px-2 py-1 bg-yellow-100 text-yellow-700 rounded text-sm">Berkembang</span>
                                    </td>
                                    <td>0.5989 - 0.7072</td>
                                </tr>
                                <tr>
                                    <td><span
                                            class="px-2 py-1 bg-orange-100 text-orange-700 rounded text-sm">Tertinggal</span>
                                    </td>
                                    <td>0.4907 - 0.5989</td>
                                </tr>
                                <tr>
                                    <td><span class="px-2 py-1 bg-red-100 text-red-700 rounded text-sm">Sangat
                                            Tertinggal</span></td>
                                    <td>≤ 0.4907</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <p class="text-sm text-gray-500 mt-6 text-center">
                    <i class="fas fa-info-circle mr-1"></i>
                    Data terakhir diperbarui: <?php echo e($idm->updated_at->format('d M Y')); ?>

                </p>
            <?php else: ?>
                <div class="text-center py-16 bg-white rounded-2xl shadow-sm">
                    <i class="fas fa-chart-line text-6xl text-gray-300 mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">Data Belum Tersedia</h3>
                    <p class="text-gray-500">Data IDM belum diinput ke dalam sistem.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <?php if($idm): ?>
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                new Chart(document.getElementById('idmChart'), {
                    type: 'bar',
                    data: {
                        labels: ['IKS (Sosial)', 'IKE (Ekonomi)', 'IKL (Lingkungan)', 'Skor IDM'],
                        datasets: [{
                            label: 'Nilai',
                            data: [
                                <?php echo e($idm->iks ?? 0); ?>,
                                <?php echo e($idm->ike ?? 0); ?>,
                                <?php echo e($idm->ikl ?? 0); ?>,
                                <?php echo e($idm->skor_idm ?? 0); ?>

                            ],
                            backgroundColor: ['#3B82F6', '#22C55E', '#F59E0B', '#8B5CF6']
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
                                max: 1
                            }
                        }
                    }
                });
            });
        </script>
    <?php endif; ?>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\website-desa-tanalum\resources\views/infografis/idm.blade.php ENDPATH**/ ?>


<?php $__env->startSection('title', 'Visi & Misi'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Hero Section -->
    <section class="relative py-20 bg-gradient-to-r from-primary-600 to-primary-700">
        <div class="container mx-auto px-4">
            <div class="text-center text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Visi & Misi</h1>
                <p class="text-lg text-primary-100"><?php echo e($profil->nama_desa ?? 'Desa Tanalum'); ?></p>
            </div>
        </div>
    </section>

    <!-- Breadcrumb -->
    <div class="bg-white shadow-sm">
        <div class="container mx-auto px-4">
            <nav class="flex items-center space-x-2 py-4 text-sm">
                <a href="<?php echo e(route('home')); ?>" class="text-gray-500 hover:text-primary-600">Beranda</a>
                <span class="text-gray-400">/</span>
                <a href="<?php echo e(route('profil.index')); ?>" class="text-gray-500 hover:text-primary-600">Profil Desa</a>
                <span class="text-gray-400">/</span>
                <span class="text-primary-600 font-medium">Visi & Misi</span>
            </nav>
        </div>
    </div>

    <!-- Content -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <!-- Visi -->
                <div class="bg-gradient-to-br from-primary-600 to-primary-700 rounded-2xl shadow-lg p-8 md:p-12 mb-8 text-white"
                    data-aos="fade-up">
                    <div class="flex items-center mb-6">
                        <div class="w-14 h-14 bg-white/20 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-eye text-2xl"></i>
                        </div>
                        <h2 class="text-3xl font-bold">Visi</h2>
                    </div>
                    <div class="prose prose-lg prose-invert max-w-none">
                        <?php if($profil->visi): ?>
                            <?php echo $profil->visi; ?>

                        <?php else: ?>
                            <p class="text-xl leading-relaxed">"Terwujudnya Desa Tanalum yang maju, mandiri, dan sejahtera
                                melalui pengelolaan sumber daya alam yang berkelanjutan serta peningkatan kualitas sumber
                                daya manusia"</p>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Misi -->
                <div class="bg-white rounded-2xl shadow-sm p-8 md:p-12" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex items-center mb-6">
                        <div class="w-14 h-14 bg-primary-100 rounded-xl flex items-center justify-center mr-4">
                            <i class="fas fa-bullseye text-2xl text-primary-600"></i>
                        </div>
                        <h2 class="text-3xl font-bold text-gray-800">Misi</h2>
                    </div>
                    <div class="prose prose-lg max-w-none text-gray-600">
                        <?php if($profil->misi): ?>
                            <?php echo $profil->misi; ?>

                        <?php else: ?>
                            <ol class="space-y-4">
                                <li class="flex items-start">
                                    <span
                                        class="w-8 h-8 bg-primary-600 text-white rounded-full flex items-center justify-center flex-shrink-0 mr-4 mt-0.5 text-sm font-bold">1</span>
                                    <span>Meningkatkan kualitas pelayanan publik yang transparan, akuntabel, dan responsif
                                        terhadap kebutuhan masyarakat</span>
                                </li>
                                <li class="flex items-start">
                                    <span
                                        class="w-8 h-8 bg-primary-600 text-white rounded-full flex items-center justify-center flex-shrink-0 mr-4 mt-0.5 text-sm font-bold">2</span>
                                    <span>Meningkatkan kesejahteraan masyarakat melalui pemberdayaan ekonomi lokal dan
                                        pengembangan UMKM</span>
                                </li>
                                <li class="flex items-start">
                                    <span
                                        class="w-8 h-8 bg-primary-600 text-white rounded-full flex items-center justify-center flex-shrink-0 mr-4 mt-0.5 text-sm font-bold">3</span>
                                    <span>Membangun infrastruktur desa yang memadai untuk mendukung aktivitas ekonomi dan
                                        sosial masyarakat</span>
                                </li>
                                <li class="flex items-start">
                                    <span
                                        class="w-8 h-8 bg-primary-600 text-white rounded-full flex items-center justify-center flex-shrink-0 mr-4 mt-0.5 text-sm font-bold">4</span>
                                    <span>Meningkatkan kualitas pendidikan dan kesehatan masyarakat desa</span>
                                </li>
                                <li class="flex items-start">
                                    <span
                                        class="w-8 h-8 bg-primary-600 text-white rounded-full flex items-center justify-center flex-shrink-0 mr-4 mt-0.5 text-sm font-bold">5</span>
                                    <span>Melestarikan nilai-nilai budaya lokal dan kearifan tradisional masyarakat</span>
                                </li>
                            </ol>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Navigation -->
                <div class="flex flex-col sm:flex-row justify-between gap-4 mt-8">
                    <a href="<?php echo e(route('profil.sejarah')); ?>"
                        class="inline-flex items-center justify-center px-6 py-3 border border-gray-300 text-gray-700 hover:bg-gray-50 rounded-lg transition">
                        <i class="fas fa-arrow-left mr-2"></i>
                        Sejarah Desa
                    </a>
                    <a href="<?php echo e(route('profil.struktur')); ?>"
                        class="inline-flex items-center justify-center px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white rounded-lg transition">
                        Struktur Organisasi
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\website-desa-tanalum\resources\views/profil/visi-misi.blade.php ENDPATH**/ ?>


<?php $__env->startSection('title', $berita->judul); ?>

<?php $__env->startSection('meta'); ?>
    <meta name="description" content="<?php echo e($berita->ringkasan ?? Str::limit(strip_tags($berita->konten), 160)); ?>">
    <meta property="og:title" content="<?php echo e($berita->judul); ?>">
    <meta property="og:description" content="<?php echo e($berita->ringkasan ?? Str::limit(strip_tags($berita->konten), 160)); ?>">
    <?php if($berita->gambar_utama): ?>
        <meta property="og:image" content="<?php echo e(Storage::url($berita->gambar_utama)); ?>">
    <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <!-- Breadcrumb -->
    <div class="bg-white shadow-sm">
        <div class="container mx-auto px-4">
            <nav class="flex items-center space-x-2 py-4 text-sm">
                <a href="<?php echo e(route('home')); ?>" class="text-gray-500 hover:text-primary-600">Beranda</a>
                <span class="text-gray-400">/</span>
                <a href="<?php echo e(route('berita.index')); ?>" class="text-gray-500 hover:text-primary-600">Berita</a>
                <span class="text-gray-400">/</span>
                <span class="text-primary-600 font-medium line-clamp-1"><?php echo e($berita->judul); ?></span>
            </nav>
        </div>
    </div>

    <!-- Content -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="grid lg:grid-cols-4 gap-8">
                <!-- Main Content -->
                <article class="lg:col-span-3">
                    <div class="bg-white rounded-2xl shadow-sm overflow-hidden" data-aos="fade-up">
                        <!-- Featured Image -->
                        <?php if($berita->gambar_utama): ?>
                            <img src="<?php echo e(Storage::url($berita->gambar_utama)); ?>" alt="<?php echo e($berita->judul); ?>"
                                class="w-full aspect-video object-cover">
                        <?php endif; ?>

                        <div class="p-8">
                            <!-- Meta -->
                            <div class="flex flex-wrap items-center gap-4 text-sm text-gray-500 mb-4">
                                <span><i class="far fa-calendar mr-1"></i>
                                    <?php echo e($berita->published_at ? $berita->published_at->format('d F Y') : $berita->created_at->format('d F Y')); ?></span>
                                <?php if($berita->kategori): ?>
                                    <a href="<?php echo e(route('berita.index', ['kategori' => $berita->kategori->id])); ?>"
                                        class="px-3 py-1 bg-primary-100 text-primary-700 rounded-full text-xs font-medium hover:bg-primary-200 transition">
                                        <?php echo e($berita->kategori->nama); ?>

                                    </a>
                                <?php endif; ?>
                                <?php if($berita->author): ?>
                                    <span><i class="far fa-user mr-1"></i> <?php echo e($berita->author->name); ?></span>
                                <?php endif; ?>
                                <span><i class="far fa-eye mr-1"></i> <?php echo e($berita->views ?? 0); ?>x dibaca</span>
                            </div>

                            <!-- Title -->
                            <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-6"><?php echo e($berita->judul); ?></h1>

                            <!-- Content -->
                            <div class="prose prose-lg max-w-none text-gray-600">
                                <?php echo $berita->konten; ?>

                            </div>

                            <!-- Tags -->
                            <?php if($berita->tags && count($berita->tags) > 0): ?>
                                <div class="mt-8 pt-6 border-t border-gray-100">
                                    <div class="flex flex-wrap items-center gap-2">
                                        <span class="text-gray-500"><i class="fas fa-tags mr-1"></i> Tags:</span>
                                        <?php $__currentLoopData = $berita->tags; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $tag): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <a href="<?php echo e(route('berita.index', ['tag' => $tag])); ?>"
                                                class="px-3 py-1 bg-gray-100 hover:bg-primary-100 hover:text-primary-600 text-gray-600 text-sm rounded-full transition">
                                                <?php echo e($tag); ?>

                                            </a>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <!-- Share -->
                            <div class="mt-8 pt-6 border-t border-gray-100">
                                <div class="flex items-center space-x-4">
                                    <span class="text-gray-500">Bagikan:</span>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(request()->url())); ?>"
                                        target="_blank"
                                        class="w-10 h-10 bg-blue-600 text-white rounded-lg flex items-center justify-center hover:bg-blue-700 transition">
                                        <i class="fab fa-facebook-f"></i>
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?url=<?php echo e(urlencode(request()->url())); ?>&text=<?php echo e(urlencode($berita->judul)); ?>"
                                        target="_blank"
                                        class="w-10 h-10 bg-sky-500 text-white rounded-lg flex items-center justify-center hover:bg-sky-600 transition">
                                        <i class="fab fa-twitter"></i>
                                    </a>
                                    <a href="https://wa.me/?text=<?php echo e(urlencode($berita->judul . ' ' . request()->url())); ?>"
                                        target="_blank"
                                        class="w-10 h-10 bg-green-500 text-white rounded-lg flex items-center justify-center hover:bg-green-600 transition">
                                        <i class="fab fa-whatsapp"></i>
                                    </a>
                                    <button
                                        onclick="navigator.clipboard.writeText('<?php echo e(request()->url()); ?>'); alert('Link berhasil disalin!');"
                                        class="w-10 h-10 bg-gray-500 text-white rounded-lg flex items-center justify-center hover:bg-gray-600 transition">
                                        <i class="fas fa-link"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Navigation -->
                    <div class="flex flex-col sm:flex-row justify-between gap-4 mt-8">
                        <?php if($prevBerita): ?>
                            <a href="<?php echo e(route('berita.show', $prevBerita->slug)); ?>"
                                class="flex-1 p-4 bg-white rounded-xl shadow-sm hover:shadow-md transition group">
                                <div class="flex items-center text-gray-500 text-sm mb-2">
                                    <i class="fas fa-arrow-left mr-2 group-hover:-translate-x-1 transition"></i>
                                    Sebelumnya
                                </div>
                                <p class="font-medium text-gray-800 line-clamp-1"><?php echo e($prevBerita->judul); ?></p>
                            </a>
                        <?php else: ?>
                            <div></div>
                        <?php endif; ?>
                        <?php if($nextBerita): ?>
                            <a href="<?php echo e(route('berita.show', $nextBerita->slug)); ?>"
                                class="flex-1 p-4 bg-white rounded-xl shadow-sm hover:shadow-md transition group text-right">
                                <div class="flex items-center justify-end text-gray-500 text-sm mb-2">
                                    Selanjutnya
                                    <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition"></i>
                                </div>
                                <p class="font-medium text-gray-800 line-clamp-1"><?php echo e($nextBerita->judul); ?></p>
                            </a>
                        <?php endif; ?>
                    </div>

                    <!-- Related Posts -->
                    <?php if($relatedBeritas->count() > 0): ?>
                        <div class="mt-12">
                            <h2 class="text-2xl font-bold text-gray-800 mb-6">Berita Terkait</h2>
                            <div class="grid md:grid-cols-3 gap-6">
                                <?php $__currentLoopData = $relatedBeritas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $related): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <article
                                        class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition group">
                                        <a href="<?php echo e(route('berita.show', $related->slug)); ?>">
                                            <div class="aspect-video overflow-hidden">
                                                <?php if($related->gambar_utama): ?>
                                                    <img src="<?php echo e(Storage::url($related->gambar_utama)); ?>"
                                                        alt="<?php echo e($related->judul); ?>"
                                                        class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                                <?php else: ?>
                                                    <div
                                                        class="w-full h-full bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center">
                                                        <i class="fas fa-newspaper text-3xl text-primary-400"></i>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </a>
                                        <div class="p-4">
                                            <p class="text-xs text-gray-500 mb-2">
                                                <?php echo e($related->published_at ? $related->published_at->format('d M Y') : $related->created_at->format('d M Y')); ?>

                                            </p>
                                            <h3
                                                class="font-semibold text-gray-800 line-clamp-2 group-hover:text-primary-600 transition">
                                                <a
                                                    href="<?php echo e(route('berita.show', $related->slug)); ?>"><?php echo e($related->judul); ?></a>
                                            </h3>
                                        </div>
                                    </article>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </article>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Author -->
                    <?php if($berita->author): ?>
                        <div class="bg-white rounded-2xl shadow-sm p-6" data-aos="fade-left">
                            <h3 class="font-bold text-gray-800 mb-4">Penulis</h3>
                            <div class="flex items-center">
                                <div class="w-12 h-12 bg-primary-100 rounded-full flex items-center justify-center mr-3">
                                    <i class="fas fa-user text-primary-600"></i>
                                </div>
                                <div>
                                    <p class="font-semibold text-gray-800"><?php echo e($berita->author->name); ?></p>
                                    <p class="text-sm text-gray-500"><?php echo e(ucfirst($berita->author->role)); ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Berita Populer -->
                    <?php if($beritaPopuler->count() > 0): ?>
                        <div class="bg-white rounded-2xl shadow-sm p-6" data-aos="fade-left" data-aos-delay="100">
                            <h3 class="font-bold text-gray-800 mb-4">Berita Populer</h3>
                            <div class="space-y-4">
                                <?php $__currentLoopData = $beritaPopuler; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $popular): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e(route('berita.show', $popular->slug)); ?>"
                                        class="flex items-start space-x-3 group">
                                        <span
                                            class="w-8 h-8 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center flex-shrink-0 font-bold text-sm"><?php echo e($index + 1); ?></span>
                                        <div>
                                            <h4
                                                class="text-sm font-medium text-gray-800 group-hover:text-primary-600 transition line-clamp-2">
                                                <?php echo e($popular->judul); ?></h4>
                                            <p class="text-xs text-gray-500 mt-1"><?php echo e($popular->views ?? 0); ?>x dibaca</p>
                                        </div>
                                    </a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Back to List -->
                    <div class="bg-white rounded-2xl shadow-sm p-6" data-aos="fade-left" data-aos-delay="200">
                        <a href="<?php echo e(route('berita.index')); ?>"
                            class="flex items-center justify-center w-full py-3 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition">
                            <i class="fas fa-arrow-left mr-2"></i>
                            Kembali ke Daftar Berita
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\website-desa-tanalum\resources\views/berita/show.blade.php ENDPATH**/ ?>
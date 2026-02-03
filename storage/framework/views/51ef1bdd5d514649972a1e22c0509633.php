

<?php $__env->startSection('title', $produk->nama); ?>

<?php $__env->startSection('content'); ?>
    <!-- Breadcrumb -->
    <div class="bg-white shadow-sm">
        <div class="container mx-auto px-4">
            <nav class="flex items-center space-x-2 py-4 text-sm">
                <a href="<?php echo e(route('home')); ?>" class="text-gray-500 hover:text-primary-600">Beranda</a>
                <span class="text-gray-400">/</span>
                <a href="<?php echo e(route('belanja.index')); ?>" class="text-gray-500 hover:text-primary-600">Produk</a>
                <span class="text-gray-400">/</span>
                <span class="text-primary-600 font-medium line-clamp-1"><?php echo e($produk->nama); ?></span>
            </nav>
        </div>
    </div>

    <!-- Content -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="grid lg:grid-cols-2 gap-12">
                <!-- Product Images -->
                <div data-aos="fade-right">
                    <div class="bg-white rounded-2xl shadow-sm overflow-hidden">
                        <div class="h-[450px] flex items-center justify-center bg-gray-50" x-data="{ mainImage: '<?php echo e($produk->gambar_utama ? Storage::url($produk->gambar_utama) : ''); ?>' }">
                            <?php if($produk->gambar_utama): ?>
                                <img :src="mainImage" alt="<?php echo e($produk->nama); ?>"
                                    class="max-h-[450px] w-auto object-contain">
                            <?php else: ?>
                                <div
                                    class="w-full h-64 bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center">
                                    <i class="fas fa-box text-6xl text-primary-400"></i>
                                </div>
                            <?php endif; ?>
                        </div>

                        <?php if($produk->galeri && count($produk->galeri) > 0): ?>
                            <div class="p-4 grid grid-cols-5 gap-2">
                                <button @click="mainImage = '<?php echo e(Storage::url($produk->gambar_utama)); ?>'"
                                    class="aspect-square rounded-lg overflow-hidden border-2 border-primary-500">
                                    <img src="<?php echo e(Storage::url($produk->gambar_utama)); ?>" alt="<?php echo e($produk->nama); ?>"
                                        class="w-full h-full object-cover">
                                </button>
                                <?php $__currentLoopData = $produk->galeri; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <button @click="mainImage = '<?php echo e(Storage::url($img)); ?>'"
                                        class="aspect-square rounded-lg overflow-hidden border-2 border-transparent hover:border-primary-500 transition">
                                        <img src="<?php echo e(Storage::url($img)); ?>" alt="<?php echo e($produk->nama); ?>"
                                            class="w-full h-full object-cover">
                                    </button>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>

                <!-- Product Info -->
                <div data-aos="fade-left">
                    <?php if($produk->kategori): ?>
                        <a href="<?php echo e(route('belanja.index', ['kategori' => $produk->kategori->id])); ?>"
                            class="inline-block px-3 py-1 bg-primary-100 text-primary-700 rounded-full text-sm font-medium mb-4 hover:bg-primary-200 transition">
                            <?php echo e($produk->kategori->nama); ?>

                        </a>
                    <?php endif; ?>

                    <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4"><?php echo e($produk->nama); ?></h1>

                    <!-- Price -->
                    <div class="mb-6">
                        <?php if($produk->harga_diskon && $produk->harga_diskon < $produk->harga): ?>
                            <div class="flex items-center gap-3">
                                <span class="text-3xl font-bold text-primary-600">
                                    Rp <?php echo e(number_format($produk->harga_diskon, 0, ',', '.')); ?>

                                </span>
                                <span class="text-xl text-gray-400 line-through">
                                    Rp <?php echo e(number_format($produk->harga, 0, ',', '.')); ?>

                                </span>
                            </div>
                            <p class="text-sm text-green-600 mt-1">
                                <i class="fas fa-tags mr-1"></i>
                                Hemat Rp <?php echo e(number_format($produk->harga - $produk->harga_diskon, 0, ',', '.')); ?>

                            </p>
                        <?php else: ?>
                            <span class="text-3xl font-bold text-primary-600">
                                <?php echo e($produk->formatted_harga ?? 'Rp ' . number_format($produk->harga, 0, ',', '.')); ?>

                            </span>
                        <?php endif; ?>
                        <?php if($produk->satuan): ?>
                            <span class="text-gray-500 ml-2">/ <?php echo e($produk->satuan); ?></span>
                        <?php endif; ?>
                    </div>

                    <!-- Stock & Status -->
                    <div class="flex items-center space-x-4 mb-6">
                        <?php if($produk->stok > 0): ?>
                            <span class="px-4 py-2 bg-green-100 text-green-700 rounded-lg font-medium">
                                <i class="fas fa-check-circle mr-1"></i> Stok Tersedia (<?php echo e($produk->stok); ?>)
                            </span>
                        <?php else: ?>
                            <span class="px-4 py-2 bg-red-100 text-red-700 rounded-lg font-medium">
                                <i class="fas fa-times-circle mr-1"></i> Stok Habis
                            </span>
                        <?php endif; ?>
                    </div>

                    <!-- Description -->
                    <?php if($produk->deskripsi): ?>
                        <div class="mb-6">
                            <h3 class="font-semibold text-gray-800 mb-2">Deskripsi</h3>
                            <div class="prose max-w-none text-gray-600">
                                <?php echo $produk->deskripsi; ?>

                            </div>
                        </div>
                    <?php endif; ?>

                    <!-- Seller Info -->
                    <div class="bg-gray-50 rounded-xl p-6 mb-6">
                        <h3 class="font-semibold text-gray-800 mb-4">Informasi Penjual</h3>
                        <div class="space-y-3">
                            <?php if($produk->pemilik): ?>
                                <div class="flex items-center">
                                    <i class="fas fa-store text-primary-600 w-6"></i>
                                    <span class="text-gray-600"><?php echo e($produk->pemilik); ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if($produk->kontak_pemilik): ?>
                                <div class="flex items-center">
                                    <i class="fas fa-phone text-primary-600 w-6"></i>
                                    <span class="text-gray-600"><?php echo e($produk->kontak_pemilik); ?></span>
                                </div>
                            <?php endif; ?>
                            <?php if($produk->alamat_pemilik): ?>
                                <div class="flex items-start">
                                    <i class="fas fa-map-marker-alt text-primary-600 w-6 mt-1"></i>
                                    <span class="text-gray-600"><?php echo e($produk->alamat_pemilik); ?></span>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row gap-4">
                        <?php if($produk->kontak_pemilik): ?>
                            <?php
                                $waNumber = preg_replace('/[^0-9]/', '', $produk->kontak_pemilik);
                                if (substr($waNumber, 0, 1) === '0') {
                                    $waNumber = '62' . substr($waNumber, 1);
                                }
                                $waMessage = urlencode(
                                    "Halo, saya tertarik dengan produk *{$produk->nama}* yang dijual di website Desa Tanalum.\n\nApakah produk ini masih tersedia?",
                                );
                            ?>
                            <a href="https://wa.me/<?php echo e($waNumber); ?>?text=<?php echo e($waMessage); ?>" target="_blank"
                                class="flex-1 py-3 px-6 bg-green-500 hover:bg-green-600 text-white font-semibold rounded-lg transition flex items-center justify-center">
                                <i class="fab fa-whatsapp text-xl mr-2"></i>
                                Hubungi via WhatsApp
                            </a>
                        <?php endif; ?>
                        <button
                            onclick="navigator.share ? navigator.share({title: '<?php echo e($produk->nama); ?>', url: window.location.href}) : navigator.clipboard.writeText(window.location.href).then(() => alert('Link berhasil disalin!'))"
                            class="py-3 px-6 border-2 border-gray-300 text-gray-700 hover:bg-gray-50 font-semibold rounded-lg transition flex items-center justify-center">
                            <i class="fas fa-share-alt mr-2"></i>
                            Bagikan
                        </button>
                    </div>
                </div>
            </div>

            <!-- Related Products -->
            <?php if($relatedProduks->count() > 0): ?>
                <div class="mt-16">
                    <h2 class="text-2xl font-bold text-gray-800 mb-6" data-aos="fade-up">Produk Lainnya</h2>
                    <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        <?php $__currentLoopData = $relatedProduks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $related): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-lg transition group"
                                data-aos="fade-up" data-aos-delay="<?php echo e($index * 50); ?>">
                                <a href="<?php echo e(route('belanja.show', $related->slug)); ?>">
                                    <div class="aspect-square overflow-hidden">
                                        <?php if($related->gambar_utama): ?>
                                            <img src="<?php echo e(Storage::url($related->gambar_utama)); ?>"
                                                alt="<?php echo e($related->nama); ?>"
                                                class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                        <?php else: ?>
                                            <div
                                                class="w-full h-full bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center">
                                                <i class="fas fa-box text-3xl text-primary-400"></i>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </a>
                                <div class="p-4">
                                    <h3 class="font-semibold text-gray-800 line-clamp-2">
                                        <a href="<?php echo e(route('belanja.show', $related->slug)); ?>"
                                            class="hover:text-primary-600 transition"><?php echo e($related->nama); ?></a>
                                    </h3>
                                    <p class="text-primary-600 font-bold mt-2"><?php echo e($related->formatted_harga); ?></p>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\website-desa-tanalum\resources\views/produk/show.blade.php ENDPATH**/ ?>
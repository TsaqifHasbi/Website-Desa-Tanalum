

<?php $__env->startSection('title', 'Produk UMKM'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Hero Section -->
    <section class="relative py-20 bg-gradient-to-r from-primary-600 to-primary-700">
        <div class="container mx-auto px-4">
            <div class="text-center text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Produk UMKM</h1>
                <p class="text-lg text-primary-100">Belanja produk lokal <?php echo e($profil->nama_desa ?? 'Desa Tanalum'); ?></p>
            </div>
        </div>
    </section>

    <!-- Breadcrumb -->
    <div class="bg-white shadow-sm">
        <div class="container mx-auto px-4">
            <nav class="flex items-center space-x-2 py-4 text-sm">
                <a href="<?php echo e(route('home')); ?>" class="text-gray-500 hover:text-primary-600">Beranda</a>
                <span class="text-gray-400">/</span>
                <span class="text-primary-600 font-medium">Produk UMKM</span>
            </nav>
        </div>
    </div>

    <!-- Content -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="grid lg:grid-cols-4 gap-8">
                <!-- Sidebar Filter -->
                <div class="space-y-6">
                    <!-- Search -->
                    <div class="bg-white rounded-2xl shadow-sm p-6" data-aos="fade-right">
                        <h3 class="font-bold text-gray-800 mb-4">Cari Produk</h3>
                        <form action="<?php echo e(route('belanja.index')); ?>" method="GET">
                            <div class="relative">
                                <input type="text" name="search" value="<?php echo e(request('search')); ?>"
                                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                    placeholder="Nama produk...">
                                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            </div>
                            <button type="submit"
                                class="w-full mt-3 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition">
                                Cari
                            </button>
                        </form>
                    </div>

                    <!-- Kategori -->
                    <div class="bg-white rounded-2xl shadow-sm p-6" data-aos="fade-right" data-aos-delay="100">
                        <h3 class="font-bold text-gray-800 mb-4">Kategori</h3>
                        <div class="space-y-2">
                            <a href="<?php echo e(route('belanja.index')); ?>"
                                class="flex items-center justify-between p-2 rounded-lg hover:bg-gray-50 transition <?php echo e(!request('kategori') ? 'bg-primary-50 text-primary-600' : 'text-gray-600'); ?>">
                                <span>Semua Produk</span>
                                <span class="text-sm"><?php echo e($totalProduk); ?></span>
                            </a>
                            <?php $__currentLoopData = $kategoris; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a href="<?php echo e(route('belanja.index', ['kategori' => $kategori->id])); ?>"
                                    class="flex items-center justify-between p-2 rounded-lg hover:bg-gray-50 transition <?php echo e(request('kategori') == $kategori->id ? 'bg-primary-50 text-primary-600' : 'text-gray-600'); ?>">
                                    <span><?php echo e($kategori->nama); ?></span>
                                    <span class="text-sm"><?php echo e($kategori->produk_count); ?></span>
                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>

                    <!-- Price Range -->
                    <div class="bg-white rounded-2xl shadow-sm p-6" data-aos="fade-right" data-aos-delay="200">
                        <h3 class="font-bold text-gray-800 mb-4">Harga</h3>
                        <form action="<?php echo e(route('belanja.index')); ?>" method="GET">
                            <?php if(request('kategori')): ?>
                                <input type="hidden" name="kategori" value="<?php echo e(request('kategori')); ?>">
                            <?php endif; ?>
                            <?php if(request('search')): ?>
                                <input type="hidden" name="search" value="<?php echo e(request('search')); ?>">
                            <?php endif; ?>
                            <div class="space-y-3">
                                <div>
                                    <label class="text-sm text-gray-500">Harga Minimum</label>
                                    <input type="number" name="min_price" value="<?php echo e(request('min_price')); ?>"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                        placeholder="Rp 0">
                                </div>
                                <div>
                                    <label class="text-sm text-gray-500">Harga Maksimum</label>
                                    <input type="number" name="max_price" value="<?php echo e(request('max_price')); ?>"
                                        class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                        placeholder="Rp 1.000.000">
                                </div>
                                <button type="submit"
                                    class="w-full py-2 bg-gray-800 hover:bg-gray-900 text-white font-medium rounded-lg transition">
                                    Terapkan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="lg:col-span-3">
                    <!-- Sort & View -->
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-6"
                        data-aos="fade-up">
                        <p class="text-gray-600">Menampilkan <?php echo e($produks->count()); ?> dari <?php echo e($produks->total()); ?> produk
                        </p>
                        <div class="flex items-center space-x-4">
                            <select name="sort" onchange="window.location.href=this.value"
                                class="px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                <option
                                    value="<?php echo e(route('belanja.index', array_merge(request()->except('sort'), ['sort' => 'terbaru']))); ?>"
                                    <?php echo e(request('sort', 'terbaru') == 'terbaru' ? 'selected' : ''); ?>>Terbaru</option>
                                <option
                                    value="<?php echo e(route('belanja.index', array_merge(request()->except('sort'), ['sort' => 'termurah']))); ?>"
                                    <?php echo e(request('sort') == 'termurah' ? 'selected' : ''); ?>>Harga Terendah</option>
                                <option
                                    value="<?php echo e(route('belanja.index', array_merge(request()->except('sort'), ['sort' => 'termahal']))); ?>"
                                    <?php echo e(request('sort') == 'termahal' ? 'selected' : ''); ?>>Harga Tertinggi</option>
                                <option
                                    value="<?php echo e(route('belanja.index', array_merge(request()->except('sort'), ['sort' => 'nama']))); ?>"
                                    <?php echo e(request('sort') == 'nama' ? 'selected' : ''); ?>>Nama A-Z</option>
                            </select>
                        </div>
                    </div>

                    <?php if($produks->count() > 0): ?>
                        <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            <?php $__currentLoopData = $produks; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $produk): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-lg transition group"
                                    data-aos="fade-up" data-aos-delay="<?php echo e(($index % 6) * 50); ?>">
                                    <a href="<?php echo e(route('belanja.show', $produk->slug)); ?>">
                                        <div class="aspect-square overflow-hidden relative">
                                            <?php if($produk->gambar_utama): ?>
                                                <img src="<?php echo e(Storage::url($produk->gambar_utama)); ?>"
                                                    alt="<?php echo e($produk->nama); ?>"
                                                    class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                            <?php else: ?>
                                                <div
                                                    class="w-full h-full bg-gradient-to-br from-primary-100 to-primary-200 flex items-center justify-center">
                                                    <i class="fas fa-box text-4xl text-primary-400"></i>
                                                </div>
                                            <?php endif; ?>
                                            <?php if($produk->stok <= 0): ?>
                                                <div class="absolute inset-0 bg-black/50 flex items-center justify-center">
                                                    <span
                                                        class="px-4 py-2 bg-red-500 text-white font-semibold rounded-lg">Stok
                                                        Habis</span>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </a>
                                    <div class="p-5">
                                        <?php if($produk->kategori): ?>
                                            <span
                                                class="text-xs text-primary-600 font-medium"><?php echo e($produk->kategori->nama); ?></span>
                                        <?php endif; ?>
                                        <h3 class="font-semibold text-lg text-gray-800 mt-1 line-clamp-2 h-14">
                                            <a href="<?php echo e(route('belanja.show', $produk->slug)); ?>"
                                                class="hover:text-primary-600 transition"><?php echo e($produk->nama); ?></a>
                                        </h3>
                                        <div class="flex items-center justify-between mt-3">
                                            <p class="text-primary-600 font-bold text-lg"><?php echo e($produk->formatted_harga); ?>

                                            </p>
                                            <?php if($produk->stok > 0): ?>
                                                <span class="text-xs text-gray-500">Stok: <?php echo e($produk->stok); ?></span>
                                            <?php endif; ?>
                                        </div>
                                        <?php if($produk->pemilik): ?>
                                            <p class="text-sm text-gray-500 mt-2">
                                                <i class="fas fa-store mr-1"></i> <?php echo e($produk->pemilik); ?>

                                            </p>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        <!-- Pagination -->
                        <div class="mt-8">
                            <?php echo e($produks->withQueryString()->links()); ?>

                        </div>
                    <?php else: ?>
                        <div class="text-center py-16 bg-white rounded-2xl shadow-sm">
                            <i class="fas fa-box-open text-6xl text-gray-300 mb-4"></i>
                            <h3 class="text-xl font-semibold text-gray-600 mb-2">Tidak Ada Produk</h3>
                            <p class="text-gray-500">
                                <?php if(request('search') || request('kategori') || request('min_price') || request('max_price')): ?>
                                    Tidak ditemukan produk yang sesuai dengan filter Anda.
                                <?php else: ?>
                                    Belum ada produk yang tersedia.
                                <?php endif; ?>
                            </p>
                            <?php if(request()->has(['search', 'kategori', 'min_price', 'max_price'])): ?>
                                <a href="<?php echo e(route('belanja.index')); ?>"
                                    class="inline-flex items-center mt-4 text-primary-600 hover:text-primary-700">>
                                    <i class="fas fa-times mr-2"></i> Reset Filter
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\website-desa-tanalum\resources\views/produk/index.blade.php ENDPATH**/ ?>
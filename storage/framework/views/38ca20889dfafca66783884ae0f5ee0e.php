

<?php $__env->startSection('title', $title ?? 'Informasi Publik - PPID Desa Tanalum'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Hero Section -->
    <section class="relative py-20 bg-gradient-to-r from-blue-600 to-blue-700">
        <div class="absolute inset-0 bg-black/20"></div>
        <div class="container mx-auto px-4 relative">
            <div class="text-center text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-4"><?php echo e($title ?? 'Informasi Publik'); ?></h1>
                <p class="text-xl text-blue-100 mb-4"><?php echo e($subtitle ?? 'Dokumen dan Informasi Publik Desa'); ?></p>
                <!-- Breadcrumb -->
                <nav class="flex items-center justify-center text-sm">
                    <a href="<?php echo e(route('home')); ?>" class="text-blue-200 hover:text-white">Beranda</a>
                    <span class="mx-2 text-blue-300">/</span>
                    <a href="<?php echo e(route('ppid.index')); ?>" class="text-blue-200 hover:text-white">PPID</a>
                    <span class="mx-2 text-blue-300">/</span>
                    <span class="text-white"><?php echo e($breadcrumb ?? 'Informasi'); ?></span>
                </nav>
            </div>
        </div>
    </section>

    <!-- Filter Section -->
    <section class="py-8 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <form action="" method="GET" class="flex flex-col md:flex-row gap-4">
                        <div class="flex-1">
                            <input type="text" name="search" value="<?php echo e(request('search')); ?>"
                                placeholder="Cari dokumen..."
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                        </div>
                        <div>
                            <select name="kategori"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Semua Kategori</option>
                                <?php $__currentLoopData = $kategoris ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kategori): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($kategori->slug); ?>"
                                        <?php echo e(request('kategori') == $kategori->slug ? 'selected' : ''); ?>>
                                        <?php echo e($kategori->nama); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div>
                            <select name="tahun"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-blue-500 focus:border-blue-500">
                                <option value="">Semua Tahun</option>
                                <?php for($y = date('Y'); $y >= 2020; $y--): ?>
                                    <option value="<?php echo e($y); ?>" <?php echo e(request('tahun') == $y ? 'selected' : ''); ?>>
                                        <?php echo e($y); ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div>
                            <button type="submit"
                                class="w-full px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                <i class="fas fa-search mr-2"></i>Cari
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Documents List -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <?php if(isset($dokumens) && $dokumens->count() > 0): ?>
                    <div class="space-y-4">
                        <?php $__currentLoopData = $dokumens; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $dokumen): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition-shadow">
                                <div class="p-6">
                                    <div class="flex items-start">
                                        <!-- File Icon -->
                                        <div class="flex-shrink-0 mr-4">
                                            <?php
                                                $extension = pathinfo($dokumen->file_path, PATHINFO_EXTENSION);
                                                $iconClass = match (strtolower($extension)) {
                                                    'pdf' => 'fa-file-pdf text-red-500',
                                                    'doc', 'docx' => 'fa-file-word text-blue-500',
                                                    'xls', 'xlsx' => 'fa-file-excel text-green-500',
                                                    'ppt', 'pptx' => 'fa-file-powerpoint text-orange-500',
                                                    'zip', 'rar' => 'fa-file-archive text-yellow-500',
                                                    'jpg', 'jpeg', 'png' => 'fa-file-image text-purple-500',
                                                    default => 'fa-file text-gray-500',
                                                };
                                            ?>
                                            <div class="w-14 h-14 bg-gray-100 rounded-lg flex items-center justify-center">
                                                <i class="fas <?php echo e($iconClass); ?> text-2xl"></i>
                                            </div>
                                        </div>

                                        <!-- Document Info -->
                                        <div class="flex-1 min-w-0">
                                            <h3 class="text-lg font-semibold text-gray-800 mb-1">
                                                <?php echo e($dokumen->judul); ?>

                                            </h3>
                                            <p class="text-sm text-gray-600 mb-2 line-clamp-2">
                                                <?php echo e($dokumen->deskripsi ?? '-'); ?>

                                            </p>
                                            <div class="flex flex-wrap items-center gap-4 text-xs text-gray-500">
                                                <?php if($dokumen->kategori): ?>
                                                    <span class="inline-flex items-center">
                                                        <i class="fas fa-folder mr-1"></i>
                                                        <?php echo e($dokumen->kategori->nama ?? '-'); ?>

                                                    </span>
                                                <?php endif; ?>
                                                <?php if($dokumen->nomor_dokumen): ?>
                                                    <span class="inline-flex items-center">
                                                        <i class="fas fa-hashtag mr-1"></i>
                                                        <?php echo e($dokumen->nomor_dokumen); ?>

                                                    </span>
                                                <?php endif; ?>
                                                <?php if($dokumen->tanggal_dokumen): ?>
                                                    <span class="inline-flex items-center">
                                                        <i class="fas fa-calendar mr-1"></i>
                                                        <?php echo e($dokumen->tanggal_dokumen->format('d M Y')); ?>

                                                    </span>
                                                <?php endif; ?>
                                                <span class="inline-flex items-center">
                                                    <i class="fas fa-hdd mr-1"></i>
                                                    <?php echo e(number_format($dokumen->file_size / 1024, 0)); ?> KB
                                                </span>
                                                <span class="inline-flex items-center">
                                                    <i class="fas fa-download mr-1"></i>
                                                    <?php echo e($dokumen->download_count ?? 0); ?>x unduh
                                                </span>
                                            </div>
                                        </div>

                                        <!-- Actions -->
                                        <div class="flex-shrink-0 ml-4 flex items-center gap-2">
                                            <?php if($dokumen->file_path): ?>
                                                <a href="<?php echo e(route('ppid.view', $dokumen->slug)); ?>" target="_blank"
                                                    class="inline-flex items-center px-3 py-2 text-sm bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 transition-colors"
                                                    title="Lihat">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="<?php echo e(route('ppid.download', $dokumen->slug)); ?>"
                                                    class="inline-flex items-center px-3 py-2 text-sm bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors"
                                                    title="Unduh">
                                                    <i class="fas fa-download"></i>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-8">
                        <?php echo e($dokumens->links()); ?>

                    </div>
                <?php else: ?>
                    <!-- Empty State -->
                    <div class="bg-white rounded-xl shadow-sm p-12 text-center">
                        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-folder-open text-gray-400 text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-semibold text-gray-800 mb-2">Belum Ada Dokumen</h3>
                        <p class="text-gray-600">
                            <?php if(request('search')): ?>
                                Tidak ditemukan dokumen dengan kata kunci "<?php echo e(request('search')); ?>"
                            <?php else: ?>
                                Dokumen informasi publik belum tersedia untuk kategori ini.
                            <?php endif; ?>
                        </p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Info Section -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="bg-blue-50 rounded-xl p-8">
                    <div class="flex flex-col md:flex-row items-center gap-6">
                        <div class="w-20 h-20 bg-blue-100 rounded-full flex items-center justify-center flex-shrink-0">
                            <i class="fas fa-question-circle text-blue-600 text-3xl"></i>
                        </div>
                        <div class="flex-1 text-center md:text-left">
                            <h3 class="text-xl font-bold text-gray-800 mb-2">Tidak menemukan informasi yang dicari?</h3>
                            <p class="text-gray-600 mb-4">
                                Anda dapat mengajukan permohonan informasi publik secara resmi melalui formulir permohonan
                                PPID.
                            </p>
                            <a href="<?php echo e(route('ppid.permohonan')); ?>"
                                class="inline-flex items-center px-6 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
                                <i class="fas fa-paper-plane mr-2"></i>
                                Ajukan Permohonan Informasi
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Information Category Description -->
    <section class="py-12">
        <div class="container mx-auto px-4">
            <div class="max-w-4xl mx-auto">
                <div class="bg-white rounded-xl shadow-sm p-8">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">
                        <i class="fas fa-info-circle text-blue-600 mr-2"></i>
                        Tentang <?php echo e($title ?? 'Informasi Publik'); ?>

                    </h3>

                    <?php if(isset($jenis)): ?>
                        <?php switch($jenis):
                            case ('berkala'): ?>
                                <p class="text-gray-600 leading-relaxed">
                                    <strong>Informasi Berkala</strong> adalah informasi yang wajib disediakan dan diumumkan
                                    secara rutin, berkala, dan teratur minimal 6 (enam) bulan sekali. Informasi ini meliputi:
                                </p>
                                <ul class="mt-4 space-y-2 text-gray-600">
                                    <li class="flex items-start">
                                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                                        Profil Desa dan strukturnya
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                                        Laporan Keuangan dan APBDes
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                                        Program dan kegiatan desa
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-check-circle text-green-500 mt-1 mr-2"></i>
                                        Peraturan Desa
                                    </li>
                                </ul>
                            <?php break; ?>

                            <?php case ('serta_merta'): ?>
                                <p class="text-gray-600 leading-relaxed">
                                    <strong>Informasi Serta Merta</strong> adalah informasi yang wajib diumumkan tanpa penundaan
                                    dan dapat mengancam hajat hidup orang banyak serta ketertiban umum. Informasi ini meliputi:
                                </p>
                                <ul class="mt-4 space-y-2 text-gray-600">
                                    <li class="flex items-start">
                                        <i class="fas fa-exclamation-triangle text-yellow-500 mt-1 mr-2"></i>
                                        Informasi bencana alam
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-exclamation-triangle text-yellow-500 mt-1 mr-2"></i>
                                        Informasi wabah penyakit
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-exclamation-triangle text-yellow-500 mt-1 mr-2"></i>
                                        Informasi gangguan keamanan
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-exclamation-triangle text-yellow-500 mt-1 mr-2"></i>
                                        Informasi lain yang mengancam keselamatan publik
                                    </li>
                                </ul>
                            <?php break; ?>

                            <?php case ('setiap_saat'): ?>
                                <p class="text-gray-600 leading-relaxed">
                                    <strong>Informasi Setiap Saat</strong> adalah informasi yang wajib tersedia setiap saat dan
                                    dapat diakses oleh masyarakat kapan saja. Informasi ini meliputi:
                                </p>
                                <ul class="mt-4 space-y-2 text-gray-600">
                                    <li class="flex items-start">
                                        <i class="fas fa-folder text-blue-500 mt-1 mr-2"></i>
                                        Daftar informasi publik
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-folder text-blue-500 mt-1 mr-2"></i>
                                        Peraturan dan kebijakan
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-folder text-blue-500 mt-1 mr-2"></i>
                                        Surat keputusan Kepala Desa
                                    </li>
                                    <li class="flex items-start">
                                        <i class="fas fa-folder text-blue-500 mt-1 mr-2"></i>
                                        Data statistik desa
                                    </li>
                                </ul>
                            <?php break; ?>
                        <?php endswitch; ?>
                    <?php else: ?>
                        <p class="text-gray-600 leading-relaxed">
                            Dokumen-dokumen di halaman ini merupakan informasi publik yang dapat diakses oleh masyarakat
                            sesuai dengan ketentuan UU No. 14 Tahun 2008 tentang Keterbukaan Informasi Publik.
                        </p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\website-desa-tanalum\resources\views/ppid/informasi.blade.php ENDPATH**/ ?>
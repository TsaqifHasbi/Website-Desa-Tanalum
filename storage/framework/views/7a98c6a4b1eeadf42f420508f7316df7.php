

<?php $__env->startSection('title', 'Manajemen Slider'); ?>

<?php $__env->startSection('content'); ?>
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-2xl font-bold text-gray-800">Slider Beranda</h1>
                <p class="text-gray-600">Kelola gambar slider halaman utama</p>
            </div>
            <a href="<?php echo e(route('admin.slider.create')); ?>"
                class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition">
                <i class="fas fa-plus mr-2"></i>
                Tambah Slider
            </a>
        </div>

        <!-- Sliders List -->
        <div class="bg-white rounded-xl shadow-sm">
            <?php if(session('success')): ?>
                <div class="m-6 p-4 bg-green-100 border border-green-200 text-green-700 rounded-lg">
                    <?php echo e(session('success')); ?>

                </div>
            <?php endif; ?>

            <?php if($sliders->count() > 0): ?>
                <div id="slider-list" class="divide-y divide-gray-200">
                    <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $slider): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="slider-item p-6 flex flex-col md:flex-row md:items-center gap-4 hover:bg-gray-50 transition cursor-move"
                            data-id="<?php echo e($slider->id); ?>">
                            <!-- Order Handle -->
                            <div class="flex items-center gap-3">
                                <div class="drag-handle text-gray-400 hover:text-gray-600">
                                    <i class="fas fa-grip-vertical text-lg"></i>
                                </div>
                                <span
                                    class="order-badge w-8 h-8 bg-primary-100 text-primary-600 rounded-lg flex items-center justify-center font-bold text-sm">
                                    <?php echo e($slider->urutan ?? $loop->iteration); ?>

                                </span>
                            </div>

                            <!-- Image Preview -->
                            <div class="w-full md:w-48 h-28 rounded-lg overflow-hidden bg-gray-100 flex-shrink-0">
                                <?php if($slider->gambar): ?>
                                    <img src="<?php echo e(Storage::url($slider->gambar)); ?>" alt="<?php echo e($slider->judul); ?>"
                                        class="w-full h-full object-cover">
                                <?php else: ?>
                                    <div class="w-full h-full flex items-center justify-center">
                                        <i class="fas fa-image text-3xl text-gray-300"></i>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Content -->
                            <div class="flex-grow">
                                <h3 class="font-semibold text-gray-800"><?php echo e($slider->judul ?? 'Tanpa Judul'); ?></h3>
                                <?php if($slider->deskripsi): ?>
                                    <p class="text-gray-500 text-sm mt-1 line-clamp-2"><?php echo e($slider->deskripsi); ?></p>
                                <?php endif; ?>
                                <?php if($slider->link): ?>
                                    <a href="<?php echo e($slider->link); ?>" target="_blank"
                                        class="text-primary-600 text-sm hover:underline mt-1 inline-block">
                                        <i class="fas fa-external-link-alt mr-1"></i> <?php echo e(Str::limit($slider->link, 40)); ?>

                                    </a>
                                <?php endif; ?>
                            </div>

                            <!-- Status -->
                            <div class="flex items-center gap-4">
                                <?php if($slider->is_active): ?>
                                    <span
                                        class="px-3 py-1 bg-green-100 text-green-700 text-sm font-medium rounded-full">Aktif</span>
                                <?php else: ?>
                                    <span
                                        class="px-3 py-1 bg-gray-100 text-gray-600 text-sm font-medium rounded-full">Nonaktif</span>
                                <?php endif; ?>
                            </div>

                            <!-- Actions -->
                            <div class="flex items-center gap-2">
                                <a href="<?php echo e(route('admin.slider.edit', $slider->id)); ?>"
                                    class="p-2 text-gray-500 hover:text-primary-600 hover:bg-primary-50 rounded-lg transition"
                                    title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="<?php echo e(route('admin.slider.destroy', $slider->id)); ?>" method="POST"
                                    onsubmit="return confirm('Yakin ingin menghapus slider ini?')">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit"
                                        class="p-2 text-gray-500 hover:text-red-600 hover:bg-red-50 rounded-lg transition"
                                        title="Hapus">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <div class="p-4 bg-gray-50 border-t border-gray-200 rounded-b-xl">
                    <p class="text-sm text-gray-500">
                        <i class="fas fa-info-circle mr-1"></i>
                        Seret untuk mengubah urutan slider. Slider dengan urutan lebih kecil akan tampil lebih dulu.
                    </p>
                </div>
            <?php else: ?>
                <div class="text-center py-12">
                    <i class="fas fa-images text-5xl text-gray-300 mb-4"></i>
                    <h3 class="text-lg font-medium text-gray-600 mb-2">Belum Ada Slider</h3>
                    <p class="text-gray-500 mb-4">Tambahkan gambar slider untuk halaman beranda.</p>
                    <a href="<?php echo e(route('admin.slider.create')); ?>"
                        class="inline-flex items-center px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition">
                        <i class="fas fa-plus mr-2"></i>
                        Tambah Slider
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const sliderList = document.getElementById('slider-list');

            if (sliderList) {
                new Sortable(sliderList, {
                    animation: 150,
                    handle: '.drag-handle',
                    ghostClass: 'bg-primary-50',
                    chosenClass: 'bg-primary-100',
                    dragClass: 'shadow-lg',
                    onEnd: function(evt) {
                        // Get all slider IDs in new order
                        const items = sliderList.querySelectorAll('.slider-item');
                        const ids = Array.from(items).map(item => item.dataset.id);

                        // Update order badges
                        items.forEach((item, index) => {
                            const badge = item.querySelector('.order-badge');
                            if (badge) badge.textContent = index + 1;
                        });

                        // Send to server
                        fetch('<?php echo e(route('admin.slider.reorder')); ?>', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '<?php echo e(csrf_token()); ?>'
                                },
                                body: JSON.stringify({
                                    ids: ids
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                // Show success notification (optional)
                                console.log('Urutan berhasil diperbarui');
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('Gagal memperbarui urutan. Silakan refresh halaman.');
                            });
                    }
                });
            }
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\website-desa-tanalum\resources\views/admin/slider/index.blade.php ENDPATH**/ ?>
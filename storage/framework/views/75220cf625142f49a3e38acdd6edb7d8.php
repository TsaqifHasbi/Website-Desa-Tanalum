

<?php $__env->startSection('title', $galeri ? 'Edit Galeri' : 'Tambah Galeri'); ?>

<?php $__env->startSection('content'); ?>
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800"><?php echo e($galeri ? 'Edit Galeri' : 'Tambah Galeri'); ?></h1>
                <p class="text-gray-600"><?php echo e($galeri ? 'Perbarui data galeri' : 'Upload foto atau video baru'); ?></p>
            </div>
            <a href="<?php echo e(route('admin.galeri.index')); ?>"
                class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-xl shadow-sm">
            <form action="<?php echo e($galeri ? route('admin.galeri.update', $galeri->id) : route('admin.galeri.store')); ?>"
                method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php if($galeri): ?>
                    <?php echo method_field('PUT'); ?>
                <?php endif; ?>

                <div class="p-6 space-y-6">
                    <!-- Tipe -->
                    <div x-data="{ tipe: '<?php echo e(old('tipe', $galeri->tipe ?? 'foto')); ?>' }">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Tipe Media *</label>
                        <div class="flex gap-4">
                            <label class="flex items-center">
                                <input type="radio" name="tipe" value="foto" x-model="tipe"
                                    @change="$dispatch('tipe-changed', $el.value)"
                                    class="w-4 h-4 text-primary-600 border-gray-300 focus:ring-primary-500">
                                <span class="ml-2 text-gray-700"><i class="fas fa-image mr-1"></i> Foto</span>
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="tipe" value="video" x-model="tipe"
                                    @change="$dispatch('tipe-changed', $el.value)"
                                    class="w-4 h-4 text-primary-600 border-gray-300 focus:ring-primary-500">
                                <span class="ml-2 text-gray-700"><i class="fas fa-video mr-1"></i> Video</span>
                            </label>
                        </div>
                        <?php $__errorArgs = ['tipe'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                            <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                        <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                    </div>

                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Judul -->
                        <div>
                            <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul *</label>
                            <input type="text" name="judul" id="judul"
                                value="<?php echo e(old('judul', $galeri->judul ?? '')); ?>" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 <?php $__errorArgs = ['judul'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                placeholder="Masukkan judul galeri">
                            <?php $__errorArgs = ['judul'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>

                        <!-- Kategori -->
                        <div>
                            <label for="kategori_id" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                            <select name="kategori_id" id="kategori_id"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                <option value="">-- Pilih Kategori --</option>
                                <?php $__currentLoopData = $kategoris ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($kat->id); ?>"
                                        <?php echo e(old('kategori_id', $galeri->kategori_id ?? '') == $kat->id ? 'selected' : ''); ?>>
                                        <?php echo e($kat->nama); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                    </div>

                    <!-- Deskripsi -->
                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi</label>
                        <textarea name="deskripsi" id="deskripsi" rows="3"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                            placeholder="Keterangan singkat tentang galeri ini"><?php echo e(old('deskripsi', $galeri->deskripsi ?? '')); ?></textarea>
                    </div>

                    <div x-data="{ tipe: '<?php echo e(old('tipe', $galeri->tipe ?? 'foto')); ?>' }" @tipe-changed.window="tipe = $event.detail">
                        <!-- File Upload -->
                        <div class="mb-6">
                            <label class="block text-sm font-medium text-gray-700 mb-1">File Media
                                <?php echo e($galeri ? '' : '*'); ?></label>

                            <div class="mt-2">
                                <input type="file" name="file" id="file" :accept="tipe === 'foto' ? 'image/*' : 'video/*'"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 <?php $__errorArgs = ['file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                <p class="mt-1 text-sm text-gray-500">
                                    <span x-show="tipe === 'foto'">Foto: JPG, PNG, WebP (Maks. 10MB)</span>
                                    <span x-show="tipe === 'video'">Video: MP4, WebM (Maks. 50MB)</span>
                                </p>
                                <?php $__errorArgs = ['file'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>

                        <!-- Video URL (Alternative) -->
                        <div x-show="tipe === 'video'" class="space-y-2">
                            <label for="video_url" class="block text-sm font-medium text-gray-700 mb-1">URL Video
                                (YouTube/Vimeo)</label>
                            <input type="url" name="video_url" id="video_url"
                                value="<?php echo e(old('video_url', $galeri->video_url ?? '')); ?>"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                placeholder="https://youtube.com/watch?v=...">
                            <p class="mt-1 text-sm text-gray-500">Masukkan URL Video sebagai alternatif jika tidak mengupload file.
                            </p>
                        </div>
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" value="1"
                                <?php echo e(old('is_active', $galeri->is_active ?? true) ? 'checked' : ''); ?>

                                class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                            <span class="ml-2 text-gray-700">Aktif (Tampilkan di website)</span>
                        </label>
                    </div>
                </div>

                <!-- Footer -->
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 rounded-b-xl flex items-center justify-end gap-3">
                    <a href="<?php echo e(route('admin.galeri.index')); ?>"
                        class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition">
                        <i class="fas fa-save mr-2"></i>
                        <?php echo e($galeri ? 'Update' : 'Simpan'); ?>

                    </button>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\website-desa-tanalum\resources\views/admin/galeri/form.blade.php ENDPATH**/ ?>
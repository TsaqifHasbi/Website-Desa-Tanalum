

<?php $__env->startSection('title', $berita ? 'Edit Berita' : 'Tambah Berita'); ?>

<?php $__env->startSection('content'); ?>
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800"><?php echo e($berita ? 'Edit Berita' : 'Tambah Berita'); ?></h1>
                <p class="text-gray-600"><?php echo e($berita ? 'Perbarui konten berita' : 'Buat berita atau artikel baru'); ?>

                </p>
            </div>
            <a href="<?php echo e(route('admin.berita.index')); ?>"
                class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>

        <!-- Form -->
        <form action="<?php echo e($berita ? route('admin.berita.update', $berita->id) : route('admin.berita.store')); ?>" method="POST"
            enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php if($berita): ?>
                <?php echo method_field('PUT'); ?>
            <?php endif; ?>

            <div class="grid lg:grid-cols-3 gap-6">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <!-- Judul -->
                        <div class="mb-6">
                            <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul Berita
                                *</label>
                            <input type="text" name="judul" id="judul"
                                value="<?php echo e(old('judul', $berita->judul ?? '')); ?>" required
                                class="w-full px-4 py-3 text-lg border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 <?php $__errorArgs = ['judul'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                placeholder="Masukkan judul berita">
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

                        <!-- Konten -->
                        <div>
                            <label for="konten" class="block text-sm font-medium text-gray-700 mb-1">Konten *</label>
                            <textarea name="konten" id="konten" rows="15"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 <?php $__errorArgs = ['konten'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                placeholder="Tulis konten berita di sini..."><?php echo e(old('konten', $berita->konten ?? '')); ?></textarea>
                            <?php $__errorArgs = ['konten'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            <p class="mt-1 text-sm text-gray-500">Anda dapat menggunakan format HTML untuk konten</p>
                        </div>

                        <!-- Ringkasan -->
                        <div class="mt-6">
                            <label for="ringkasan" class="block text-sm font-medium text-gray-700 mb-1">Ringkasan</label>
                            <textarea name="ringkasan" id="ringkasan" rows="3"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 <?php $__errorArgs = ['ringkasan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                placeholder="Ringkasan singkat berita (maks. 500 karakter)"><?php echo e(old('ringkasan', $berita->ringkasan ?? '')); ?></textarea>
                            <?php $__errorArgs = ['ringkasan'];
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
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Publish -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h3 class="font-semibold text-gray-800 mb-4">Publikasi</h3>

                        <div class="space-y-4">
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                                <select name="status" id="status"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                    <option value="draft"
                                        <?php echo e(old('status', $berita->status ?? 'draft') == 'draft' ? 'selected' : ''); ?>>Draft
                                    </option>
                                    <option value="published"
                                        <?php echo e(old('status', $berita->status ?? '') == 'published' ? 'selected' : ''); ?>>
                                        Published</option>
                                    <option value="archived"
                                        <?php echo e(old('status', $berita->status ?? '') == 'archived' ? 'selected' : ''); ?>>Archived
                                    </option>
                                </select>
                            </div>

                            <div>
                                <label class="flex items-center">
                                    <input type="checkbox" name="is_featured" value="1"
                                        <?php echo e(old('is_featured', $berita->is_featured ?? false) ? 'checked' : ''); ?>

                                        class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-2 text-gray-700">Tampilkan di Headline</span>
                                </label>
                            </div>

                            <div>
                                <label for="published_at" class="block text-sm font-medium text-gray-700 mb-1">Tanggal
                                    Publikasi</label>
                                <input type="datetime-local" name="published_at" id="published_at"
                                    value="<?php echo e(old('published_at', isset($berita->published_at) ? $berita->published_at->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i'))); ?>"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                            </div>
                        </div>

                        <div class="mt-6 pt-4 border-t border-gray-200">
                            <button type="submit"
                                class="w-full px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition">
                                <i class="fas fa-save mr-2"></i>
                                <?php echo e($berita ? 'Update Berita' : 'Simpan Berita'); ?>

                            </button>
                        </div>
                    </div>

                    <!-- Kategori -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h3 class="font-semibold text-gray-800 mb-4">Kategori</h3>
                        <select name="kategori_id" id="kategori_id"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                            <option value="">-- Pilih Kategori --</option>
                            <?php $__currentLoopData = $kategoris ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($kat->id); ?>"
                                    <?php echo e(old('kategori_id', $berita->kategori_id ?? '') == $kat->id ? 'selected' : ''); ?>>
                                    <?php echo e($kat->nama); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <!-- Featured Image -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h3 class="font-semibold text-gray-800 mb-4">Gambar Utama</h3>

                        <div x-data="{ preview: '<?php echo e($berita && $berita->gambar_utama ? Storage::url($berita->gambar_utama) : ''); ?>' }">
                            <div class="aspect-video rounded-lg overflow-hidden bg-gray-100 mb-3" x-show="preview">
                                <img :src="preview" class="w-full h-full object-cover">
                            </div>

                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-primary-500 transition cursor-pointer"
                                onclick="document.getElementById('gambar_utama').click()" x-show="!preview">
                                <i class="fas fa-image text-3xl text-gray-400 mb-2"></i>
                                <p class="text-sm text-gray-600">Klik untuk upload gambar</p>
                                <p class="text-xs text-gray-400 mt-1">JPG, PNG (Maks. 5MB)</p>
                            </div>

                            <input type="file" name="gambar_utama" id="gambar_utama" accept="image/*" class="hidden"
                                @change="preview = URL.createObjectURL($event.target.files[0])">

                            <button type="button" x-show="preview"
                                @click="preview = ''; document.getElementById('gambar_utama').value = ''"
                                class="mt-2 text-sm text-red-600 hover:text-red-700">
                                <i class="fas fa-times mr-1"></i> Hapus gambar
                            </button>

                            <?php $__errorArgs = ['gambar_utama'];
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

                    <!-- Tags -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h3 class="font-semibold text-gray-800 mb-4">Tags</h3>
                        <input type="text" name="tags" id="tags"
                            value="<?php echo e(old('tags', isset($berita->tags) && is_array($berita->tags) ? implode(', ', $berita->tags) : '')); ?>"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                            placeholder="Tag1, Tag2, Tag3">
                        <p class="mt-1 text-sm text-gray-500">Pisahkan dengan koma</p>
                    </div>
                </div>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <script>
        // Optional: Add a simple WYSIWYG or enable TinyMCE/CKEditor for konten field
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\website-desa-tanalum\resources\views/admin/berita/form.blade.php ENDPATH**/ ?>
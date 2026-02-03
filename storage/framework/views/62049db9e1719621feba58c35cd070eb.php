

<?php $__env->startSection('title', isset($kepala) ? 'Edit Kepala Desa' : 'Tambah Kepala Desa'); ?>

<?php $__env->startSection('content'); ?>
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800"><?php echo e(isset($kepala) ? 'Edit Kepala Desa' : 'Tambah Kepala Desa'); ?></h1>
                <p class="text-gray-600"><?php echo e(isset($kepala) ? 'Perbarui data kepala desa' : 'Tambahkan data kepala desa baru'); ?></p>
            </div>
            <a href="<?php echo e(route('admin.sejarah.index')); ?>"
                class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>

        <!-- Form -->
        <form action="<?php echo e(isset($kepala) ? route('admin.sejarah.kepala.update', $kepala) : route('admin.sejarah.kepala.store')); ?>" 
            method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php if(isset($kepala)): ?>
                <?php echo method_field('PUT'); ?>
            <?php endif; ?>

            <div class="grid lg:grid-cols-3 gap-6">
                <!-- Main Content -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-sm p-6 space-y-6">
                        <!-- Nama -->
                        <div>
                            <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap *</label>
                            <input type="text" name="nama" id="nama"
                                value="<?php echo e(old('nama', $kepala->nama ?? '')); ?>" required
                                class="w-full px-4 py-3 text-lg border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                placeholder="Masukkan nama kepala desa">
                            <?php $__errorArgs = ['nama'];
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

                        <!-- Periode -->
                        <div class="grid md:grid-cols-2 gap-4">
                            <div>
                                <label for="tahun_mulai" class="block text-sm font-medium text-gray-700 mb-1">Tahun Mulai Menjabat</label>
                                <input type="number" name="tahun_mulai" id="tahun_mulai"
                                    value="<?php echo e(old('tahun_mulai', $kepala->tahun_mulai ?? '')); ?>"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 <?php $__errorArgs = ['tahun_mulai'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    placeholder="Contoh: 1990" min="1800" max="<?php echo e(date('Y') + 10); ?>">
                                <?php $__errorArgs = ['tahun_mulai'];
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
                            <div>
                                <label for="tahun_selesai" class="block text-sm font-medium text-gray-700 mb-1">Tahun Selesai Menjabat</label>
                                <input type="number" name="tahun_selesai" id="tahun_selesai"
                                    value="<?php echo e(old('tahun_selesai', $kepala->tahun_selesai ?? '')); ?>"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 <?php $__errorArgs = ['tahun_selesai'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    placeholder="Kosongkan jika masih menjabat" min="1800" max="<?php echo e(date('Y') + 10); ?>">
                                <?php $__errorArgs = ['tahun_selesai'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <p class="mt-1 text-sm text-red-600"><?php echo e($message); ?></p>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <p class="mt-1 text-sm text-gray-500">Kosongkan jika masih menjabat</p>
                            </div>
                        </div>

                        <!-- Keterangan -->
                        <div>
                            <label for="keterangan" class="block text-sm font-medium text-gray-700 mb-1">Keterangan</label>
                            <textarea name="keterangan" id="keterangan" rows="4"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 <?php $__errorArgs = ['keterangan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                placeholder="Informasi tambahan tentang kepala desa (opsional)"><?php echo e(old('keterangan', $kepala->keterangan ?? '')); ?></textarea>
                            <?php $__errorArgs = ['keterangan'];
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
                        <h3 class="font-semibold text-gray-800 mb-4">Pengaturan</h3>

                        <div class="space-y-4">
                            <div>
                                <label for="urutan" class="block text-sm font-medium text-gray-700 mb-1">Urutan</label>
                                <input type="number" name="urutan" id="urutan"
                                    value="<?php echo e(old('urutan', $kepala->urutan ?? 0)); ?>"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                    min="0">
                                <p class="mt-1 text-sm text-gray-500">Semakin kecil semakin atas</p>
                            </div>

                            <div>
                                <label class="flex items-center">
                                    <input type="checkbox" name="is_active" value="1"
                                        <?php echo e(old('is_active', $kepala->is_active ?? true) ? 'checked' : ''); ?>

                                        class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-2 text-gray-700">Aktif (Tampilkan di website)</span>
                                </label>
                            </div>
                        </div>

                        <div class="mt-6 pt-4 border-t border-gray-200">
                            <button type="submit"
                                class="w-full px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition">
                                <i class="fas fa-save mr-2"></i>
                                <?php echo e(isset($kepala) ? 'Update Data' : 'Simpan Data'); ?>

                            </button>
                        </div>
                    </div>

                    <!-- Foto -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h3 class="font-semibold text-gray-800 mb-4">Foto Kepala Desa</h3>

                        <div x-data="{ preview: '<?php echo e(isset($kepala) && $kepala->foto ? Storage::url($kepala->foto) : ''); ?>' }">
                            <div class="w-full aspect-[3/4] rounded-lg overflow-hidden bg-gray-100 mb-3" x-show="preview">
                                <img :src="preview" class="w-full h-full object-cover">
                            </div>

                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-primary-500 transition cursor-pointer"
                                onclick="document.getElementById('foto').click()" x-show="!preview">
                                <i class="fas fa-user-circle text-4xl text-gray-400 mb-2"></i>
                                <p class="text-sm text-gray-600">Klik untuk upload foto</p>
                                <p class="text-xs text-gray-400 mt-1">JPG, PNG (Maks. 2MB)</p>
                            </div>

                            <input type="file" name="foto" id="foto" accept="image/*" class="hidden"
                                @change="preview = URL.createObjectURL($event.target.files[0])">

                            <button type="button" x-show="preview"
                                @click="preview = ''; document.getElementById('foto').value = ''"
                                class="mt-2 text-sm text-red-600 hover:text-red-700">
                                <i class="fas fa-times mr-1"></i> Hapus foto
                            </button>

                            <?php $__errorArgs = ['foto'];
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
                        <p class="mt-3 text-sm text-gray-500">
                            <i class="fas fa-lightbulb mr-1 text-yellow-500"></i>
                            Gunakan foto dengan rasio 3:4 untuk hasil terbaik
                        </p>
                    </div>
                </div>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\website-desa-tanalum\resources\views/admin/sejarah-desa/kepala/form.blade.php ENDPATH**/ ?>
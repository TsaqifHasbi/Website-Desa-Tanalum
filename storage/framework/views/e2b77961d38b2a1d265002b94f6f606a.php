

<?php $__env->startSection('title', $produk ? 'Edit Produk' : 'Tambah Produk'); ?>

<?php $__env->startSection('content'); ?>
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800"><?php echo e($produk ? 'Edit Produk' : 'Tambah Produk'); ?></h1>
                <p class="text-gray-600"><?php echo e($produk ? 'Perbarui data produk UMKM' : 'Tambah produk UMKM baru'); ?></p>
            </div>
            <a href="<?php echo e(route('admin.produk.index')); ?>"
                class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-xl shadow-sm">
            <form action="<?php echo e($produk ? route('admin.produk.update', $produk->id) : route('admin.produk.store')); ?>"
                method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php if($produk): ?>
                    <?php echo method_field('PUT'); ?>
                <?php endif; ?>

                <div class="p-6 space-y-6">
                    <div class="grid lg:grid-cols-3 gap-6">
                        <!-- Left Column - Image -->
                        <div>
                            <div x-data="{ preview: '<?php echo e($produk && $produk->gambar_utama ? Storage::url($produk->gambar_utama) : ''); ?>' }">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Produk
                                    <?php echo e($produk ? '' : '*'); ?></label>

                                <div class="aspect-square rounded-xl overflow-hidden bg-gray-100 mb-3" x-show="preview">
                                    <img :src="preview" class="w-full h-full object-cover">
                                </div>

                                <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-primary-500 transition cursor-pointer"
                                    onclick="document.getElementById('gambar_utama').click()" x-show="!preview">
                                    <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                                    <p class="text-sm text-gray-600">Klik untuk upload gambar</p>
                                    <p class="text-xs text-gray-400 mt-1">JPG, PNG, WebP (Maks. 5MB)</p>
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

                        <!-- Right Column - Details -->
                        <div class="lg:col-span-2 space-y-6">
                            <div class="grid md:grid-cols-2 gap-6">
                                <!-- Nama -->
                                <div>
                                    <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Produk
                                        *</label>
                                    <input type="text" name="nama" id="nama"
                                        value="<?php echo e(old('nama', $produk->nama ?? '')); ?>" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        placeholder="Masukkan nama produk">
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

                                <!-- Kategori -->
                                <div>
                                    <label for="kategori_id" class="block text-sm font-medium text-gray-700 mb-1">Kategori
                                        *</label>
                                    <select name="kategori_id" id="kategori_id" required
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                        <option value="">Pilih Kategori</option>
                                        <?php $__currentLoopData = $kategoris ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $kat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($kat->id); ?>"
                                                <?php echo e(old('kategori_id', $produk->kategori_id ?? '') == $kat->id ? 'selected' : ''); ?>>
                                                <?php echo e($kat->nama); ?>

                                            </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </div>

                            <div class="grid md:grid-cols-2 gap-6">
                                <!-- Harga -->
                                <div>
                                    <label for="harga" class="block text-sm font-medium text-gray-700 mb-1">Harga (Rp)
                                        *</label>
                                    <input type="number" name="harga" id="harga"
                                        value="<?php echo e(old('harga', $produk->harga ?? '')); ?>" required min="0"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 <?php $__errorArgs = ['harga'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                        placeholder="0">
                                    <?php $__errorArgs = ['harga'];
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

                                <!-- Stok -->
                                <div>
                                    <label for="stok" class="block text-sm font-medium text-gray-700 mb-1">Stok</label>
                                    <input type="number" name="stok" id="stok"
                                        value="<?php echo e(old('stok', $produk->stok ?? '')); ?>" min="0"
                                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                        placeholder="Kosongkan jika tidak terbatas">
                                </div>
                            </div>

                            <!-- Deskripsi -->
                            <div>
                                <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi
                                    *</label>
                                <textarea name="deskripsi" id="deskripsi" rows="4" required
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 <?php $__errorArgs = ['deskripsi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                    placeholder="Jelaskan detail produk..."><?php echo e(old('deskripsi', $produk->deskripsi ?? '')); ?></textarea>
                                <?php $__errorArgs = ['deskripsi'];
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

                    <hr class="border-gray-200">

                    <!-- Seller Info -->
                    <div>
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Informasi Pemilik</h3>
                        <div class="grid md:grid-cols-3 gap-6">
                            <div>
                                <label for="pemilik" class="block text-sm font-medium text-gray-700 mb-1">Nama
                                    Pemilik</label>
                                <input type="text" name="pemilik" id="pemilik"
                                    value="<?php echo e(old('pemilik', $produk->pemilik ?? '')); ?>"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                            </div>
                            <div>
                                <label for="kontak_pemilik" class="block text-sm font-medium text-gray-700 mb-1">No.
                                    Kontak/WhatsApp</label>
                                <input type="text" name="kontak_pemilik" id="kontak_pemilik"
                                    value="<?php echo e(old('kontak_pemilik', $produk->kontak_pemilik ?? '')); ?>"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                    placeholder="628xxxxxxxxxx">
                                <p class="mt-1 text-sm text-gray-500">Format: 628xxxxxxxxxx (tanpa + atau 0)</p>
                            </div>
                            <div>
                                <label for="alamat_pemilik"
                                    class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                                <input type="text" name="alamat_pemilik" id="alamat_pemilik"
                                    value="<?php echo e(old('alamat_pemilik', $produk->alamat_pemilik ?? '')); ?>"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                    placeholder="Alamat pemilik">
                            </div>
                        </div>
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" value="1"
                                <?php echo e(old('is_active', $produk->is_active ?? true) ? 'checked' : ''); ?>

                                class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                            <span class="ml-2 text-gray-700">Aktif (Tampilkan produk di website)</span>
                        </label>
                    </div>
                </div>

                <!-- Footer -->
                <div
                    class="px-6 py-4 bg-gray-50 border-t border-gray-200 rounded-b-xl flex items-center justify-end gap-3">
                    <a href="<?php echo e(route('admin.produk.index')); ?>"
                        class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition">
                        <i class="fas fa-save mr-2"></i>
                        <?php echo e($produk ? 'Update' : 'Simpan'); ?>

                    </button>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\website-desa-tanalum\resources\views/admin/produk/form.blade.php ENDPATH**/ ?>
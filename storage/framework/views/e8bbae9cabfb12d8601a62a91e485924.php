

<?php $__env->startSection('title', isset($wisata) ? 'Edit Wisata' : 'Tambah Wisata'); ?>

<?php $__env->startSection('content'); ?>
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800"><?php echo e(isset($wisata) ? 'Edit Wisata' : 'Tambah Wisata'); ?></h1>
                <p class="text-gray-600">
                    <?php echo e(isset($wisata) ? 'Perbarui data destinasi wisata' : 'Tambah destinasi wisata baru'); ?></p>
            </div>
            <a href="<?php echo e(route('admin.wisata.index')); ?>"
                class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>

        <!-- Form -->
        <div class="bg-white rounded-xl shadow-sm">
            <form action="<?php echo e(isset($wisata) ? route('admin.wisata.update', $wisata->id) : route('admin.wisata.store')); ?>"
                method="POST" enctype="multipart/form-data">
                <?php echo csrf_field(); ?>
                <?php if(isset($wisata)): ?>
                    <?php echo method_field('PUT'); ?>
                <?php endif; ?>

                <div class="p-6 space-y-6">
                    <div class="grid md:grid-cols-2 gap-6">
                        <!-- Nama -->
                        <div>
                            <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama Wisata *</label>
                            <input type="text" name="nama" id="nama"
                                value="<?php echo e(old('nama', $wisata->nama ?? '')); ?>" required
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 <?php $__errorArgs = ['nama'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                placeholder="Nama destinasi wisata">
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
                            <label for="kategori" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                            <select name="kategori" id="kategori"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500">
                                <option value="">Pilih Kategori</option>
                                <option value="Alam"
                                    <?php echo e(old('kategori', $wisata->kategori ?? '') == 'Alam' ? 'selected' : ''); ?>>Wisata Alam
                                </option>
                                <option value="Budaya"
                                    <?php echo e(old('kategori', $wisata->kategori ?? '') == 'Budaya' ? 'selected' : ''); ?>>Wisata
                                    Budaya</option>
                                <option value="Religi"
                                    <?php echo e(old('kategori', $wisata->kategori ?? '') == 'Religi' ? 'selected' : ''); ?>>Wisata
                                    Religi</option>
                                <option value="Kuliner"
                                    <?php echo e(old('kategori', $wisata->kategori ?? '') == 'Kuliner' ? 'selected' : ''); ?>>Wisata
                                    Kuliner</option>
                                <option value="Edukasi"
                                    <?php echo e(old('kategori', $wisata->kategori ?? '') == 'Edukasi' ? 'selected' : ''); ?>>Wisata
                                    Edukasi</option>
                                <option value="Lainnya"
                                    <?php echo e(old('kategori', $wisata->kategori ?? '') == 'Lainnya' ? 'selected' : ''); ?>>Lainnya
                                </option>
                            </select>
                        </div>
                    </div>

                    <!-- Gambar Utama -->
                    <div x-data="{ preview: '<?php echo e(isset($wisata) && $wisata->gambar_utama ? Storage::url($wisata->gambar_utama) : ''); ?>' }">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Gambar Utama
                            <?php echo e(isset($wisata) ? '' : '*'); ?></label>

                        <div class="aspect-video max-w-xl rounded-xl overflow-hidden bg-gray-100 mb-3" x-show="preview">
                            <img :src="preview" class="w-full h-full object-cover">
                        </div>

                        <div class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:border-primary-500 transition cursor-pointer max-w-xl"
                            onclick="document.getElementById('gambar').click()" x-show="!preview">
                            <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                            <p class="text-gray-600">Klik untuk upload gambar</p>
                            <p class="text-sm text-gray-400 mt-1">JPG, PNG, WebP (Maks. 5MB)</p>
                        </div>

                        <input type="file" name="gambar" id="gambar" accept="image/*" class="hidden"
                            @change="preview = URL.createObjectURL($event.target.files[0])">

                        <button type="button" x-show="preview"
                            @click="preview = ''; document.getElementById('gambar').value = ''"
                            class="mt-2 text-sm text-red-600 hover:text-red-700 flex items-center gap-1">
                            <i class="fas fa-times"></i> Hapus & Ganti gambar
                        </button>

                        <?php $__errorArgs = ['gambar'];
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

                    <!-- Deskripsi -->
                    <div>
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi *</label>
                        <textarea name="deskripsi" id="deskripsi" rows="6" required
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 <?php $__errorArgs = ['deskripsi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                            placeholder="Jelaskan tentang destinasi wisata ini..."><?php echo e(old('deskripsi', $wisata->deskripsi ?? '')); ?></textarea>
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

                    <div class="grid md:grid-cols-3 gap-6">
                        <!-- Lokasi -->
                        <div>
                            <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-1">Lokasi/Alamat</label>
                            <input type="text" name="lokasi" id="lokasi"
                                value="<?php echo e(old('lokasi', $wisata->lokasi ?? '')); ?>"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                placeholder="Alamat lengkap">
                        </div>

                        <!-- Koordinat -->
                        <div>
                            <label for="koordinat" class="block text-sm font-medium text-gray-700 mb-1">Koordinat (Lat, Lng)</label>
                            <input type="text" name="koordinat" id="koordinat"
                                value="<?php echo e(old('koordinat', isset($wisata) && $wisata->latitude ? $wisata->latitude . ', ' . $wisata->longitude : '')); ?>"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                placeholder="-0.xxxx, 117.xxxx">
                        </div>

                        <!-- Harga Tiket -->
                        <div>
                            <label for="harga_tiket" class="block text-sm font-medium text-gray-700 mb-1">Harga Tiket (Rp)</label>
                            <input type="number" name="harga_tiket" id="harga_tiket"
                                value="<?php echo e(old('harga_tiket', $wisata->harga_tiket ?? '')); ?>" min="0"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                placeholder="Kosongkan jika gratis">
                        </div>
                    </div>

                    <div class="grid md:grid-cols-3 gap-6">
                        <!-- Jam Buka -->
                        <div>
                            <label for="jam_buka" class="block text-sm font-medium text-gray-700 mb-1">Jam Buka</label>
                            <input type="text" name="jam_buka" id="jam_buka"
                                value="<?php echo e(old('jam_buka', $wisata->jam_buka ?? '')); ?>"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                placeholder="Contoh: 08:00">
                        </div>

                        <!-- Jam Tutup -->
                        <div>
                            <label for="jam_tutup" class="block text-sm font-medium text-gray-700 mb-1">Jam Tutup</label>
                            <input type="text" name="jam_tutup" id="jam_tutup"
                                value="<?php echo e(old('jam_tutup', $wisata->jam_tutup ?? '')); ?>"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                placeholder="Contoh: 17:00">
                        </div>

                        <!-- Kontak -->
                        <div>
                            <label for="kontak" class="block text-sm font-medium text-gray-700 mb-1">Kontak</label>
                            <input type="text" name="kontak" id="kontak"
                                value="<?php echo e(old('kontak', $wisata->kontak ?? '')); ?>"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                placeholder="No. HP/WA pengelola">
                        </div>
                    </div>

                    <!-- Fasilitas -->
                    <div>
                        <label for="fasilitas" class="block text-sm font-medium text-gray-700 mb-1">Fasilitas</label>
                        <input type="text" name="fasilitas" id="fasilitas"
                            value="<?php echo e(old('fasilitas', isset($wisata->fasilitas) && is_array($wisata->fasilitas) ? implode(', ', $wisata->fasilitas) : '')); ?>"
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                            placeholder="Parkir, Toilet, Mushola, Warung">
                        <p class="mt-1 text-sm text-gray-500">Pisahkan dengan koma</p>
                    </div>

                    <!-- Status -->
                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="is_active" value="1"
                                <?php echo e(old('is_active', $wisata->is_active ?? true) ? 'checked' : ''); ?>

                                class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                            <span class="ml-2 text-gray-700">Aktif (Tampilkan di website)</span>
                        </label>
                    </div>
                </div>

                <!-- Footer -->
                <div
                    class="px-6 py-4 bg-gray-50 border-t border-gray-200 rounded-b-xl flex items-center justify-end gap-3">
                    <a href="<?php echo e(route('admin.wisata.index')); ?>"
                        class="px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition">
                        Batal
                    </a>
                    <button type="submit"
                        class="px-6 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition">
                        <i class="fas fa-save mr-2"></i>
                        <?php echo e(isset($wisata) ? 'Update' : 'Simpan'); ?>

                    </button>
                </div>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\website-desa-tanalum\resources\views/admin/wisata/form.blade.php ENDPATH**/ ?>
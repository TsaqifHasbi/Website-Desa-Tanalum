

<?php $__env->startSection('title', 'Form Permohonan Informasi - PPID'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Header -->
    <section class="bg-gradient-to-r from-green-600 to-green-700 py-12">
        <div class="container mx-auto px-4">
            <nav class="text-sm text-green-100 mb-4">
                <a href="<?php echo e(route('home')); ?>" class="hover:text-white">Home</a>
                <span class="mx-2">/</span>
                <a href="<?php echo e(route('ppid.index')); ?>" class="hover:text-white">PPID</a>
                <span class="mx-2">/</span>
                <span class="text-white">Permohonan Informasi</span>
            </nav>
            <h1 class="text-3xl md:text-4xl font-bold text-white">Form Permohonan Informasi</h1>
            <p class="text-green-100 mt-2">Ajukan permohonan informasi publik kepada PPID Desa Tanalum</p>
        </div>
    </section>

    <!-- Form Section -->
    <section class="py-12 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="max-w-3xl mx-auto">
                <?php if(session('success')): ?>
                    <div class="mb-6 p-4 bg-green-100 border border-green-200 text-green-700 rounded-lg">
                        <div class="flex items-center">
                            <i class="fas fa-check-circle text-xl mr-3"></i>
                            <div>
                                <p class="font-semibold">Permohonan Berhasil Dikirim!</p>
                                <p class="text-sm"><?php echo e(session('success')); ?></p>
                                <?php if(session('nomor_tiket')): ?>
                                    <p class="text-sm mt-2">Nomor Tiket: <strong><?php echo e(session('nomor_tiket')); ?></strong></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>

                <div class="bg-white rounded-xl shadow-sm p-8">
                    <form action="<?php echo e(route('ppid.permohonan.submit')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>

                        <div class="space-y-6">
                            <!-- Data Pemohon -->
                            <div class="border-b pb-6">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                                    <i class="fas fa-user text-green-600 mr-2"></i>
                                    Data Pemohon
                                </h3>

                                <div class="grid md:grid-cols-2 gap-4">
                                    <div>
                                        <label for="nama_pemohon" class="block text-sm font-medium text-gray-700 mb-1">Nama
                                            Lengkap *</label>
                                        <input type="text" name="nama_pemohon" id="nama_pemohon" value="<?php echo e(old('nama_pemohon')); ?>"
                                            required
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 <?php $__errorArgs = ['nama_pemohon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                        <?php $__errorArgs = ['nama_pemohon'];
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
                                        <label for="nik" class="block text-sm font-medium text-gray-700 mb-1">NIK
                                            *</label>
                                        <input type="text" name="nik" id="nik" value="<?php echo e(old('nik')); ?>"
                                            required maxlength="16"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 <?php $__errorArgs = ['nik'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            placeholder="16 digit NIK">
                                        <?php $__errorArgs = ['nik'];
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
                                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email
                                            *</label>
                                        <input type="email" name="email" id="email" value="<?php echo e(old('email')); ?>"
                                            required
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                        <?php $__errorArgs = ['email'];
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
                                        <label for="telepon" class="block text-sm font-medium text-gray-700 mb-1">No.
                                            Telepon/HP *</label>
                                        <input type="text" name="telepon" id="telepon" value="<?php echo e(old('telepon')); ?>"
                                            required
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 <?php $__errorArgs = ['telepon'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>">
                                        <?php $__errorArgs = ['telepon'];
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

                                    <div class="md:col-span-2">
                                        <label for="alamat" class="block text-sm font-medium text-gray-700 mb-1">Alamat
                                            *</label>
                                        <textarea name="alamat" id="alamat" rows="2" required
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 <?php $__errorArgs = ['alamat'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"><?php echo e(old('alamat')); ?></textarea>
                                        <?php $__errorArgs = ['alamat'];
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
                                        <label for="pekerjaan"
                                            class="block text-sm font-medium text-gray-700 mb-1">Pekerjaan</label>
                                        <input type="text" name="pekerjaan" id="pekerjaan"
                                            value="<?php echo e(old('pekerjaan')); ?>"
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500">
                                    </div>
                                </div>
                            </div>

                            <!-- Rincian Informasi -->
                            <div class="border-b pb-6">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                                    <i class="fas fa-file-alt text-green-600 mr-2"></i>
                                    Rincian Informasi yang Dimohon
                                </h3>

                                <div class="space-y-4">


                                    <div>
                                        <label for="informasi_diminta"
                                            class="block text-sm font-medium text-gray-700 mb-1">Rincian Informasi yang
                                            Dibutuhkan *</label>
                                        <textarea name="informasi_diminta" id="informasi_diminta" rows="4" required
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 <?php $__errorArgs = ['informasi_diminta'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            placeholder="Jelaskan secara detail informasi yang Anda butuhkan..."><?php echo e(old('informasi_diminta')); ?></textarea>
                                        <?php $__errorArgs = ['informasi_diminta'];
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
                                        <label for="alasan_permohonan" class="block text-sm font-medium text-gray-700 mb-1">Tujuan
                                            Penggunaan Informasi *</label>
                                        <textarea name="alasan_permohonan" id="alasan_permohonan" rows="3" required
                                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500 <?php $__errorArgs = ['alasan_permohonan'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                            placeholder="Jelaskan tujuan penggunaan informasi..."><?php echo e(old('alasan_permohonan')); ?></textarea>
                                        <?php $__errorArgs = ['alasan_permohonan'];
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

                            <!-- Cara Memperoleh Informasi -->
                            <div class="border-b pb-6">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                                    <i class="fas fa-paper-plane text-green-600 mr-2"></i>
                                    Cara Memperoleh Informasi
                                </h3>

                                <div class="space-y-3">
                                    <label
                                        class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer">
                                        <input type="radio" name="cara_memperoleh" value="melihat"
                                            <?php echo e(old('cara_memperoleh', 'melihat') == 'melihat' ? 'checked' : ''); ?>

                                            class="w-4 h-4 text-green-600 border-gray-300 focus:ring-green-500">
                                        <span class="ml-3 text-gray-700">Melihat/Membaca/Mendengarkan/Mencatat</span>
                                    </label>
                                    <label
                                        class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer">
                                        <input type="radio" name="cara_memperoleh" value="mendapat_salinan"
                                            <?php echo e(old('cara_memperoleh') == 'mendapat_salinan' ? 'checked' : ''); ?>

                                            class="w-4 h-4 text-green-600 border-gray-300 focus:ring-green-500">
                                        <span class="ml-3 text-gray-700">Mendapatkan salinan informasi
                                            (softcopy/hardcopy)</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Cara Mendapat Salinan -->
                            <div class="border-b pb-6">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                                    <i class="fas fa-inbox text-green-600 mr-2"></i>
                                    Cara Mendapatkan Salinan Informasi
                                </h3>

                                <div class="space-y-3">
                                    <label
                                        class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer">
                                        <input type="radio" name="cara_mendapat_salinan" value="ambil_langsung"
                                            <?php echo e(old('cara_mendapat_salinan', 'ambil_langsung') == 'ambil_langsung' ? 'checked' : ''); ?>

                                            class="w-4 h-4 text-green-600 border-gray-300 focus:ring-green-500">
                                        <span class="ml-3 text-gray-700">Mengambil langsung di kantor desa</span>
                                    </label>
                                    <label
                                        class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer">
                                        <input type="radio" name="cara_mendapat_salinan" value="email"
                                            <?php echo e(old('cara_mendapat_salinan') == 'email' ? 'checked' : ''); ?>

                                            class="w-4 h-4 text-green-600 border-gray-300 focus:ring-green-500">
                                        <span class="ml-3 text-gray-700">Dikirim via email</span>
                                    </label>
                                    <label
                                        class="flex items-center p-3 border border-gray-200 rounded-lg hover:bg-gray-50 cursor-pointer">
                                        <input type="radio" name="cara_mendapat_salinan" value="pos"
                                            <?php echo e(old('cara_mendapat_salinan') == 'pos' ? 'checked' : ''); ?>

                                            class="w-4 h-4 text-green-600 border-gray-300 focus:ring-green-500">
                                        <span class="ml-3 text-gray-700">Dikirim via pos/kurir</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Dokumen Pendukung -->
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                                    <i class="fas fa-upload text-green-600 mr-2"></i>
                                    Dokumen Pendukung (Opsional)
                                </h3>

                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center">
                                    <input type="file" name="dokumen_pendukung" id="dokumen_pendukung" class="hidden"
                                        accept=".pdf,.jpg,.jpeg,.png">
                                    <label for="dokumen_pendukung" class="cursor-pointer">
                                        <i class="fas fa-cloud-upload-alt text-4xl text-gray-400 mb-2"></i>
                                        <p class="text-gray-600">Klik untuk upload dokumen pendukung</p>
                                        <p class="text-sm text-gray-400 mt-1">PDF, JPG, PNG (Maks. 5MB)</p>
                                    </label>
                                </div>
                            </div>

                            <!-- Submit -->
                            <div class="flex items-center justify-between pt-6 border-t">
                                <a href="<?php echo e(route('ppid.index')); ?>"
                                    class="px-6 py-3 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition">
                                    <i class="fas fa-arrow-left mr-2"></i>
                                    Kembali
                                </a>
                                <button type="submit"
                                    class="px-8 py-3 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition">
                                    <i class="fas fa-paper-plane mr-2"></i>
                                    Kirim Permohonan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <!-- Information Box -->
                <div class="mt-8 bg-blue-50 rounded-xl p-6">
                    <h4 class="font-semibold text-blue-800 mb-3">
                        <i class="fas fa-info-circle mr-2"></i>
                        Informasi Penting
                    </h4>
                    <ul class="text-blue-700 text-sm space-y-2">
                        <li>• Permohonan informasi akan diproses dalam waktu 10 hari kerja sejak diterima.</li>
                        <li>• Anda akan menerima notifikasi melalui email yang didaftarkan.</li>
                        <li>• Pastikan data yang diisi benar dan valid.</li>
                        <li>• Untuk informasi lebih lanjut, hubungi kantor desa.</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\website-desa-tanalum\resources\views/ppid/permohonan.blade.php ENDPATH**/ ?>
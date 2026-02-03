

<?php $__env->startSection('title', isset($cerita) ? 'Edit Cerita Rakyat' : 'Tambah Cerita Rakyat'); ?>

<?php $__env->startSection('content'); ?>
    <div class="space-y-6">
        <!-- Header -->
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-gray-800"><?php echo e(isset($cerita) ? 'Edit Cerita Rakyat' : 'Tambah Cerita Rakyat'); ?></h1>
                <p class="text-gray-600"><?php echo e(isset($cerita) ? 'Perbarui konten cerita rakyat' : 'Buat cerita rakyat baru dengan gambar'); ?></p>
            </div>
            <a href="<?php echo e(route('admin.sejarah.index')); ?>"
                class="inline-flex items-center px-4 py-2 bg-gray-200 hover:bg-gray-300 text-gray-700 font-medium rounded-lg transition">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>

        <!-- Form -->
        <form action="<?php echo e(isset($cerita) ? route('admin.sejarah.cerita.update', $cerita) : route('admin.sejarah.cerita.store')); ?>" 
            method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <?php if(isset($cerita)): ?>
                <?php echo method_field('PUT'); ?>
            <?php endif; ?>

            <div class="grid lg:grid-cols-3 gap-6">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <!-- Judul -->
                        <div class="mb-6">
                            <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul Cerita *</label>
                            <input type="text" name="judul" id="judul"
                                value="<?php echo e(old('judul', $cerita->judul ?? '')); ?>" required
                                class="w-full px-4 py-3 text-lg border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 <?php $__errorArgs = ['judul'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                placeholder="Contoh: Cikal Bakal Desa Tanalum">
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
                            <textarea name="konten" id="konten" rows="20"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500 <?php $__errorArgs = ['konten'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> border-red-500 <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>"
                                placeholder="Tulis konten cerita rakyat di sini..."><?php echo e(old('konten', $cerita->konten ?? '')); ?></textarea>
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
                            <p class="mt-2 text-sm text-gray-500">
                                <i class="fas fa-info-circle mr-1"></i>
                                Gunakan toolbar di atas untuk menambahkan gambar ke dalam konten cerita
                            </p>
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
                                    value="<?php echo e(old('urutan', $cerita->urutan ?? 0)); ?>"
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-primary-500"
                                    min="0">
                                <p class="mt-1 text-sm text-gray-500">Semakin kecil semakin atas</p>
                            </div>

                            <div>
                                <label class="flex items-center">
                                    <input type="checkbox" name="is_active" value="1"
                                        <?php echo e(old('is_active', $cerita->is_active ?? true) ? 'checked' : ''); ?>

                                        class="w-4 h-4 text-primary-600 border-gray-300 rounded focus:ring-primary-500">
                                    <span class="ml-2 text-gray-700">Aktif (Tampilkan di website)</span>
                                </label>
                            </div>
                        </div>

                        <div class="mt-6 pt-4 border-t border-gray-200">
                            <button type="submit"
                                class="w-full px-4 py-2 bg-primary-600 hover:bg-primary-700 text-white font-medium rounded-lg transition">
                                <i class="fas fa-save mr-2"></i>
                                <?php echo e(isset($cerita) ? 'Update Cerita' : 'Simpan Cerita'); ?>

                            </button>
                        </div>
                    </div>

                    <!-- Featured Image -->
                    <div class="bg-white rounded-xl shadow-sm p-6">
                        <h3 class="font-semibold text-gray-800 mb-4">Gambar Utama (Header)</h3>

                        <div x-data="{ preview: '<?php echo e(isset($cerita) && $cerita->gambar_utama ? Storage::url($cerita->gambar_utama) : ''); ?>' }">
                            <div class="aspect-video rounded-lg overflow-hidden bg-gray-100 mb-3" x-show="preview">
                                <img :src="preview" class="w-full h-full object-cover">
                            </div>

                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-primary-500 transition cursor-pointer"
                                onclick="document.getElementById('gambar_utama').click()" x-show="!preview">
                                <i class="fas fa-image text-3xl text-gray-400 mb-2"></i>
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
                        <p class="mt-3 text-sm text-gray-500">
                            <i class="fas fa-lightbulb mr-1 text-yellow-500"></i>
                            Gambar ini akan ditampilkan di bagian atas cerita
                        </p>
                    </div>
                </div>
            </div>
        </form>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('styles'); ?>
<style>
    .cke_editable {
        font-family: 'Inter', sans-serif !important;
        font-size: 16px !important;
        line-height: 1.6 !important;
        padding: 20px !important;
    }
    .cke_editable img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 16px 0;
    }
    .cke_chrome {
        border-radius: 0.5rem !important;
        border-color: #d1d5db !important;
    }
    .cke_top {
        border-radius: 0.5rem 0.5rem 0 0 !important;
        background: #f9fafb !important;
    }
    .cke_bottom {
        border-radius: 0 0 0.5rem 0.5rem !important;
    }
</style>
<?php $__env->stopPush(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="https://cdn.ckeditor.com/4.22.1/full/ckeditor.js"></script>
<script>
    CKEDITOR.replace('konten', {
        height: 400,
        language: 'id',
        filebrowserUploadUrl: '<?php echo e(route("admin.sejarah.upload-image")); ?>',
        filebrowserUploadMethod: 'form',
        toolbarGroups: [
            { name: 'document', groups: ['mode', 'document', 'doctools'] },
            { name: 'clipboard', groups: ['clipboard', 'undo'] },
            '/',
            { name: 'basicstyles', groups: ['basicstyles', 'cleanup'] },
            { name: 'paragraph', groups: ['list', 'indent', 'blocks', 'align', 'bidi', 'paragraph'] },
            '/',
            { name: 'styles', groups: ['styles'] },
            { name: 'colors', groups: ['colors'] },
            { name: 'links', groups: ['links'] },
            { name: 'insert', groups: ['insert'] },
            { name: 'tools', groups: ['tools'] },
            { name: 'others', groups: ['others'] }
        ],
        removeButtons: 'Save,NewPage,ExportPdf,Preview,Print,Templates,PasteFromWord,Find,Replace,SelectAll,Scayt,Form,Checkbox,Radio,TextField,Textarea,Select,Button,ImageButton,HiddenField,Flash,Smiley,PageBreak,Iframe,About,ShowBlocks,Language,BidiRtl,BidiLtr,Anchor',
        extraPlugins: 'uploadimage',
        uploadUrl: '<?php echo e(route("admin.sejarah.upload-image")); ?>?responseType=json',
        imageUploadUrl: '<?php echo e(route("admin.sejarah.upload-image")); ?>?responseType=json',
        contentsCss: ['https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap'],
        font_names: 'Inter/Inter, sans-serif;' + CKEDITOR.config.font_names,
        fontSize_sizes: '10/10px;12/12px;14/14px;16/16px;18/18px;20/20px;24/24px;28/28px;32/32px;36/36px;',
        on: {
            fileUploadRequest: function(evt) {
                var fileLoader = evt.data.fileLoader;
                var formData = new FormData();
                var xhr = fileLoader.xhr;
                
                xhr.open('POST', '<?php echo e(route("admin.sejarah.upload-image")); ?>', true);
                xhr.setRequestHeader('X-CSRF-TOKEN', '<?php echo e(csrf_token()); ?>');
                
                formData.append('file', fileLoader.file, fileLoader.fileName);
                fileLoader.xhr.send(formData);
                
                evt.stop();
            },
            fileUploadResponse: function(evt) {
                evt.stop();
                
                var data = evt.data;
                var response = JSON.parse(evt.data.fileLoader.xhr.responseText);
                
                if (response.location) {
                    data.url = response.location;
                } else {
                    data.message = response.error || 'Upload gagal';
                    evt.cancel();
                }
            }
        }
    });
</script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\website-desa-tanalum\resources\views/admin/sejarah-desa/cerita/form.blade.php ENDPATH**/ ?>
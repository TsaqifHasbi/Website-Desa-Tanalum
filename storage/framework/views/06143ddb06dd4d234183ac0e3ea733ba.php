

<?php $__env->startSection('title', 'Struktur Organisasi'); ?>

<?php $__env->startSection('content'); ?>
    <!-- Hero Section -->
    <section class="relative py-20 bg-gradient-to-r from-primary-600 to-primary-700">
        <div class="container mx-auto px-4">
            <div class="text-center text-white">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Struktur Organisasi</h1>
                <p class="text-lg text-primary-100">Pemerintah <?php echo e($profil->nama_desa ?? 'Desa Tanalum'); ?></p>
            </div>
        </div>
    </section>

    <!-- Breadcrumb -->
    <div class="bg-white shadow-sm">
        <div class="container mx-auto px-4">
            <nav class="flex items-center space-x-2 py-4 text-sm">
                <a href="<?php echo e(route('home')); ?>" class="text-gray-500 hover:text-primary-600">Beranda</a>
                <span class="text-gray-400">/</span>
                <a href="<?php echo e(route('profil.index')); ?>" class="text-gray-500 hover:text-primary-600">Profil Desa</a>
                <span class="text-gray-400">/</span>
                <span class="text-primary-600 font-medium">Struktur Organisasi</span>
            </nav>
        </div>
    </div>

    <!-- Content -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4 overflow-x-auto">
            <?php
                $sekretaris = $aparaturs->first(fn($i) => stripos($i->jabatan, 'Sekretaris') !== false);
                $kaur = $aparaturs->filter(fn($i) => 
                    (stripos($i->jabatan, 'Kaur') !== false || stripos($i->jabatan, 'Urusan') !== false) && 
                    stripos($i->jabatan, 'Sekretaris') === false && stripos($i->jabatan, 'Kepala Desa') === false
                )->values();
                $kasi = $aparaturs->filter(fn($i) => 
                    (stripos($i->jabatan, 'Kasi') !== false || stripos($i->jabatan, 'Seksi') !== false)
                )->values();
                $kadus = $aparaturs->filter(fn($i) => 
                    stripos($i->jabatan, 'Kadus') !== false || stripos($i->jabatan, 'Dusun') !== false || stripos($i->jabatan, 'Wilayah') !== false
                )->values();
            ?>

            <style>
                .org-chart {
                    position: relative;
                    width: 1100px;
                    height: 650px;
                    margin: 0 auto;
                }
                .org-box {
                    position: absolute;
                    border-radius: 12px;
                    padding: 12px 16px;
                    color: #fff;
                    text-align: center;
                    box-shadow: 0 4px 20px rgba(0,0,0,0.15);
                }
                .org-box .photo {
                    width: 50px;
                    height: 50px;
                    border-radius: 50%;
                    margin: 0 auto 8px;
                    border: 3px solid rgba(255,255,255,0.5);
                    overflow: hidden;
                    background: rgba(255,255,255,0.2);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }
                .org-box .photo img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                }
                .org-box .photo i {
                    font-size: 24px;
                    opacity: 0.8;
                }
                .org-box .name { font-weight: 700; font-size: 13px; margin-bottom: 2px; }
                .org-box .title { font-size: 11px; opacity: 0.9; }
                .org-box-sm {
                    position: absolute;
                    border-radius: 10px;
                    padding: 10px 12px;
                    color: #fff;
                    text-align: center;
                    box-shadow: 0 3px 15px rgba(0,0,0,0.12);
                }
                .org-box-sm .photo {
                    width: 36px;
                    height: 36px;
                    border-radius: 50%;
                    margin: 0 auto 6px;
                    border: 2px solid rgba(255,255,255,0.5);
                    overflow: hidden;
                    background: rgba(255,255,255,0.2);
                    display: flex;
                    align-items: center;
                    justify-content: center;
                }
                .org-box-sm .photo img {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                }
                .org-box-sm .photo i {
                    font-size: 16px;
                    opacity: 0.8;
                }
                .org-box-sm .name { font-weight: 600; font-size: 11px; margin-bottom: 2px; }
                .org-box-sm .title { font-size: 9px; opacity: 0.9; }
                .bg-kades { background: linear-gradient(135deg, #0891b2, #0e7490); }
                .bg-bpd { background: linear-gradient(135deg, #10b981, #059669); }
                .bg-sekdes { background: linear-gradient(135deg, #f97316, #ea580c); }
                .bg-kaur { background: linear-gradient(135deg, #fbbf24, #d97706); }
                .bg-kasi { background: linear-gradient(135deg, #3b82f6, #2563eb); }
                .bg-kadus { background: linear-gradient(135deg, #8b5cf6, #7c3aed); }
                .line { position: absolute; background: #6b7280; }
                .line-dash { position: absolute; border-top: 2px dashed #9ca3af; }
            </style>

            <div class="org-chart">
                
                
                
                
                <div class="org-box bg-kades" style="left: 440px; top: 0; width: 170px;">
                    <div class="photo">
                        <?php if($kepalaDesa && $kepalaDesa->foto): ?>
                            <img src="<?php echo e(Storage::url($kepalaDesa->foto)); ?>" alt="<?php echo e($kepalaDesa->nama); ?>">
                        <?php else: ?>
                            <i class="fas fa-user"></i>
                        <?php endif; ?>
                    </div>
                    <div class="name"><?php echo e($kepalaDesa->nama ?? 'Kepala Desa'); ?></div>
                    <div class="title">Kepala Desa</div>
                </div>
                
                
                <div class="line-dash" style="left: 615px; top: 50px; width: 50px;"></div>
                
                
                <div class="org-box bg-bpd" style="left: 670px; top: 0; width: 180px;">
                    <div class="photo">
                        <i class="fas fa-users"></i>
                    </div>
                    <div class="name">BPD</div>
                    <div class="title">Badan Permusyawaratan Desa</div>
                </div>
                
                
                
                
                <div class="line" style="left: 524px; top: 120px; width: 2px; height: 55px;"></div>
                
                
                
                
                <div class="line" style="left: 170px; top: 160px; width: 760px; height: 2px;"></div>
                
                
                
                
                <div class="line" style="left: 170px; top: 160px; width: 2px; height: 30px;"></div>
                <div class="org-box bg-sekdes" style="left: 80px; top: 190px; width: 180px;">
                    <div class="photo">
                        <?php if($sekretaris && $sekretaris->foto): ?>
                            <img src="<?php echo e(Storage::url($sekretaris->foto)); ?>" alt="<?php echo e($sekretaris->nama); ?>">
                        <?php else: ?>
                            <i class="fas fa-user"></i>
                        <?php endif; ?>
                    </div>
                    <div class="name"><?php echo e($sekretaris->nama ?? 'Sekretaris'); ?></div>
                    <div class="title">Sekretaris Desa</div>
                </div>
                
                
                <div class="line" style="left: 170px; top: 310px; width: 2px; height: 45px;"></div>
                
                
                <div class="line" style="left: 30px; top: 340px; width: 285px; height: 2px;"></div>
                
                
                <div class="line" style="left: 30px; top: 340px; width: 2px; height: 25px;"></div>
                <div class="org-box-sm bg-kaur" style="left: -30px; top: 365px; width: 120px;">
                    <div class="photo">
                        <?php if(isset($kaur[0]) && $kaur[0]->foto): ?>
                            <img src="<?php echo e(Storage::url($kaur[0]->foto)); ?>" alt="<?php echo e($kaur[0]->nama); ?>">
                        <?php else: ?>
                            <i class="fas fa-user"></i>
                        <?php endif; ?>
                    </div>
                    <div class="name"><?php echo e($kaur[0]->nama ?? '-'); ?></div>
                    <div class="title"><?php echo e($kaur[0]->jabatan ?? 'Kaur TU & Umum'); ?></div>
                </div>
                
                
                <div class="line" style="left: 170px; top: 340px; width: 2px; height: 25px;"></div>
                <div class="org-box-sm bg-kaur" style="left: 110px; top: 365px; width: 120px;">
                    <div class="photo">
                        <?php if(isset($kaur[1]) && $kaur[1]->foto): ?>
                            <img src="<?php echo e(Storage::url($kaur[1]->foto)); ?>" alt="<?php echo e($kaur[1]->nama); ?>">
                        <?php else: ?>
                            <i class="fas fa-user"></i>
                        <?php endif; ?>
                    </div>
                    <div class="name"><?php echo e($kaur[1]->nama ?? '-'); ?></div>
                    <div class="title"><?php echo e($kaur[1]->jabatan ?? 'Kaur Keuangan'); ?></div>
                </div>
                
                
                <div class="line" style="left: 315px; top: 340px; width: 2px; height: 25px;"></div>
                <div class="org-box-sm bg-kaur" style="left: 255px; top: 365px; width: 120px;">
                    <div class="photo">
                        <?php if(isset($kaur[2]) && $kaur[2]->foto): ?>
                            <img src="<?php echo e(Storage::url($kaur[2]->foto)); ?>" alt="<?php echo e($kaur[2]->nama); ?>">
                        <?php else: ?>
                            <i class="fas fa-user"></i>
                        <?php endif; ?>
                    </div>
                    <div class="name"><?php echo e($kaur[2]->nama ?? '-'); ?></div>
                    <div class="title"><?php echo e($kaur[2]->jabatan ?? 'Kaur Perencanaan'); ?></div>
                </div>
                
                
                
                
                
                <div class="line" style="left: 650px; top: 160px; width: 2px; height: 30px;"></div>
                <div class="org-box-sm bg-kasi" style="left: 585px; top: 190px; width: 130px;">
                    <div class="photo">
                        <?php if(isset($kasi[0]) && $kasi[0]->foto): ?>
                            <img src="<?php echo e(Storage::url($kasi[0]->foto)); ?>" alt="<?php echo e($kasi[0]->nama); ?>">
                        <?php else: ?>
                            <i class="fas fa-user"></i>
                        <?php endif; ?>
                    </div>
                    <div class="name"><?php echo e($kasi[0]->nama ?? '-'); ?></div>
                    <div class="title"><?php echo e($kasi[0]->jabatan ?? 'Kasi Pemerintahan'); ?></div>
                </div>
                
                
                <div class="line" style="left: 790px; top: 160px; width: 2px; height: 30px;"></div>
                <div class="org-box-sm bg-kasi" style="left: 725px; top: 190px; width: 130px;">
                    <div class="photo">
                        <?php if(isset($kasi[1]) && $kasi[1]->foto): ?>
                            <img src="<?php echo e(Storage::url($kasi[1]->foto)); ?>" alt="<?php echo e($kasi[1]->nama); ?>">
                        <?php else: ?>
                            <i class="fas fa-user"></i>
                        <?php endif; ?>
                    </div>
                    <div class="name"><?php echo e($kasi[1]->nama ?? '-'); ?></div>
                    <div class="title"><?php echo e($kasi[1]->jabatan ?? 'Kasi Pelayanan'); ?></div>
                </div>
                
                
                <div class="line" style="left: 930px; top: 160px; width: 2px; height: 30px;"></div>
                <div class="org-box-sm bg-kasi" style="left: 865px; top: 190px; width: 130px;">
                    <div class="photo">
                        <?php if(isset($kasi[2]) && $kasi[2]->foto): ?>
                            <img src="<?php echo e(Storage::url($kasi[2]->foto)); ?>" alt="<?php echo e($kasi[2]->nama); ?>">
                        <?php else: ?>
                            <i class="fas fa-user"></i>
                        <?php endif; ?>
                    </div>
                    <div class="name"><?php echo e($kasi[2]->nama ?? '-'); ?></div>
                    <div class="title"><?php echo e($kasi[2]->jabatan ?? 'Kasi Kesejahteraan'); ?></div>
                </div>
                
                
                
                
                <div class="line" style="left: 524px; top: 160px; width: 2px; height: 360px;"></div>
                
                
                <div class="line" style="left: 150px; top: 520px; width: 750px; height: 2px;"></div>
                
                
                <div class="line" style="left: 150px; top: 520px; width: 2px; height: 25px;"></div>
                <div class="org-box-sm bg-kadus" style="left: 80px; top: 545px; width: 140px;">
                    <div class="photo">
                        <?php if(isset($kadus[0]) && $kadus[0]->foto): ?>
                            <img src="<?php echo e(Storage::url($kadus[0]->foto)); ?>" alt="<?php echo e($kadus[0]->nama); ?>">
                        <?php else: ?>
                            <i class="fas fa-user"></i>
                        <?php endif; ?>
                    </div>
                    <div class="name"><?php echo e($kadus[0]->nama ?? '-'); ?></div>
                    <div class="title"><?php echo e($kadus[0]->jabatan ?? 'Kepala Dusun I'); ?></div>
                </div>
                
                
                <div class="line" style="left: 415px; top: 520px; width: 2px; height: 25px;"></div>
                <div class="org-box-sm bg-kadus" style="left: 345px; top: 545px; width: 140px;">
                    <div class="photo">
                        <?php if(isset($kadus[1]) && $kadus[1]->foto): ?>
                            <img src="<?php echo e(Storage::url($kadus[1]->foto)); ?>" alt="<?php echo e($kadus[1]->nama); ?>">
                        <?php else: ?>
                            <i class="fas fa-user"></i>
                        <?php endif; ?>
                    </div>
                    <div class="name"><?php echo e($kadus[1]->nama ?? '-'); ?></div>
                    <div class="title"><?php echo e($kadus[1]->jabatan ?? 'Kepala Dusun II'); ?></div>
                </div>
                
                
                <div class="line" style="left: 645px; top: 520px; width: 2px; height: 25px;"></div>
                <div class="org-box-sm bg-kadus" style="left: 575px; top: 545px; width: 140px;">
                    <div class="photo">
                        <?php if(isset($kadus[2]) && $kadus[2]->foto): ?>
                            <img src="<?php echo e(Storage::url($kadus[2]->foto)); ?>" alt="<?php echo e($kadus[2]->nama); ?>">
                        <?php else: ?>
                            <i class="fas fa-user"></i>
                        <?php endif; ?>
                    </div>
                    <div class="name"><?php echo e($kadus[2]->nama ?? '-'); ?></div>
                    <div class="title"><?php echo e($kadus[2]->jabatan ?? 'Kepala Dusun III'); ?></div>
                </div>
                
                
                <div class="line" style="left: 900px; top: 520px; width: 2px; height: 25px;"></div>
                <div class="org-box-sm bg-kadus" style="left: 830px; top: 545px; width: 140px;">
                    <div class="photo">
                        <?php if(isset($kadus[3]) && $kadus[3]->foto): ?>
                            <img src="<?php echo e(Storage::url($kadus[3]->foto)); ?>" alt="<?php echo e($kadus[3]->nama); ?>">
                        <?php else: ?>
                            <i class="fas fa-user"></i>
                        <?php endif; ?>
                    </div>
                    <div class="name"><?php echo e($kadus[3]->nama ?? '-'); ?></div>
                    <div class="title"><?php echo e($kadus[3]->jabatan ?? 'Kepala Dusun IV'); ?></div>
                </div>
                
            </div>
            
            
            <div class="flex justify-center gap-10 mt-8 text-sm text-gray-600">
                <div class="flex items-center gap-2">
                    <div class="w-10 h-0.5 bg-gray-500"></div>
                    <span>Garis Komando</span>
                </div>
                <div class="flex items-center gap-2">
                    <div class="w-10 border-t-2 border-dashed border-gray-400"></div>
                    <span>Garis Koordinasi</span>
                </div>
            </div>
            
        </div>
    </section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\website-desa-tanalum\resources\views/profil/struktur.blade.php ENDPATH**/ ?>
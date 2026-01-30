<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\InfografisController;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PpidController;
use App\Http\Controllers\WisataController;
use App\Http\Controllers\GaleriController;
use App\Http\Controllers\PengaduanController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\BeritaController as AdminBeritaController;
use App\Http\Controllers\Admin\ProdukController as AdminProdukController;
use App\Http\Controllers\Admin\AparaturController as AdminAparaturController;
use App\Http\Controllers\Admin\GaleriController as AdminGaleriController;
use App\Http\Controllers\Admin\PpidController as AdminPpidController;
use App\Http\Controllers\Admin\DataDesaController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Profil Desa
Route::prefix('profil')->name('profil.')->group(function () {
    Route::get('/', [ProfilController::class, 'index'])->name('index');
    Route::get('/visi-misi', [ProfilController::class, 'visiMisi'])->name('visi-misi');
    Route::get('/sejarah', [ProfilController::class, 'sejarah'])->name('sejarah');
    Route::get('/struktur-organisasi', [ProfilController::class, 'strukturOrganisasi'])->name('struktur');
    Route::get('/peta-desa', [ProfilController::class, 'petaDesa'])->name('peta');
    Route::get('/demografi', [ProfilController::class, 'demografi'])->name('demografi');
});

// Infografis
Route::prefix('infografis')->name('infografis.')->group(function () {
    Route::get('/', [InfografisController::class, 'index'])->name('index');
    Route::get('/penduduk', [InfografisController::class, 'penduduk'])->name('penduduk');
    Route::get('/apbdes', [InfografisController::class, 'apbdes'])->name('apbdes');
    Route::get('/stunting', [InfografisController::class, 'stunting'])->name('stunting');
    Route::get('/bansos', [InfografisController::class, 'bansos'])->name('bansos');
    Route::get('/idm', [InfografisController::class, 'idm'])->name('idm');
    Route::get('/sdgs', [InfografisController::class, 'sdgs'])->name('sdgs');
});

// IDM (dedicated page)
Route::get('/idm', [InfografisController::class, 'idmDetail'])->name('idm');

// Listing
Route::prefix('listing')->name('listing.')->group(function () {
    Route::get('/', [\App\Http\Controllers\ListingController::class, 'index'])->name('index');
    Route::get('/peta', [\App\Http\Controllers\ListingController::class, 'peta'])->name('peta');
});

// Pemerintahan
Route::get('/pemerintahan', [\App\Http\Controllers\PemerintahanController::class, 'index'])->name('pemerintahan');

// Berita
Route::prefix('berita')->name('berita.')->group(function () {
    Route::get('/', [BeritaController::class, 'index'])->name('index');
    Route::get('/kategori/{slug}', [BeritaController::class, 'kategori'])->name('kategori');
    Route::get('/{slug}', [BeritaController::class, 'show'])->name('show');
});

// Belanja/Produk UMKM
Route::prefix('belanja')->name('belanja.')->group(function () {
    Route::get('/', [ProdukController::class, 'index'])->name('index');
    Route::get('/kategori/{slug}', [ProdukController::class, 'kategori'])->name('kategori');
    Route::get('/{slug}', [ProdukController::class, 'show'])->name('show');
});

// PPID
Route::prefix('ppid')->name('ppid.')->group(function () {
    Route::get('/', [PpidController::class, 'index'])->name('index');
    Route::get('/dasar-hukum', [PpidController::class, 'dasarHukum'])->name('dasar-hukum');
    Route::get('/informasi-berkala', [PpidController::class, 'informasiBerkala'])->name('berkala');
    Route::get('/informasi-serta-merta', [PpidController::class, 'informasiSertaMerta'])->name('serta-merta');
    Route::get('/informasi-setiap-saat', [PpidController::class, 'informasiSetiapSaat'])->name('setiap-saat');
    Route::get('/permohonan', [PpidController::class, 'permohonanForm'])->name('permohonan');
    Route::post('/permohonan', [PpidController::class, 'permohonanSubmit'])->name('permohonan.submit');
    Route::get('/dokumen/{slug}/download', [PpidController::class, 'download'])->name('download');
    Route::get('/dokumen/{slug}/view', [PpidController::class, 'view'])->name('view');
});

// Wisata
Route::prefix('wisata')->name('wisata.')->group(function () {
    Route::get('/', [WisataController::class, 'index'])->name('index');
    Route::get('/{slug}', [WisataController::class, 'show'])->name('show');
});

// Potensi
Route::prefix('potensi')->name('potensi.')->group(function () {
    Route::get('/', [WisataController::class, 'potensiIndex'])->name('index');
    Route::get('/{slug}', [WisataController::class, 'potensiShow'])->name('show');
});

// Galeri
Route::prefix('galeri')->name('galeri.')->group(function () {
    Route::get('/', [GaleriController::class, 'index'])->name('index');
    Route::get('/foto', [GaleriController::class, 'foto'])->name('foto');
    Route::get('/video', [GaleriController::class, 'video'])->name('video');
});

// Pengaduan
Route::prefix('pengaduan')->name('pengaduan.')->group(function () {
    Route::get('/', [PengaduanController::class, 'index'])->name('index');
    Route::get('/form', [PengaduanController::class, 'create'])->name('create');
    Route::post('/submit', [PengaduanController::class, 'store'])->name('store');
    Route::get('/cek/{nomor_tiket}', [PengaduanController::class, 'cekStatus'])->name('cek');
});

// Cek Bansos
Route::get('/cek-bansos', [InfografisController::class, 'cekBansos'])->name('cek-bansos');

// Kontak
Route::get('/kontak', [\App\Http\Controllers\KontakController::class, 'index'])->name('kontak');
Route::post('/kontak', [\App\Http\Controllers\KontakController::class, 'submit'])->name('kontak.submit');
Route::post('/cek-bansos', [InfografisController::class, 'cekBansosResult'])->name('cek-bansos.result');

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/

// Auth
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Admin Panel (Protected)
Route::prefix('admin')->name('admin.')->middleware(['auth', 'admin'])->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
    
    // Profil Desa
    Route::get('/profil-desa', [DataDesaController::class, 'profil'])->name('profil');
    Route::put('/profil-desa', [DataDesaController::class, 'updateProfil'])->name('profil.update');
    
    // Aparatur Desa
    Route::resource('aparatur', AdminAparaturController::class);
    
    // Berita
    Route::resource('berita', AdminBeritaController::class);
    
    // Produk UMKM
    Route::resource('produk', AdminProdukController::class);
    
    // Galeri
    Route::resource('galeri', AdminGaleriController::class);
    
    // Wisata
    Route::resource('wisata', \App\Http\Controllers\Admin\WisataController::class);
    
    // Dokumen PPID
    Route::resource('dokumen', \App\Http\Controllers\Admin\DokumenController::class);
    
    // PPID
    Route::prefix('ppid')->name('ppid.')->group(function () {
        Route::get('/', [AdminPpidController::class, 'index'])->name('index');
        Route::get('/dokumen', [AdminPpidController::class, 'dokumen'])->name('dokumen');
        Route::get('/dokumen/create', [AdminPpidController::class, 'createDokumen'])->name('dokumen.create');
        Route::post('/dokumen', [AdminPpidController::class, 'storeDokumen'])->name('dokumen.store');
        Route::get('/dokumen/{id}/edit', [AdminPpidController::class, 'editDokumen'])->name('dokumen.edit');
        Route::put('/dokumen/{id}', [AdminPpidController::class, 'updateDokumen'])->name('dokumen.update');
        Route::delete('/dokumen/{id}', [AdminPpidController::class, 'destroyDokumen'])->name('dokumen.destroy');
        Route::get('/permohonan', [AdminPpidController::class, 'permohonan'])->name('permohonan');
        Route::get('/permohonan/{id}', [AdminPpidController::class, 'showPermohonan'])->name('permohonan.show');
        Route::put('/permohonan/{id}', [AdminPpidController::class, 'updatePermohonan'])->name('permohonan.update');
    });
    
    // Data Desa (Statistik)
    Route::prefix('data')->name('data.')->group(function () {
        Route::get('/penduduk', [DataDesaController::class, 'penduduk'])->name('penduduk');
        Route::post('/penduduk', [DataDesaController::class, 'storePenduduk'])->name('penduduk.store');
        Route::get('/apbdes', [DataDesaController::class, 'apbdes'])->name('apbdes');
        Route::post('/apbdes', [DataDesaController::class, 'storeApbdes'])->name('apbdes.store');
        Route::get('/bansos', [DataDesaController::class, 'bansos'])->name('bansos');
        Route::post('/bansos', [DataDesaController::class, 'storeBansos'])->name('bansos.store');
        Route::get('/idm', [DataDesaController::class, 'idm'])->name('idm');
        Route::post('/idm', [DataDesaController::class, 'storeIdm'])->name('idm.store');
        Route::get('/sdgs', [DataDesaController::class, 'sdgs'])->name('sdgs');
        Route::post('/sdgs', [DataDesaController::class, 'storeSdgs'])->name('sdgs.store');
    });
    
    // Slider
    Route::resource('slider', \App\Http\Controllers\Admin\SliderController::class);
    
    // Pengaduan
    Route::prefix('pengaduan')->name('pengaduan.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\PengaduanController::class, 'index'])->name('index');
        Route::get('/{id}', [\App\Http\Controllers\Admin\PengaduanController::class, 'show'])->name('show');
        Route::put('/{id}', [\App\Http\Controllers\Admin\PengaduanController::class, 'update'])->name('update');
    });
    
    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('setting.index');
    Route::put('/settings', [SettingController::class, 'update'])->name('setting.update');
    
    // Kontak/Pesan Masuk
    Route::prefix('kontak')->name('kontak.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\KontakController::class, 'index'])->name('index');
        Route::get('/{kontak}', [\App\Http\Controllers\Admin\KontakController::class, 'show'])->name('show');
        Route::post('/{kontak}/reply', [\App\Http\Controllers\Admin\KontakController::class, 'reply'])->name('reply');
        Route::put('/{kontak}/status', [\App\Http\Controllers\Admin\KontakController::class, 'updateStatus'])->name('updateStatus');
        Route::delete('/{kontak}', [\App\Http\Controllers\Admin\KontakController::class, 'destroy'])->name('destroy');
    });
    
    // Users (Super Admin only)
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->middleware('superadmin');
});

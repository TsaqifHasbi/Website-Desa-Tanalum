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
use App\Http\Controllers\Admin\ProfilDesaController;
use App\Http\Controllers\Admin\SejarahDesaController;
use App\Http\Controllers\Admin\SettingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Home
Route::get('/', [HomeController::class, 'index'])->name('home');

// Login redirect
Route::get('/login', function () {
    return redirect()->route('admin.login');
})->name('login');

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

    // Profile
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');
    Route::get('/profile/password', [AuthController::class, 'passwordForm'])->name('profile.password');
    Route::put('/profile/password', [AuthController::class, 'updatePassword'])->name('profile.password.update');

    // Profil Desa
    Route::get('/profil-desa', [ProfilDesaController::class, 'index'])->name('profil');
    Route::put('/profil-desa', [ProfilDesaController::class, 'update'])->name('profil.update');

    // Sejarah Desa
    Route::prefix('sejarah')->name('sejarah.')->group(function () {
        Route::get('/', [SejarahDesaController::class, 'index'])->name('index');
        Route::post('/upload-image', [SejarahDesaController::class, 'uploadImage'])->name('upload-image');
        
        // Cerita Rakyat
        Route::get('/cerita/create', [SejarahDesaController::class, 'ceritaCreate'])->name('cerita.create');
        Route::post('/cerita', [SejarahDesaController::class, 'ceritaStore'])->name('cerita.store');
        Route::get('/cerita/{cerita}/edit', [SejarahDesaController::class, 'ceritaEdit'])->name('cerita.edit');
        Route::put('/cerita/{cerita}', [SejarahDesaController::class, 'ceritaUpdate'])->name('cerita.update');
        Route::delete('/cerita/{cerita}', [SejarahDesaController::class, 'ceritaDestroy'])->name('cerita.destroy');
        
        // Kepala Desa
        Route::get('/kepala/create', [SejarahDesaController::class, 'kepalaCreate'])->name('kepala.create');
        Route::post('/kepala', [SejarahDesaController::class, 'kepalaStore'])->name('kepala.store');
        Route::get('/kepala/{kepala}/edit', [SejarahDesaController::class, 'kepalaEdit'])->name('kepala.edit');
        Route::put('/kepala/{kepala}', [SejarahDesaController::class, 'kepalaUpdate'])->name('kepala.update');
        Route::delete('/kepala/{kepala}', [SejarahDesaController::class, 'kepalaDestroy'])->name('kepala.destroy');
    });

    // Aparatur Desa
    Route::resource('aparatur', AdminAparaturController::class);

    // Berita
    Route::resource('berita', AdminBeritaController::class)->parameters(['berita' => 'berita']);

    // Produk UMKM
    Route::resource('produk', AdminProdukController::class);

    // Galeri
    Route::resource('galeri', AdminGaleriController::class);

    // Wisata
    Route::resource('wisata', \App\Http\Controllers\Admin\WisataController::class);

    // Potensi & Wisata Desa
    Route::prefix('potensi')->name('potensi.')->group(function () {
        Route::get('/wisata', [\App\Http\Controllers\Admin\PotensiController::class, 'wisataIndex'])->name('wisata');
        Route::get('/wisata/create', [\App\Http\Controllers\Admin\PotensiController::class, 'wisataCreate'])->name('wisata.create');
        Route::post('/wisata', [\App\Http\Controllers\Admin\PotensiController::class, 'wisataStore'])->name('wisata.store');
        Route::get('/wisata/{wisata}/edit', [\App\Http\Controllers\Admin\PotensiController::class, 'wisataEdit'])->name('wisata.edit');
        Route::put('/wisata/{wisata}', [\App\Http\Controllers\Admin\PotensiController::class, 'wisataUpdate'])->name('wisata.update');
        Route::delete('/wisata/{wisata}', [\App\Http\Controllers\Admin\PotensiController::class, 'wisataDestroy'])->name('wisata.destroy');
        Route::get('/', [\App\Http\Controllers\Admin\PotensiController::class, 'potensiIndex'])->name('index');
        Route::get('/create', [\App\Http\Controllers\Admin\PotensiController::class, 'potensiCreate'])->name('create');
        Route::post('/', [\App\Http\Controllers\Admin\PotensiController::class, 'potensiStore'])->name('store');
        Route::get('/{potensi}/edit', [\App\Http\Controllers\Admin\PotensiController::class, 'potensiEdit'])->name('edit');
        Route::put('/{potensi}', [\App\Http\Controllers\Admin\PotensiController::class, 'potensiUpdate'])->name('update');
        Route::delete('/{potensi}', [\App\Http\Controllers\Admin\PotensiController::class, 'potensiDestroy'])->name('destroy');
        Route::get('/kategori', [\App\Http\Controllers\Admin\PotensiController::class, 'kategori'])->name('kategori');
        Route::post('/kategori', [\App\Http\Controllers\Admin\PotensiController::class, 'kategoriStore'])->name('kategori.store');
        Route::put('/kategori/{kategori}', [\App\Http\Controllers\Admin\PotensiController::class, 'kategoriUpdate'])->name('kategori.update');
        Route::delete('/kategori/{kategori}', [\App\Http\Controllers\Admin\PotensiController::class, 'kategoriDestroy'])->name('kategori.destroy');
    });

    // Dokumen PPID
    Route::resource('dokumen', \App\Http\Controllers\Admin\DokumenController::class);

    // PPID
    Route::prefix('ppid')->name('ppid.')->group(function () {
        Route::get('/', [AdminPpidController::class, 'index'])->name('index');
        Route::get('/dokumen/create', [AdminPpidController::class, 'create'])->name('dokumen.create');
        Route::post('/dokumen', [AdminPpidController::class, 'store'])->name('dokumen.store');
        Route::get('/dokumen/{dokumen}/edit', [AdminPpidController::class, 'edit'])->name('dokumen.edit');
        Route::put('/dokumen/{dokumen}', [AdminPpidController::class, 'update'])->name('dokumen.update');
        Route::delete('/dokumen/{dokumen}', [AdminPpidController::class, 'destroy'])->name('dokumen.destroy');
        Route::get('/permohonan', [AdminPpidController::class, 'permohonan'])->name('permohonan');
        Route::get('/permohonan/{permohonan}', [AdminPpidController::class, 'permohonanShow'])->name('permohonan.show');
        Route::put('/permohonan/{permohonan}', [AdminPpidController::class, 'permohonanUpdate'])->name('permohonan.update');
        Route::get('/kategori', [AdminPpidController::class, 'kategori'])->name('kategori');
        Route::post('/kategori', [AdminPpidController::class, 'kategoriStore'])->name('kategori.store');
        Route::put('/kategori/{kategori}', [AdminPpidController::class, 'kategoriUpdate'])->name('kategori.update');
        Route::delete('/kategori/{kategori}', [AdminPpidController::class, 'kategoriDestroy'])->name('kategori.destroy');
    });

    // Data Desa (Statistik)
    Route::prefix('data')->name('data.')->group(function () {
        Route::get('/penduduk', [DataDesaController::class, 'penduduk'])->name('penduduk');
        Route::post('/penduduk', [DataDesaController::class, 'pendudukStore'])->name('penduduk.store');
        Route::put('/penduduk', [DataDesaController::class, 'pendudukUpdate'])->name('penduduk.update');
        Route::post('/penduduk/import', [DataDesaController::class, 'pendudukImport'])->name('penduduk.import');
        Route::get('/dusun', [DataDesaController::class, 'dusun'])->name('dusun');
        Route::post('/dusun', [DataDesaController::class, 'dusunStore'])->name('dusun.store');
        Route::put('/dusun/{dusun}', [DataDesaController::class, 'dusunUpdate'])->name('dusun.update');
        Route::delete('/dusun/{dusun}', [DataDesaController::class, 'dusunDestroy'])->name('dusun.destroy');
        Route::get('/apbdes', [DataDesaController::class, 'apbdes'])->name('apbdes');
        Route::post('/apbdes', [DataDesaController::class, 'apbdesStore'])->name('apbdes.store');
        Route::put('/apbdes', [DataDesaController::class, 'apbdesUpdate'])->name('apbdes.update');
        Route::delete('/apbdes/{apbdes}', [DataDesaController::class, 'apbdesDestroy'])->name('apbdes.destroy');
        Route::get('/bansos', [DataDesaController::class, 'bansos'])->name('bansos');
        Route::post('/bansos', [DataDesaController::class, 'bansosJenisStore'])->name('bansos.store');
        Route::post('/bansos/import', [DataDesaController::class, 'bansosImport'])->name('bansos.import');
        Route::get('/bansos/penerima', [DataDesaController::class, 'bansosPenerima'])->name('bansos.penerima');
        Route::post('/bansos/penerima', [DataDesaController::class, 'bansosPenerimaStore'])->name('bansos.penerima.store');
        Route::get('/bansos/penerima/{penerima}/edit', [DataDesaController::class, 'bansosPenerimaEdit'])->name('bansos.penerima.edit');
        Route::put('/bansos/penerima/{penerima}', [DataDesaController::class, 'bansosPenerimaUpdate'])->name('bansos.penerima.update');
        Route::delete('/bansos/penerima/{penerima}', [DataDesaController::class, 'bansosPenerimaDestroy'])->name('bansos.penerima.destroy');
        Route::get('/idm', [DataDesaController::class, 'idm'])->name('idm');
        Route::post('/idm', [DataDesaController::class, 'idmStore'])->name('idm.store');
        Route::put('/idm', [DataDesaController::class, 'idmUpdate'])->name('idm.update');
        Route::delete('/idm/{idm}', [DataDesaController::class, 'idmDestroy'])->name('idm.destroy');
        Route::get('/sdgs', [DataDesaController::class, 'sdgs'])->name('sdgs');
        Route::post('/sdgs', [DataDesaController::class, 'sdgsStore'])->name('sdgs.store');
        Route::get('/sdgs/{sdgs}/edit', [DataDesaController::class, 'sdgsEdit'])->name('sdgs.edit');
        Route::put('/sdgs/{sdgs}', [DataDesaController::class, 'sdgsUpdate'])->name('sdgs.update');
        Route::delete('/sdgs/{sdgs}', [DataDesaController::class, 'sdgsDestroy'])->name('sdgs.destroy');
        Route::get('/stunting', [DataDesaController::class, 'stunting'])->name('stunting');
        Route::post('/stunting', [DataDesaController::class, 'stuntingStore'])->name('stunting.store');
        Route::put('/stunting/{stunting}', [DataDesaController::class, 'stuntingUpdate'])->name('stunting.update');
        Route::delete('/stunting/{stunting}', [DataDesaController::class, 'stuntingDestroy'])->name('stunting.destroy');
    });

    // Slider
    Route::post('slider/reorder', [\App\Http\Controllers\Admin\SliderController::class, 'reorder'])->name('slider.reorder');
    Route::resource('slider', \App\Http\Controllers\Admin\SliderController::class);

    // Pengaduan
    Route::prefix('pengaduan')->name('pengaduan.')->group(function () {
        Route::get('/', [\App\Http\Controllers\Admin\PengaduanController::class, 'index'])->name('index');
        Route::get('/{pengaduan}', [\App\Http\Controllers\Admin\PengaduanController::class, 'show'])->name('show');
        Route::put('/{pengaduan}', [\App\Http\Controllers\Admin\PengaduanController::class, 'update'])->name('update');
        Route::delete('/{pengaduan}', [\App\Http\Controllers\Admin\PengaduanController::class, 'destroy'])->name('destroy');
    });

    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingController::class, 'update'])->name('settings.update');

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

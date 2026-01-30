<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Models\ProdukUmkm;
use App\Models\Pengaduan;
use App\Models\DokumenPpid;
use App\Models\PermohonanInformasi;
use App\Models\StatistikPenduduk;
use App\Models\Apbdes;
use App\Models\DataIdm;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Statistics
        $stats = [
            'total_berita' => Berita::count(),
            'berita_bulan_ini' => Berita::whereMonth('created_at', now()->month)->count(),
            'total_produk' => ProdukUmkm::count(),
            'produk_aktif' => ProdukUmkm::active()->count(),
            'total_pengaduan' => Pengaduan::count(),
            'pengaduan_baru' => Pengaduan::where('status', 'baru')->count(),
            'total_dokumen' => DokumenPpid::count(),
            'total_permohonan' => PermohonanInformasi::count(),
            'permohonan_baru' => PermohonanInformasi::where('status', 'baru')->count(),
        ];

        // Recent Berita
        $recentBeritas = Berita::with('author', 'kategori')
            ->latest()
            ->take(5)
            ->get();

        // Recent Pengaduan
        $recentPengaduans = Pengaduan::latest()
            ->take(5)
            ->get();

        // Recent Permohonan
        $recentPermohonans = PermohonanInformasi::latest()
            ->take(5)
            ->get();

        // Data Penduduk
        $penduduk = StatistikPenduduk::getLatest();

        // APBDes
        $apbdes = Apbdes::getLatest();

        // IDM
        $idm = DataIdm::getLatest();

        return view('admin.dashboard', compact(
            'stats',
            'recentBeritas',
            'recentPengaduans',
            'recentPermohonans',
            'penduduk',
            'apbdes',
            'idm'
        ));
    }
}

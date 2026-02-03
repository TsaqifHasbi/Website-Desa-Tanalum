<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\ProdukUmkm;
use App\Models\Galeri;
use App\Models\Slider;
use App\Models\AparaturDesa;
use App\Models\ProfilDesa;
use App\Models\StatistikPenduduk;
use App\Models\Apbdes;
use App\Models\WisataDesa;
use App\Models\PotensiDesa;
use App\Models\Dusun;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // Get sliders
        $sliders = Slider::active()->ordered()->get();

        // Get profil desa
        $profil = ProfilDesa::first();

        // Get jumlah dusun
        $jumlahDusun = Dusun::active()->count();

        // Get kepala desa
        $kepalaDesa = AparaturDesa::where('jabatan', 'like', '%Kepala Desa%')
            ->active()
            ->first();

        // Get statistik penduduk terbaru
        $statistik = StatistikPenduduk::getLatest();

        // Get APBDes terbaru
        $apbdes = Apbdes::getLatest();

        // Get berita terbaru
        $beritas = Berita::with('kategori', 'author')
            ->published()
            ->latest()
            ->take(6)
            ->get();

        // Get potensi desa
        $potensis = PotensiDesa::active()
            ->featured()
            ->take(4)
            ->get();

        // Get wisata desa
        $wisatas = WisataDesa::active()
            ->featured()
            ->take(4)
            ->get();

        // Get produk UMKM
        $produks = ProdukUmkm::with('kategori')
            ->active()
            ->latest()
            ->take(6)
            ->get();

        // Get galeri (mixed photos and videos)
        $galeris = Galeri::active()
            ->ordered()
            ->take(8)
            ->get();

        // Get aparatur desa
        $aparaturs = AparaturDesa::active()
            ->ordered()
            ->take(8)
            ->get();

        return view('home', compact(
            'sliders',
            'profil',
            'jumlahDusun',
            'kepalaDesa',
            'statistik',
            'apbdes',
            'beritas',
            'potensis',
            'wisatas',
            'produks',
            'galeris',
            'aparaturs'
        ));
    }
}

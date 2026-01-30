<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\ProfilDesa;
use Illuminate\Http\Request;

class ListingController extends Controller
{
    /**
     * Halaman listing/pencarian
     */
    public function index(Request $request)
    {
        $query = Berita::where('is_published', true);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('konten', 'like', "%{$search}%");
            });
        }

        // Filter by kategori
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $items = $query->latest('published_at')->paginate(10);

        return view('listing.index', compact('items'));
    }

    /**
     * Halaman peta desa interaktif
     */
    public function peta()
    {
        $profil = ProfilDesa::first();

        // Get data untuk peta
        $wisatas = \App\Models\Wisata::where('is_active', true)
            ->whereNotNull('koordinat')
            ->get();

        $produk = \App\Models\Produk::where('is_active', true)
            ->whereNotNull('koordinat')
            ->get();

        $data = [
            'profil' => $profil,
            'wisatas' => $wisatas,
            'produk' => $produk,
            'latitude' => $profil->latitude ?? '-0.2',
            'longitude' => $profil->longitude ?? '117.4',
            'luasDesa' => $profil->luas_wilayah ?? 3880000,
            'jumlahPenduduk' => $profil->jumlah_penduduk ?? 1162,
            'batasUtara' => $profil->batas_utara ?? 'Desa Santan Ulu dan Desa Santan Ilir',
            'batasTimur' => $profil->batas_timur ?? 'Selat Makassar',
            'batasSelatan' => $profil->batas_selatan ?? 'Selat Makassar dan Desa Semangko',
            'batasBarat' => $profil->batas_barat ?? 'Desa Santan Ulu',
        ];

        return view('listing.peta', $data);
    }
}

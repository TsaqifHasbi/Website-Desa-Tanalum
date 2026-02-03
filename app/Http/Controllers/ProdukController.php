<?php

namespace App\Http\Controllers;

use App\Models\ProdukUmkm;
use App\Models\KategoriProduk;
use App\Models\ProfilDesa;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index(Request $request)
    {
        $profil = ProfilDesa::first();
        $kategoris = KategoriProduk::withCount(['produk' => function ($query) {
            $query->active();
        }])->active()->get();
        $totalProduk = ProdukUmkm::active()->count();

        $query = ProdukUmkm::with('kategori')->active();

        // Search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                    ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by kategori
        if ($request->filled('kategori')) {
            $query->where('kategori_id', $request->kategori);
        }

        // Sort
        $sort = $request->get('sort', 'terbaru');
        switch ($sort) {
            case 'termurah':
                $query->orderBy('harga', 'asc');
                break;
            case 'termahal':
                $query->orderBy('harga', 'desc');
                break;
            case 'populer':
                $query->orderBy('views', 'desc');
                break;
            default:
                $query->latest();
        }

        $produks = $query->paginate(9);

        return view('produk.index', compact('profil', 'produks', 'kategoris', 'totalProduk', 'sort'));
    }

    public function kategori($slug)
    {
        $profil = ProfilDesa::first();
        $kategoris = KategoriProduk::active()->get();
        $kategori = KategoriProduk::where('slug', $slug)->firstOrFail();

        $produks = ProdukUmkm::with('kategori')
            ->where('kategori_id', $kategori->id)
            ->active()
            ->latest()
            ->paginate(9);

        return view('produk.kategori', compact('profil', 'produks', 'kategoris', 'kategori'));
    }

    public function show($slug)
    {
        $profil = ProfilDesa::first();
        $produk = ProdukUmkm::with('kategori')
            ->where('slug', $slug)
            ->active()
            ->firstOrFail();

        // Increment views
        $produk->incrementViews();

        // Get related produks
        $relatedProduks = ProdukUmkm::with('kategori')
            ->active()
            ->where('id', '!=', $produk->id)
            ->when($produk->kategori_id, function ($q) use ($produk) {
                $q->where('kategori_id', $produk->kategori_id);
            })
            ->latest()
            ->take(4)
            ->get();

        return view('produk.show', compact('profil', 'produk', 'relatedProduks'));
    }
}

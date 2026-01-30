<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\KategoriBerita;
use App\Models\ProfilDesa;
use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function index(Request $request)
    {
        $profil = ProfilDesa::first();
        $kategoris = KategoriBerita::active()->get();

        $query = Berita::with('kategori', 'author')->published();

        // Search
        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->q . '%')
                    ->orWhere('konten', 'like', '%' . $request->q . '%');
            });
        }

        $beritas = $query->latest()->paginate(9);

        return view('berita.index', compact('profil', 'beritas', 'kategoris'));
    }

    public function kategori($slug)
    {
        $profil = ProfilDesa::first();
        $kategoris = KategoriBerita::active()->get();
        $kategori = KategoriBerita::where('slug', $slug)->firstOrFail();

        $beritas = Berita::with('kategori', 'author')
            ->where('kategori_id', $kategori->id)
            ->published()
            ->latest()
            ->paginate(9);

        return view('berita.kategori', compact('profil', 'beritas', 'kategoris', 'kategori'));
    }

    public function show($slug)
    {
        $profil = ProfilDesa::first();
        $berita = Berita::with('kategori', 'author')
            ->where('slug', $slug)
            ->published()
            ->firstOrFail();

        // Increment views
        $berita->incrementViews();

        // Get related beritas
        $relatedBeritas = Berita::with('kategori')
            ->published()
            ->where('id', '!=', $berita->id)
            ->when($berita->kategori_id, function ($q) use ($berita) {
                $q->where('kategori_id', $berita->kategori_id);
            })
            ->latest()
            ->take(4)
            ->get();

        return view('berita.show', compact('profil', 'berita', 'relatedBeritas'));
    }
}

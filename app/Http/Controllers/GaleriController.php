<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\KategoriGaleri;
use App\Models\ProfilDesa;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index(Request $request)
    {
        $profil = ProfilDesa::first();
        $kategoris = KategoriGaleri::active()->get();

        $query = Galeri::with('kategori')->active()->ordered();

        // Filter by tipe
        if ($request->has('tipe')) {
            if ($request->tipe === 'foto') {
                $query->where('tipe', 'foto');
            } elseif ($request->tipe === 'video') {
                $query->where('tipe', 'video');
            }
        }

        // Filter by kategori
        if ($request->has('kategori')) {
            $kategori = KategoriGaleri::where('slug', $request->kategori)->first();
            if ($kategori) {
                $query->where('kategori_id', $kategori->id);
            }
        }

        $galeris = $query->paginate(12);

        return view('galeri.index', compact('profil', 'kategoris', 'galeris'));
    }

    public function foto()
    {
        $profil = ProfilDesa::first();
        $kategoris = KategoriGaleri::active()->get();
        $galeris = Galeri::with('kategori')->active()->foto()->ordered()->paginate(12);

        return view('galeri.index', compact('profil', 'kategoris', 'galeris'))
            ->with('type', 'foto');
    }

    public function video()
    {
        $profil = ProfilDesa::first();
        $kategoris = KategoriGaleri::active()->get();
        $galeris = Galeri::with('kategori')->active()->video()->ordered()->paginate(12);

        return view('galeri.index', compact('profil', 'kategoris', 'galeris'))
            ->with('type', 'video');
    }
}

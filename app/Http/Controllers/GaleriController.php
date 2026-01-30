<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use App\Models\KategoriGaleri;
use App\Models\ProfilDesa;
use Illuminate\Http\Request;

class GaleriController extends Controller
{
    public function index()
    {
        $profil = ProfilDesa::first();
        $kategoris = KategoriGaleri::active()->get();
        $galeris = Galeri::with('kategori')->active()->ordered()->paginate(12);

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

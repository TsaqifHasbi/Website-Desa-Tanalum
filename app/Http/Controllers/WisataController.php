<?php

namespace App\Http\Controllers;

use App\Models\WisataDesa;
use App\Models\PotensiDesa;
use App\Models\KategoriPotensi;
use App\Models\ProfilDesa;
use Illuminate\Http\Request;

class WisataController extends Controller
{
    public function index()
    {
        $profil = ProfilDesa::first();
        $wisatas = WisataDesa::active()->latest()->paginate(9);
        $potensis = PotensiDesa::with('kategori')->active()->latest()->take(8)->get();

        return view('wisata.index', compact('profil', 'wisatas', 'potensis'));
    }

    public function show($slug)
    {
        $profil = ProfilDesa::first();
        $wisata = WisataDesa::where('slug', $slug)->active()->firstOrFail();

        // Increment views
        $wisata->incrementViews();

        // Get related wisatas
        $relatedWisatas = WisataDesa::active()
            ->where('id', '!=', $wisata->id)
            ->latest()
            ->take(4)
            ->get();

        return view('wisata.show', compact('profil', 'wisata', 'relatedWisatas'));
    }

    public function potensiIndex()
    {
        $profil = ProfilDesa::first();
        $kategoris = KategoriPotensi::active()->get();
        $potensis = PotensiDesa::with('kategori')->active()->latest()->paginate(9);

        return view('potensi.index', compact('profil', 'kategoris', 'potensis'));
    }

    public function potensiShow($slug)
    {
        $profil = ProfilDesa::first();
        $potensi = PotensiDesa::with('kategori')
            ->where('slug', $slug)
            ->active()
            ->firstOrFail();

        // Get related potensis
        $relatedPotensis = PotensiDesa::with('kategori')
            ->active()
            ->where('id', '!=', $potensi->id)
            ->when($potensi->kategori_id, function ($q) use ($potensi) {
                $q->where('kategori_id', $potensi->kategori_id);
            })
            ->latest()
            ->take(4)
            ->get();

        return view('potensi.show', compact('profil', 'potensi', 'relatedPotensis'));
    }
}

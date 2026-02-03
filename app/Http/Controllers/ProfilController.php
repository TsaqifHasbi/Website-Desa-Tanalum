<?php

namespace App\Http\Controllers;

use App\Models\ProfilDesa;
use App\Models\AparaturDesa;
use App\Models\StatistikPenduduk;
use App\Models\Dusun;
use App\Models\CeritaRakyat;
use App\Models\KepalaDesa;
use Illuminate\Http\Request;

class ProfilController extends Controller
{
    public function index()
    {
        $profil = ProfilDesa::first();
        $kepalaDesa = AparaturDesa::where('jabatan', 'like', '%Kepala Desa%')
            ->active()
            ->first();
        $statistik = StatistikPenduduk::getLatest();
        $aparaturs = AparaturDesa::active()->ordered()->get();

        return view('profil.index', compact('profil', 'kepalaDesa', 'statistik', 'aparaturs'));
    }

    public function visiMisi()
    {
        $profil = ProfilDesa::first();

        return view('profil.visi-misi', compact('profil'));
    }

    public function sejarah()
    {
        $profil = ProfilDesa::first();
        $ceritaRakyat = CeritaRakyat::active()->ordered()->get();
        $kepalaDesa = KepalaDesa::active()->ordered()->get();

        return view('profil.sejarah', compact('profil', 'ceritaRakyat', 'kepalaDesa'));
    }

    public function strukturOrganisasi()
    {
        $profil = ProfilDesa::first();
        $kepalaDesa = AparaturDesa::where('jabatan', 'like', '%Kepala Desa%')
            ->active()
            ->first();
        $aparaturs = AparaturDesa::active()->ordered()->get();
        $pemerintahDesa = AparaturDesa::active()
            ->pemerintahDesa()
            ->ordered()
            ->get();
        $bpd = AparaturDesa::active()
            ->bpd()
            ->ordered()
            ->get();

        return view('profil.struktur', compact('profil', 'kepalaDesa', 'aparaturs', 'pemerintahDesa', 'bpd'));
    }

    public function petaDesa()
    {
        $profil = ProfilDesa::first();

        return view('profil.peta', compact('profil'));
    }

    public function demografi()
    {
        $profil = ProfilDesa::first();
        $statistik = StatistikPenduduk::getLatest();
        $dusuns = Dusun::active()->get();

        return view('profil.demografi', compact('profil', 'statistik', 'dusuns'));
    }
}

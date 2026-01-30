<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aparatur;

class PemerintahanController extends Controller
{
    public function index()
    {
        // Kepala Desa
        $kepalaDesa = Aparatur::where('jabatan', 'like', '%Kepala Desa%')
            ->where('is_active', true)
            ->first();

        // Perangkat Desa (excluding Kepala Desa and BPD)
        $perangkatDesa = Aparatur::where('jenis', 'perangkat')
            ->where('jabatan', 'not like', '%Kepala Desa%')
            ->where('is_active', true)
            ->orderBy('urutan')
            ->get();

        // BPD
        $bpd = Aparatur::where('jenis', 'bpd')
            ->where('is_active', true)
            ->orderBy('urutan')
            ->get();

        // LPM
        $lpm = Aparatur::where('jenis', 'lpm')
            ->where('is_active', true)
            ->first();

        // PKK
        $pkk = Aparatur::where('jenis', 'pkk')
            ->where('is_active', true)
            ->first();

        // Karang Taruna
        $karangTaruna = Aparatur::where('jenis', 'karang_taruna')
            ->where('is_active', true)
            ->first();

        // Profil Desa for Visi Misi
        $profilDesa = \App\Models\ProfilDesa::first();

        return view('pemerintahan', compact(
            'kepalaDesa',
            'perangkatDesa',
            'bpd',
            'lpm',
            'pkk',
            'karangTaruna',
            'profilDesa'
        ));
    }
}

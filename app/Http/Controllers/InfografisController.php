<?php

namespace App\Http\Controllers;

use App\Models\StatistikPenduduk;
use App\Models\Apbdes;
use App\Models\DataStunting;
use App\Models\JenisBansos;
use App\Models\StatistikBansos;
use App\Models\PenerimaBansos;
use App\Models\DataIdm;
use App\Models\DataSdgs;
use App\Models\ProfilDesa;
use Illuminate\Http\Request;

class InfografisController extends Controller
{
    public function index()
    {
        return redirect()->route('infografis.penduduk');
    }

    public function penduduk()
    {
        $profil = ProfilDesa::first();
        $penduduk = StatistikPenduduk::getLatest();

        return view('infografis.penduduk', compact('profil', 'penduduk'));
    }

    public function apbdes(Request $request)
    {
        $profil = ProfilDesa::first();
        $tahun = $request->get('tahun', date('Y'));
        $apbdes = Apbdes::where('tahun', $tahun)->first();
        $apbdesHistory = Apbdes::orderBy('tahun', 'desc')->get();
        $years = Apbdes::orderBy('tahun', 'desc')->pluck('tahun')->unique();

        return view('infografis.apbdes', compact('profil', 'apbdes', 'apbdesHistory', 'tahun', 'years'));
    }

    public function stunting()
    {
        $profil = ProfilDesa::first();
        $stunting = DataStunting::getLatest();
        $stuntingHistory = DataStunting::orderBy('tahun', 'desc')->get();

        return view('infografis.stunting', compact('profil', 'stunting', 'stuntingHistory'));
    }

    public function bansos()
    {
        $profil = ProfilDesa::first();
        $dataBansos = StatistikBansos::with('jenisBansos')
            ->where('tahun', date('Y'))
            ->get()
            ->map(function ($item) {
                $item->nama_program = $item->jenisBansos->nama ?? 'Unknown';
                return $item;
            });

        return view('infografis.bansos', compact('profil', 'dataBansos'));
    }

    public function idm()
    {
        $profil = ProfilDesa::first();
        $idm = DataIdm::getLatest();
        $idmHistory = DataIdm::getHistoricalData();
        $years = DataIdm::orderBy('tahun', 'desc')->get(['tahun']);

        return view('infografis.idm', compact('profil', 'idm', 'idmHistory', 'years'));
    }

    public function idmDetail()
    {
        $profil = ProfilDesa::first();
        $idm = DataIdm::with('indikator')->orderBy('tahun', 'desc')->first();
        $idmHistory = DataIdm::getHistoricalData();

        return view('infografis.idm-detail', compact('profil', 'idm', 'idmHistory'));
    }

    public function sdgs()
    {
        $profil = ProfilDesa::first();
        $sdgs = DataSdgs::getLatest();
        $sdgsLabels = DataSdgs::getSdgsLabels();

        return view('infografis.sdgs', compact('profil', 'sdgs', 'sdgsLabels'));
    }

    public function cekBansos()
    {
        $profil = ProfilDesa::first();

        return view('infografis.cek-bansos', compact('profil'));
    }

    public function cekBansosResult(Request $request)
    {
        $request->validate([
            'nik' => 'required|string|size:16',
        ]);

        $profil = ProfilDesa::first();
        $nik = $request->input('nik');
        $penerimas = PenerimaBansos::searchByNik($nik);

        return view('infografis.cek-bansos', compact('profil', 'nik', 'penerimas'));
    }
}

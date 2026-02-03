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
        $stuntingHistory = DataStunting::orderBy('tahun', 'desc')->orderBy('bulan', 'desc')->get();
        
        $stuntingData = []; // individual data not available in this model
        $totalBalita = $stunting->jumlah_balita ?? 0;
        $totalStunting = $stunting->jumlah_stunting ?? 0;
        $risikoStunting = ($stunting->jumlah_gizi_buruk ?? 0) + ($stunting->jumlah_gizi_kurang ?? 0);
        $prevalensi = $stunting->persentase ?? 0;
        if ($totalBalita > 0 && !$prevalensi) {
            $prevalensi = number_format(($totalStunting / $totalBalita) * 100, 1);
        } else {
            $prevalensi = number_format((float)$prevalensi, 1);
        }
        $prevalensi .= '%';

        return view('infografis.stunting', compact(
            'profil', 'stunting', 'stuntingHistory', 
            'stuntingData', 'totalBalita', 'totalStunting', 
            'risikoStunting', 'prevalensi'
        ));
    }

    public function bansos(Request $request)
    {
        $profil = ProfilDesa::first();
        $years = StatistikBansos::orderBy('tahun', 'desc')->pluck('tahun')->unique();
        $tahun = $request->get('tahun', $years->first() ?? date('Y'));
        
        $dataBansos = StatistikBansos::with('jenisBansos')
            ->where('tahun', $tahun)
            ->get()
            ->map(function ($item) {
                $item->nama_program = $item->jenisBansos->nama ?? 'Unknown';
                return $item;
            });

        return view('infografis.bansos', compact('profil', 'dataBansos', 'years', 'tahun'));
    }

    public function idm(Request $request)
    {
        $profil = ProfilDesa::first();
        $tahun = $request->get('tahun');
        
        if ($tahun) {
            $idm = DataIdm::where('tahun', $tahun)->first();
        } else {
            $idm = DataIdm::getLatest();
        }

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

    public function sdgs(Request $request)
    {
        $profil = ProfilDesa::first();
        $years = DataSdgs::orderBy('tahun', 'desc')->get(['tahun']);
        $tahun = $request->get('tahun');
        
        if ($tahun) {
            $sdgs = DataSdgs::where('tahun', $tahun)->first();
        } else {
            $sdgs = DataSdgs::getLatest();
        }

        $sdgsLabels = DataSdgs::getSdgsLabels();

        return view('infografis.sdgs', compact('profil', 'sdgs', 'sdgsLabels', 'years'));
    }

    public function cekBansos(Request $request)
    {
        $profil = ProfilDesa::first();
        $nik = $request->input('nik');
        $penerima = null;

        if ($nik) {
            $penerima = PenerimaBansos::searchByNik($nik);
        }

        return view('infografis.cek-bansos', compact('profil', 'nik', 'penerima'));
    }

    public function cekBansosResult(Request $request)
    {
        return $this->cekBansos($request);
    }
}

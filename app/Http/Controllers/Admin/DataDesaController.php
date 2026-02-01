<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StatistikPenduduk;
use App\Models\Dusun;
use App\Models\Apbdes;
use App\Models\ApbdesBidang;
use App\Models\JenisBansos;
use App\Models\StatistikBansos;
use App\Models\PenerimaBansos;
use App\Models\DataIdm;
use App\Models\IndikatorIdm;
use App\Models\DataSdgs;
use App\Models\DataStunting;
use Illuminate\Http\Request;

class DataDesaController extends Controller
{
    // Statistik Penduduk
    public function penduduk()
    {
        $statistiks = StatistikPenduduk::orderBy('tahun', 'desc')->paginate(10);
        $dusuns = Dusun::active()->get();

        return view('admin.data-desa.penduduk', compact('statistiks', 'dusuns'));
    }

    public function pendudukStore(Request $request)
    {
        $validated = $request->validate([
            'tahun' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'bulan' => 'nullable|integer|min:1|max:12',
            'jumlah_kk' => 'required|integer|min:0',
            'jumlah_penduduk' => 'required|integer|min:0',
            'jumlah_laki_laki' => 'required|integer|min:0',
            'jumlah_perempuan' => 'required|integer|min:0',
            'usia_0_4' => 'nullable|integer|min:0',
            'usia_5_9' => 'nullable|integer|min:0',
            'usia_10_14' => 'nullable|integer|min:0',
            'usia_15_19' => 'nullable|integer|min:0',
            'usia_20_24' => 'nullable|integer|min:0',
            'usia_25_29' => 'nullable|integer|min:0',
            'usia_30_34' => 'nullable|integer|min:0',
            'usia_35_39' => 'nullable|integer|min:0',
            'usia_40_44' => 'nullable|integer|min:0',
            'usia_45_49' => 'nullable|integer|min:0',
            'usia_50_54' => 'nullable|integer|min:0',
            'usia_55_59' => 'nullable|integer|min:0',
            'usia_60_64' => 'nullable|integer|min:0',
            'usia_65_plus' => 'nullable|integer|min:0',
            'pendidikan_tidak_sekolah' => 'nullable|integer|min:0',
            'pendidikan_sd' => 'nullable|integer|min:0',
            'pendidikan_smp' => 'nullable|integer|min:0',
            'pendidikan_sma' => 'nullable|integer|min:0',
            'pendidikan_d1_d3' => 'nullable|integer|min:0',
            'pendidikan_s1' => 'nullable|integer|min:0',
            'pendidikan_s2_s3' => 'nullable|integer|min:0',
            'pekerjaan_petani' => 'nullable|integer|min:0',
            'pekerjaan_nelayan' => 'nullable|integer|min:0',
            'pekerjaan_pns' => 'nullable|integer|min:0',
            'pekerjaan_swasta' => 'nullable|integer|min:0',
            'pekerjaan_wiraswasta' => 'nullable|integer|min:0',
            'pekerjaan_buruh' => 'nullable|integer|min:0',
            'pekerjaan_lainnya' => 'nullable|integer|min:0',
            'agama_islam' => 'nullable|integer|min:0',
            'agama_kristen' => 'nullable|integer|min:0',
            'agama_katolik' => 'nullable|integer|min:0',
            'agama_hindu' => 'nullable|integer|min:0',
            'agama_buddha' => 'nullable|integer|min:0',
            'agama_konghucu' => 'nullable|integer|min:0',
        ]);

        StatistikPenduduk::create($validated);

        return redirect()->route('admin.data.penduduk')
            ->with('success', 'Data statistik penduduk berhasil ditambahkan.');
    }

    public function pendudukUpdate(Request $request, StatistikPenduduk $statistik)
    {
        $validated = $request->validate([
            'tahun' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'bulan' => 'nullable|integer|min:1|max:12',
            'jumlah_kk' => 'required|integer|min:0',
            'jumlah_penduduk' => 'required|integer|min:0',
            'jumlah_laki_laki' => 'required|integer|min:0',
            'jumlah_perempuan' => 'required|integer|min:0',
            // ... same validation rules
        ]);

        $statistik->update($validated);

        return redirect()->route('admin.data.penduduk')
            ->with('success', 'Data statistik penduduk berhasil diperbarui.');
    }

    public function pendudukDestroy(StatistikPenduduk $statistik)
    {
        $statistik->delete();

        return redirect()->route('admin.data.penduduk')
            ->with('success', 'Data statistik penduduk berhasil dihapus.');
    }

    public function pendudukImport(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        // TODO: Implement Excel import logic
        return redirect()->route('admin.data.penduduk')
            ->with('success', 'Data penduduk berhasil diimport.');
    }

    // Dusun
    public function dusun()
    {
        $dusuns = Dusun::paginate(10);

        return view('admin.data-desa.dusun', compact('dusuns'));
    }

    public function dusunStore(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kepala_dusun' => 'nullable|string|max:255',
            'jumlah_rt' => 'nullable|integer|min:0',
            'jumlah_rw' => 'nullable|integer|min:0',
            'jumlah_kk' => 'nullable|integer|min:0',
            'jumlah_penduduk' => 'nullable|integer|min:0',
            'luas_wilayah' => 'nullable|numeric|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active', true);

        Dusun::create($validated);

        return redirect()->route('admin.data.dusun')
            ->with('success', 'Data dusun berhasil ditambahkan.');
    }

    public function dusunUpdate(Request $request, Dusun $dusun)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kepala_dusun' => 'nullable|string|max:255',
            'jumlah_rt' => 'nullable|integer|min:0',
            'jumlah_rw' => 'nullable|integer|min:0',
            'jumlah_kk' => 'nullable|integer|min:0',
            'jumlah_penduduk' => 'nullable|integer|min:0',
            'luas_wilayah' => 'nullable|numeric|min:0',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['is_active'] = $request->boolean('is_active');

        $dusun->update($validated);

        return redirect()->route('admin.data.dusun')
            ->with('success', 'Data dusun berhasil diperbarui.');
    }

    public function dusunDestroy(Dusun $dusun)
    {
        $dusun->delete();

        return redirect()->route('admin.data.dusun')
            ->with('success', 'Data dusun berhasil dihapus.');
    }

    // APBDes
    public function apbdes()
    {
        $tahun = request('tahun', date('Y'));
        $apbdes = Apbdes::where('tahun', $tahun)->first();
        $apbdess = Apbdes::with('bidang')->orderBy('tahun', 'desc')->paginate(10);

        // Prepare summary data
        $summary = [
            'pendapatan' => $apbdes->total_pendapatan ?? 0,
            'belanja' => $apbdes->total_belanja ?? 0,
            'pembiayaan' => $apbdes->total_pembiayaan ?? 0,
        ];

        // Prepare form data from stored JSON or empty arrays
        $data = [
            'pendapatan' => $apbdes && $apbdes->detail_pendapatan ? json_decode($apbdes->detail_pendapatan, true) : [],
            'belanja' => $apbdes && $apbdes->detail_belanja ? json_decode($apbdes->detail_belanja, true) : [],
            'pembiayaan' => $apbdes && $apbdes->detail_pembiayaan ? json_decode($apbdes->detail_pembiayaan, true) : [],
        ];

        return view('admin.data-desa.apbdes', compact('apbdess', 'apbdes', 'summary', 'data'));
    }

    public function apbdesStore(Request $request)
    {
        $validated = $request->validate([
            'tahun' => 'required|integer|min:2000|max:' . (date('Y') + 1) . '|unique:apbdes,tahun',
            'pendapatan_asli_desa' => 'nullable|numeric|min:0',
            'pendapatan_transfer' => 'nullable|numeric|min:0',
            'pendapatan_lain' => 'nullable|numeric|min:0',
            'belanja_pegawai' => 'nullable|numeric|min:0',
            'belanja_barang_jasa' => 'nullable|numeric|min:0',
            'belanja_modal' => 'nullable|numeric|min:0',
            'pembiayaan_penerimaan' => 'nullable|numeric|min:0',
            'pembiayaan_pengeluaran' => 'nullable|numeric|min:0',
        ]);

        // Calculate totals
        $validated['total_pendapatan'] = ($validated['pendapatan_asli_desa'] ?? 0) +
            ($validated['pendapatan_transfer'] ?? 0) +
            ($validated['pendapatan_lain'] ?? 0);

        $validated['total_belanja'] = ($validated['belanja_pegawai'] ?? 0) +
            ($validated['belanja_barang_jasa'] ?? 0) +
            ($validated['belanja_modal'] ?? 0);

        $validated['surplus_defisit'] = $validated['total_pendapatan'] - $validated['total_belanja'];

        $validated['total_pembiayaan'] = ($validated['pembiayaan_penerimaan'] ?? 0) -
            ($validated['pembiayaan_pengeluaran'] ?? 0);

        Apbdes::create($validated);

        return redirect()->route('admin.data.apbdes')
            ->with('success', 'Data APBDes berhasil ditambahkan.');
    }

    public function apbdesUpdate(Request $request)
    {
        $validated = $request->validate([
            'tahun' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'pendapatan_asli_desa' => 'nullable|numeric|min:0',
            'pendapatan_transfer' => 'nullable|numeric|min:0',
            'pendapatan_lain' => 'nullable|numeric|min:0',
            'belanja_pegawai' => 'nullable|numeric|min:0',
            'belanja_barang_jasa' => 'nullable|numeric|min:0',
            'belanja_modal' => 'nullable|numeric|min:0',
            'pembiayaan_penerimaan' => 'nullable|numeric|min:0',
            'pembiayaan_pengeluaran' => 'nullable|numeric|min:0',
            'pendapatan' => 'nullable|array',
            'belanja' => 'nullable|array',
            'pembiayaan' => 'nullable|array',
        ]);

        // Calculate totals
        $validated['total_pendapatan'] = ($validated['pendapatan_asli_desa'] ?? 0) +
            ($validated['pendapatan_transfer'] ?? 0) +
            ($validated['pendapatan_lain'] ?? 0);

        $validated['total_belanja'] = ($validated['belanja_pegawai'] ?? 0) +
            ($validated['belanja_barang_jasa'] ?? 0) +
            ($validated['belanja_modal'] ?? 0);

        $validated['surplus_defisit'] = $validated['total_pendapatan'] - $validated['total_belanja'];

        $validated['total_pembiayaan'] = ($validated['pembiayaan_penerimaan'] ?? 0) -
            ($validated['pembiayaan_pengeluaran'] ?? 0);

        // Store detail data as JSON if provided
        if (isset($validated['pendapatan'])) {
            $validated['detail_pendapatan'] = json_encode($validated['pendapatan']);
        }
        if (isset($validated['belanja'])) {
            $validated['detail_belanja'] = json_encode($validated['belanja']);
        }
        if (isset($validated['pembiayaan'])) {
            $validated['detail_pembiayaan'] = json_encode($validated['pembiayaan']);
        }

        unset($validated['pendapatan'], $validated['belanja'], $validated['pembiayaan']);

        Apbdes::updateOrCreate(
            ['tahun' => $validated['tahun']],
            $validated
        );

        return redirect()->route('admin.data.apbdes', ['tahun' => $validated['tahun']])
            ->with('success', 'Data APBDes berhasil diperbarui.');
    }

    public function apbdesDestroy(Apbdes $apbdes)
    {
        $apbdes->delete();

        return redirect()->route('admin.data.apbdes')
            ->with('success', 'Data APBDes berhasil dihapus.');
    }

    // Bansos
    public function bansos()
    {
        $jenisBansos = JenisBansos::withCount('penerima')->get();
        $statistiks = StatistikBansos::with('jenisBansos')
            ->where('tahun', date('Y'))
            ->get();

        return view('admin.data-desa.bansos', compact('jenisBansos', 'statistiks'));
    }

    public function bansosJenisStore(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'kode' => 'nullable|string|max:50',
            'deskripsi' => 'nullable|string',
            'sumber_dana' => 'nullable|string|max:255',
            'is_active' => 'nullable|boolean',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['nama']);
        $validated['is_active'] = $request->boolean('is_active', true);

        JenisBansos::create($validated);

        return redirect()->route('admin.data.bansos')
            ->with('success', 'Jenis bansos berhasil ditambahkan.');
    }

    public function bansosImport(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv|max:2048',
        ]);

        // TODO: Implement Excel import logic for bansos data
        return redirect()->route('admin.data.bansos')
            ->with('success', 'Data bansos berhasil diimport.');
    }

    public function bansosPenerima(Request $request)
    {
        $query = PenerimaBansos::with('jenisBansos');

        // Filter by jenis
        if ($request->filled('jenis')) {
            $query->where('jenis_bansos_id', $request->jenis);
        }

        // Search
        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->q . '%')
                    ->orWhere('nik', 'like', '%' . $request->q . '%');
            });
        }

        $penerimas = $query->latest()->paginate(20);
        $jenisBansos = JenisBansos::active()->get();

        return view('admin.data-desa.bansos-penerima', compact('penerimas', 'jenisBansos'));
    }

    public function bansosPenerimaStore(Request $request)
    {
        $validated = $request->validate([
            'jenis_bansos_id' => 'required|exists:jenis_bansos,id',
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|size:16',
            'no_kk' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'rt' => 'nullable|string|max:10',
            'rw' => 'nullable|string|max:10',
            'dusun' => 'nullable|string|max:255',
            'tahun' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'bulan' => 'nullable|integer|min:1|max:12',
            'nominal' => 'nullable|numeric|min:0',
            'status' => 'required|in:aktif,tidak_aktif',
        ]);

        PenerimaBansos::create($validated);

        // Update statistik
        $this->updateStatistikBansos($validated['jenis_bansos_id'], $validated['tahun']);

        return redirect()->route('admin.data.bansos.penerima')
            ->with('success', 'Penerima bansos berhasil ditambahkan.');
    }

    protected function updateStatistikBansos($jenisId, $tahun)
    {
        $jumlah = PenerimaBansos::where('jenis_bansos_id', $jenisId)
            ->where('tahun', $tahun)
            ->where('status', 'aktif')
            ->count();

        $total = PenerimaBansos::where('jenis_bansos_id', $jenisId)
            ->where('tahun', $tahun)
            ->where('status', 'aktif')
            ->sum('nominal');

        StatistikBansos::updateOrCreate(
            ['jenis_bansos_id' => $jenisId, 'tahun' => $tahun],
            ['jumlah_penerima' => $jumlah, 'total_anggaran' => $total]
        );
    }

    // IDM
    public function idm()
    {
        $tahun = request('tahun', date('Y'));
        $idmData = DataIdm::where('tahun', $tahun)->first();
        $idms = DataIdm::orderBy('tahun', 'desc')->paginate(10);

        // Prepare data for the view
        $idm = [
            'skor' => $idmData->skor_idm ?? 0,
            'status' => $idmData ? ucwords(str_replace('_', ' ', $idmData->status_idm)) : 'Belum Diisi',
            'iks' => $idmData->iks ?? 0,
            'ike' => $idmData->ike ?? 0,
            'ikl' => $idmData->ikl ?? 0,
        ];

        return view('admin.data-desa.idm', compact('idms', 'idm', 'idmData'));
    }

    public function idmStore(Request $request)
    {
        $validated = $request->validate([
            'tahun' => 'required|integer|min:2000|max:' . (date('Y') + 1) . '|unique:data_idm,tahun',
            'skor_idm' => 'required|numeric|min:0|max:1',
            'status_idm' => 'required|in:sangat_tertinggal,tertinggal,berkembang,maju,mandiri',
            'iks' => 'nullable|numeric|min:0|max:1',
            'ike' => 'nullable|numeric|min:0|max:1',
            'ikl' => 'nullable|numeric|min:0|max:1',
            'target_status' => 'nullable|string|max:50',
            'skor_minimal' => 'nullable|numeric|min:0|max:1',
            'penambahan_skor' => 'nullable|numeric',
        ]);

        DataIdm::create($validated);

        return redirect()->route('admin.data.idm')
            ->with('success', 'Data IDM berhasil ditambahkan.');
    }

    public function idmUpdate(Request $request)
    {
        $validated = $request->validate([
            'tahun' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'skor_idm' => 'nullable|numeric|min:0|max:1',
            'status_idm' => 'nullable|in:sangat_tertinggal,tertinggal,berkembang,maju,mandiri',
            'iks' => 'nullable|numeric|min:0|max:1',
            'ike' => 'nullable|numeric|min:0|max:1',
            'ikl' => 'nullable|numeric|min:0|max:1',
            'target_status' => 'nullable|string|max:50',
            'skor_minimal' => 'nullable|numeric|min:0|max:1',
            'penambahan_skor' => 'nullable|numeric',
            'indikator' => 'nullable|array',
        ]);

        // Store indikator data as JSON if provided
        if (isset($validated['indikator'])) {
            $validated['detail_indikator'] = json_encode($validated['indikator']);
            unset($validated['indikator']);
        }

        DataIdm::updateOrCreate(
            ['tahun' => $validated['tahun']],
            $validated
        );

        return redirect()->route('admin.data.idm', ['tahun' => $validated['tahun']])
            ->with('success', 'Data IDM berhasil diperbarui.');
    }

    public function idmDestroy(DataIdm $idm)
    {
        $idm->delete();

        return redirect()->route('admin.data.idm')
            ->with('success', 'Data IDM berhasil dihapus.');
    }

    // SDGs
    public function sdgs()
    {
        $tahun = request('tahun', date('Y'));
        $sdgsData = DataSdgs::where('tahun', $tahun)->first();
        $sdgss = DataSdgs::orderBy('tahun', 'desc')->paginate(10);
        $sdgsLabels = DataSdgs::getSdgsLabels();

        return view('admin.data-desa.sdgs', compact('sdgss', 'sdgsLabels', 'sdgsData'));
    }

    public function sdgsStore(Request $request)
    {
        $rules = [
            'tahun' => 'required|integer|min:2000|max:' . (date('Y') + 1) . '|unique:data_sdgs,tahun',
            'skor_total' => 'nullable|numeric|min:0|max:100',
        ];

        // Add validation for all SDGs scores
        for ($i = 1; $i <= 18; $i++) {
            $rules["sdgs_{$i}"] = 'nullable|numeric|min:0|max:100';
        }

        $validated = $request->validate($rules);

        DataSdgs::create($validated);

        return redirect()->route('admin.data.sdgs')
            ->with('success', 'Data SDGs berhasil ditambahkan.');
    }

    public function sdgsUpdate(Request $request)
    {
        $rules = [
            'tahun' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'skor_total' => 'nullable|numeric|min:0|max:100',
        ];

        for ($i = 1; $i <= 18; $i++) {
            $rules["sdgs_{$i}"] = 'nullable|numeric|min:0|max:100';
        }

        $validated = $request->validate($rules);

        DataSdgs::updateOrCreate(
            ['tahun' => $validated['tahun']],
            $validated
        );

        return redirect()->route('admin.data.sdgs', ['tahun' => $validated['tahun']])
            ->with('success', 'Data SDGs berhasil diperbarui.');
    }

    public function sdgsDestroy(DataSdgs $sdgs)
    {
        $sdgs->delete();

        return redirect()->route('admin.data.sdgs')
            ->with('success', 'Data SDGs berhasil dihapus.');
    }

    // Stunting
    public function stunting()
    {
        $stuntings = DataStunting::orderBy('tahun', 'desc')->paginate(10);

        return view('admin.data-desa.stunting', compact('stuntings'));
    }

    public function stuntingStore(Request $request)
    {
        $validated = $request->validate([
            'tahun' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'bulan' => 'nullable|integer|min:1|max:12',
            'jumlah_balita' => 'required|integer|min:0',
            'jumlah_stunting' => 'required|integer|min:0',
            'jumlah_gizi_buruk' => 'nullable|integer|min:0',
            'jumlah_gizi_kurang' => 'nullable|integer|min:0',
            'catatan' => 'nullable|string',
        ]);

        DataStunting::create($validated);

        return redirect()->route('admin.data.stunting')
            ->with('success', 'Data stunting berhasil ditambahkan.');
    }

    public function stuntingUpdate(Request $request, DataStunting $stunting)
    {
        $validated = $request->validate([
            'tahun' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'bulan' => 'nullable|integer|min:1|max:12',
            'jumlah_balita' => 'required|integer|min:0',
            'jumlah_stunting' => 'required|integer|min:0',
            'jumlah_gizi_buruk' => 'nullable|integer|min:0',
            'jumlah_gizi_kurang' => 'nullable|integer|min:0',
            'catatan' => 'nullable|string',
        ]);

        $stunting->update($validated);

        return redirect()->route('admin.data.stunting')
            ->with('success', 'Data stunting berhasil diperbarui.');
    }

    public function stuntingDestroy(DataStunting $stunting)
    {
        $stunting->delete();

        return redirect()->route('admin.data.stunting')
            ->with('success', 'Data stunting berhasil dihapus.');
    }
}

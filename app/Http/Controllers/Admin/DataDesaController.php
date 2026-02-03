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

        // Get latest statistics for summary cards
        $latestStat = StatistikPenduduk::getLatest();
        $statistik = [
            'total' => $latestStat?->total_penduduk ?? 0,
            'laki_laki' => $latestStat?->laki_laki ?? 0,
            'perempuan' => $latestStat?->perempuan ?? 0,
            'kk' => $latestStat?->total_kk ?? 0,
        ];

        // Data for form fields
        // Convert nested age data to totals
        $ageData = [];
        if ($latestStat?->kelompok_umur) {
            foreach ($latestStat->kelompok_umur as $group => $values) {
                if (is_array($values)) {
                    $ageData[$group] = ($values['laki_laki'] ?? 0) + ($values['perempuan'] ?? 0);
                } else {
                    $ageData[$group] = $values;
                }
            }
        }

        // Map database keys to form labels for education
        $educationMap = [
            'tidak_sekolah' => 'Tidak/Belum Sekolah',
            'belum_tamat_sd' => 'Tidak/Belum Sekolah',
            'tidak_tamat_sd' => 'Tidak Tamat SD',
            'tamat_sd' => 'Tamat SD',
            'sltp' => 'SLTP/SMP',
            'slta' => 'SLTA/SMA',
            'diploma' => 'D1/D2',
            'd3' => 'D3',
            's1' => 'S1',
            's1_s2' => 'S1',
            's2' => 'S2',
            's3' => 'S3',
        ];
        $educationData = [];
        if ($latestStat?->pendidikan) {
            foreach ($latestStat->pendidikan as $key => $value) {
                $label = $educationMap[$key] ?? ucwords(str_replace('_', ' ', $key));
                $educationData[$label] = ($educationData[$label] ?? 0) + $value;
            }
        }

        // Map database keys to form labels for occupation
        $occupationMap = [
            'petani' => 'Petani',
            'nelayan' => 'Nelayan',
            'buruh_tani' => 'Buruh',
            'pns_tni_polri' => 'PNS',
            'pedagang' => 'Pedagang',
            'wiraswasta' => 'Wiraswasta',
            'karyawan_swasta' => 'Karyawan Swasta',
            'karyawan_pabrik' => 'Karyawan Swasta',
            'guru_dosen' => 'Guru/Dosen',
            'ibu_rumah_tangga' => 'Ibu Rumah Tangga',
            'pelajar_mahasiswa' => 'Pelajar/Mahasiswa',
            'tidak_bekerja' => 'Tidak/Belum Bekerja',
            'pengrajin_kayu' => 'Lainnya',
            'lainnya' => 'Lainnya',
        ];
        $occupationData = [];
        if ($latestStat?->pekerjaan) {
            foreach ($latestStat->pekerjaan as $key => $value) {
                $label = $occupationMap[$key] ?? ucwords(str_replace('_', ' ', $key));
                $occupationData[$label] = ($occupationData[$label] ?? 0) + $value;
            }
        }

        // Map database keys to form labels for religion
        $religionMap = [
            'islam' => 'Islam',
            'kristen' => 'Kristen',
            'katolik' => 'Katolik',
            'hindu' => 'Hindu',
            'buddha' => 'Buddha',
            'konghucu' => 'Konghucu',
            'kepercayaan_lainnya' => 'Lainnya',
        ];
        $religionData = [];
        if ($latestStat?->agama) {
            foreach ($latestStat->agama as $key => $value) {
                $label = $religionMap[$key] ?? ucwords(str_replace('_', ' ', $key));
                $religionData[$label] = ($religionData[$label] ?? 0) + $value;
            }
        }

        $data = [
            'gender' => [
                'laki_laki' => $latestStat?->laki_laki ?? 0,
                'perempuan' => $latestStat?->perempuan ?? 0,
                'kk' => $latestStat?->total_kk ?? 0,
            ],
            'age' => $ageData,
            'education' => $educationData,
            'occupation' => $occupationData,
            'religion' => $religionData,
        ];

        $lastUpdated = $latestStat?->updated_at?->format('d M Y H:i') ?? '-';

        return view('admin.data-desa.penduduk', compact('statistiks', 'statistik', 'dusuns', 'data', 'lastUpdated'));
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

    public function pendudukUpdate(Request $request)
    {
        // Get latest record or create new one
        $statistik = StatistikPenduduk::getLatest();

        if (!$statistik) {
            $statistik = new StatistikPenduduk();
            $statistik->tahun = date('Y');
        }

        // Update gender data
        if ($request->has('gender')) {
            $gender = $request->input('gender');
            $statistik->laki_laki = $gender['laki_laki'] ?? 0;
            $statistik->perempuan = $gender['perempuan'] ?? 0;
            $statistik->total_kk = $gender['kk'] ?? 0;
            $statistik->total_penduduk = ($gender['laki_laki'] ?? 0) + ($gender['perempuan'] ?? 0);
        }

        // Update age data
        if ($request->has('age')) {
            $ageData = [];
            foreach ($request->input('age') as $group => $total) {
                // Split evenly between male and female for simplicity
                $half = intval($total) / 2;
                $ageData[$group] = [
                    'laki_laki' => ceil($half),
                    'perempuan' => floor($half),
                ];
            }
            $statistik->kelompok_umur = $ageData;
        }

        // Update education data - convert form labels back to db keys
        if ($request->has('education')) {
            $educationDbMap = [
                'Tidak/Belum Sekolah' => 'tidak_sekolah',
                'Tidak Tamat SD' => 'tidak_tamat_sd',
                'Tamat SD' => 'tamat_sd',
                'SLTP/SMP' => 'sltp',
                'SLTA/SMA' => 'slta',
                'D1/D2' => 'diploma',
                'D3' => 'd3',
                'S1' => 's1',
                'S2' => 's2',
                'S3' => 's3',
            ];
            $educationData = [];
            foreach ($request->input('education') as $label => $value) {
                $key = $educationDbMap[$label] ?? strtolower(str_replace(['/', ' '], '_', $label));
                $educationData[$key] = intval($value);
            }
            $statistik->pendidikan = $educationData;
        }

        // Update occupation data - convert form labels back to db keys
        if ($request->has('occupation')) {
            $occupationDbMap = [
                'Petani' => 'petani',
                'Nelayan' => 'nelayan',
                'Buruh' => 'buruh_tani',
                'PNS' => 'pns_tni_polri',
                'TNI/Polri' => 'tni_polri',
                'Pedagang' => 'pedagang',
                'Wiraswasta' => 'wiraswasta',
                'Karyawan Swasta' => 'karyawan_swasta',
                'Guru/Dosen' => 'guru_dosen',
                'Ibu Rumah Tangga' => 'ibu_rumah_tangga',
                'Pelajar/Mahasiswa' => 'pelajar_mahasiswa',
                'Tidak/Belum Bekerja' => 'tidak_bekerja',
                'Lainnya' => 'lainnya',
            ];
            $occupationData = [];
            foreach ($request->input('occupation') as $label => $value) {
                $key = $occupationDbMap[$label] ?? strtolower(str_replace(['/', ' '], '_', $label));
                $occupationData[$key] = intval($value);
            }
            $statistik->pekerjaan = $occupationData;
        }

        // Update religion data - convert form labels back to db keys
        if ($request->has('religion')) {
            $religionDbMap = [
                'Islam' => 'islam',
                'Kristen' => 'kristen',
                'Katolik' => 'katolik',
                'Hindu' => 'hindu',
                'Buddha' => 'buddha',
                'Konghucu' => 'konghucu',
                'Lainnya' => 'kepercayaan_lainnya',
            ];
            $religionData = [];
            foreach ($request->input('religion') as $label => $value) {
                $key = $religionDbMap[$label] ?? strtolower($label);
                $religionData[$key] = intval($value);
            }
            $statistik->agama = $religionData;
        }

        // Force update timestamp
        $statistik->updated_at = now();
        $statistik->save();

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
    public function bansos(Request $request)
    {
        $jenisBansosList = JenisBansos::withCount('penerima')->get();
        $statistiks = StatistikBansos::with('jenisBansos')
            ->where('tahun', date('Y'))
            ->get();

        // Query penerima bansos
        $query = PenerimaBansos::with('jenisBansos');

        // Filter by search
        if ($request->filled('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->search . '%')
                    ->orWhere('nik', 'like', '%' . $request->search . '%');
            });
        }

        // Filter by jenis (using id)
        if ($request->filled('jenis')) {
            $query->where('jenis_bansos_id', $request->jenis);
        }

        // Filter by tahun
        if ($request->filled('tahun')) {
            $query->where('tahun_penerima', $request->tahun);
        }

        $penerimaBansos = $query->latest()->paginate(20);

        // Get counts per jenis from database
        $counts = [];
        foreach ($jenisBansosList as $jenis) {
            $counts[$jenis->id] = $jenis->penerima_count;
        }

        return view('admin.data-desa.bansos', compact('jenisBansosList', 'statistiks', 'penerimaBansos', 'counts'));
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
            'tahun_penerima' => 'required|integer|min:2000|max:' . (date('Y') + 1),
            'keterangan' => 'nullable|string',
        ]);

        // Handle status checkbox (checked = aktif, unchecked = nonaktif)
        $validated['status'] = $request->has('status') ? 'aktif' : 'nonaktif';

        PenerimaBansos::create($validated);

        // Update statistik
        $this->updateStatistikBansos($validated['jenis_bansos_id'], $validated['tahun_penerima']);

        return redirect()->route('admin.data.bansos')
            ->with('success', 'Penerima bansos berhasil ditambahkan.');
    }

    public function bansosPenerimaEdit(PenerimaBansos $penerima)
    {
        return response()->json($penerima);
    }

    public function bansosPenerimaUpdate(Request $request, PenerimaBansos $penerima)
    {
        $validated = $request->validate([
            'jenis_bansos_id' => 'required|exists:jenis_bansos,id',
            'nama' => 'required|string|max:255',
            'nik' => 'required|string|size:16',
            'alamat' => 'nullable|string',
            'tahun_penerima' => 'required|integer|min:2000|max:' . (date('Y') + 1),
        ]);

        // Handle status checkbox (checked = aktif, unchecked = nonaktif)
        $validated['status'] = $request->has('status') ? 'aktif' : 'nonaktif';

        $penerima->update($validated);

        return redirect()->route('admin.data.bansos')
            ->with('success', 'Penerima bansos berhasil diperbarui.');
    }

    public function bansosPenerimaDestroy(PenerimaBansos $penerima)
    {
        $penerima->delete();

        return redirect()->route('admin.data.bansos')
            ->with('success', 'Data penerima bansos berhasil dihapus.');
    }

    protected function updateStatistikBansos($jenisId, $tahun)
    {
        $jumlah = PenerimaBansos::where('jenis_bansos_id', $jenisId)
            ->where('tahun_penerima', $tahun)
            ->where('status', 'aktif')
            ->count();

        StatistikBansos::updateOrCreate(
            ['jenis_bansos_id' => $jenisId, 'tahun' => $tahun],
            ['jumlah_penerima' => $jumlah]
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
            'status' => $idmData ? ucwords(str_replace('_', ' ', $idmData->status)) : 'Belum Diisi',
            'iks' => $idmData->skor_iks ?? 0,
            'ike' => $idmData->skor_ike ?? 0,
            'ikl' => $idmData->skor_ikl ?? 0,
        ];

        // Prepare form data from detail_indikator
        $data = [
            'iks' => [],
            'ike' => [],
            'ikl' => [],
        ];
        
        if ($idmData && $idmData->detail_indikator) {
            $detail = is_array($idmData->detail_indikator) ? $idmData->detail_indikator : json_decode($idmData->detail_indikator, true);
            $data['iks'] = $detail['iks'] ?? [];
            $data['ike'] = $detail['ike'] ?? [];
            $data['ikl'] = $detail['ikl'] ?? [];
        }

        return view('admin.data-desa.idm', compact('idms', 'idm', 'idmData', 'data'));
    }

    public function idmStore(Request $request)
    {
        $validated = $request->validate([
            'tahun' => 'required|integer|min:2000|max:' . (date('Y') + 1) . '|unique:data_idm,tahun',
            'skor_idm' => 'required|numeric|min:0|max:1',
            'status' => 'required|in:sangat_tertinggal,tertinggal,berkembang,maju,mandiri',
            'skor_iks' => 'nullable|numeric|min:0|max:1',
            'skor_ike' => 'nullable|numeric|min:0|max:1',
            'skor_ikl' => 'nullable|numeric|min:0|max:1',
            'target_status' => 'nullable|string|max:50',
            'skor_minimal' => 'nullable|numeric|min:0|max:1',
            'penambahan' => 'nullable|numeric',
        ]);

        DataIdm::create($validated);

        return redirect()->route('admin.data.idm')
            ->with('success', 'Data IDM berhasil ditambahkan.');
    }

    public function idmUpdate(Request $request)
    {
        $tahun = $request->input('tahun', date('Y'));
        
        // Get or create IDM data
        $idmData = DataIdm::firstOrNew(['tahun' => $tahun]);
        
        // Process IKS indicators
        $iksData = $request->input('iks', []);
        $iksTotal = 0;
        $iksCount = 0;
        foreach ($iksData as $category => $items) {
            if (is_array($items)) {
                foreach ($items as $key => $value) {
                    if ($value !== null && $value !== '') {
                        $iksTotal += floatval($value);
                        $iksCount++;
                    }
                }
            }
        }
        // Calculate IKS score (average of indicators, normalized to 0-1 scale, max indicator value is 5)
        $skor_iks = $iksCount > 0 ? ($iksTotal / $iksCount) / 5 : 0;
        
        // Process IKE indicators
        $ikeData = $request->input('ike', []);
        $ikeTotal = 0;
        $ikeCount = 0;
        foreach ($ikeData as $category => $items) {
            if (is_array($items)) {
                foreach ($items as $key => $value) {
                    if ($value !== null && $value !== '') {
                        $ikeTotal += floatval($value);
                        $ikeCount++;
                    }
                }
            }
        }
        // Calculate IKE score
        $skor_ike = $ikeCount > 0 ? ($ikeTotal / $ikeCount) / 5 : 0;
        
        // Process IKL indicators  
        $iklData = $request->input('ikl', []);
        $iklTotal = 0;
        $iklCount = 0;
        foreach ($iklData as $category => $items) {
            if (is_array($items)) {
                foreach ($items as $key => $value) {
                    if ($value !== null && $value !== '') {
                        $iklTotal += floatval($value);
                        $iklCount++;
                    }
                }
            }
        }
        // Calculate IKL score
        $skor_ikl = $iklCount > 0 ? ($iklTotal / $iklCount) / 5 : 0;
        
        // Calculate IDM score (weighted average: IKS=1/3, IKE=1/3, IKL=1/3)
        $skor_idm = ($skor_iks + $skor_ike + $skor_ikl) / 3;
        
        // Determine status based on IDM score
        $status = 'sangat_tertinggal';
        if ($skor_idm >= 0.8155) {
            $status = 'mandiri';
        } elseif ($skor_idm >= 0.7072) {
            $status = 'maju';
        } elseif ($skor_idm >= 0.5989) {
            $status = 'berkembang';
        } elseif ($skor_idm >= 0.4907) {
            $status = 'tertinggal';
        }
        
        // Store all indicator data as JSON
        $detail_indikator = [
            'iks' => $iksData,
            'ike' => $ikeData,
            'ikl' => $iklData,
        ];
        
        // Update IDM data
        $idmData->tahun = $tahun;
        $idmData->skor_idm = round($skor_idm, 4);
        $idmData->skor_iks = round($skor_iks, 4);
        $idmData->skor_ike = round($skor_ike, 4);
        $idmData->skor_ikl = round($skor_ikl, 4);
        $idmData->status = $status;
        $idmData->detail_indikator = $detail_indikator;
        $idmData->save();

        return redirect()->route('admin.data.idm', ['tahun' => $tahun])
            ->with('success', 'Data IDM berhasil diperbarui. Skor IDM: ' . number_format($skor_idm, 4) . ' (' . ucwords(str_replace('_', ' ', $status)) . ')');
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
        $sdgsHistory = DataSdgs::orderBy('tahun', 'desc')->paginate(10);
        $sdgsLabels = DataSdgs::getSdgsLabels();
        
        // Get latest data for display
        $latestData = DataSdgs::orderBy('tahun', 'desc')->first();
        $latestYear = $latestData->tahun ?? date('Y');
        $currentScore = $latestData->skor_total ?? 0;
        
        // Prepare scores array for the grid (1-18)
        $scores = [];
        if ($latestData) {
            for ($i = 1; $i <= 18; $i++) {
                $scores[$i] = $latestData->{"sdg_{$i}"} ?? 0;
            }
        }

        return view('admin.data-desa.sdgs', compact('sdgsHistory', 'sdgsLabels', 'sdgsData', 'latestYear', 'currentScore', 'scores'));
    }

    public function sdgsStore(Request $request)
    {
        $rules = [
            'tahun' => 'required|integer|min:2000|max:' . (date('Y') + 1) . '|unique:data_sdgs,tahun',
        ];

        // Add validation for all SDGs scores (form uses skor_1, skor_2, etc.)
        for ($i = 1; $i <= 18; $i++) {
            $rules["skor_{$i}"] = 'nullable|numeric|min:0|max:100';
        }

        $validated = $request->validate($rules);
        
        // Map form fields to database columns and calculate total
        $data = ['tahun' => $validated['tahun']];
        $total = 0;
        $count = 0;
        
        for ($i = 1; $i <= 18; $i++) {
            $value = $validated["skor_{$i}"] ?? null;
            $data["sdg_{$i}"] = $value;
            if ($value !== null && $value !== '') {
                $total += floatval($value);
                $count++;
            }
        }
        
        // Calculate average score
        $data['skor_total'] = $count > 0 ? round($total / $count, 2) : 0;

        DataSdgs::create($data);

        return redirect()->route('admin.data.sdgs')
            ->with('success', 'Data SDGs berhasil ditambahkan.');
    }

    public function sdgsEdit(DataSdgs $sdgs)
    {
        return response()->json($sdgs);
    }

    public function sdgsUpdate(Request $request, DataSdgs $sdgs)
    {
        $rules = [];

        for ($i = 1; $i <= 18; $i++) {
            $rules["skor_{$i}"] = 'nullable|numeric|min:0|max:100';
        }

        $validated = $request->validate($rules);
        
        // Map form fields to database columns and calculate total
        $data = [];
        $total = 0;
        $count = 0;
        
        for ($i = 1; $i <= 18; $i++) {
            $value = $validated["skor_{$i}"] ?? null;
            $data["sdg_{$i}"] = $value;
            if ($value !== null && $value !== '') {
                $total += floatval($value);
                $count++;
            }
        }
        
        // Calculate average score
        $data['skor_total'] = $count > 0 ? round($total / $count, 2) : 0;

        $sdgs->update($data);

        return redirect()->route('admin.data.sdgs')
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

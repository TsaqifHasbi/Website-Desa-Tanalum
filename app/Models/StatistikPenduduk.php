<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatistikPenduduk extends Model
{
    use HasFactory;

    protected $table = 'statistik_penduduk';

    protected $fillable = [
        'tahun',
        'bulan',
        'total_penduduk',
        'total_kk',
        'laki_laki',
        'perempuan',
        'kelompok_umur',
        'pendidikan',
        'pekerjaan',
        'agama',
        'status_perkawinan',
        'per_dusun',
        'wajib_pilih',
        'kelahiran',
        'kematian',
        'pindah_masuk',
        'pindah_keluar',
    ];

    protected $casts = [
        'kelompok_umur' => 'array',
        'pendidikan' => 'array',
        'pekerjaan' => 'array',
        'agama' => 'array',
        'status_perkawinan' => 'array',
        'per_dusun' => 'array',
        'wajib_pilih' => 'array',
    ];

    /**
     * Scope by tahun.
     */
    public function scopeTahun($query, $tahun)
    {
        return $query->where('tahun', $tahun);
    }

    /**
     * Get latest statistics.
     */
    public static function getLatest()
    {
        return self::orderBy('tahun', 'desc')
            ->orderBy('bulan', 'desc')
            ->first();
    }

    /**
     * Get data for age pyramid chart.
     */
    public function getPyramidDataAttribute(): array
    {
        if (!$this->kelompok_umur) {
            return [];
        }

        return $this->kelompok_umur;
    }

    /**
     * Accessor for penduduk_by_pendidikan with readable labels.
     */
    public function getPendudukByPendidikanAttribute(): array
    {
        if (!$this->pendidikan) {
            return [];
        }

        $labels = [
            'tidak_tamat_sd' => 'Tidak Tamat SD',
            'belum_tamat_sd' => 'Tidak/Belum Tamat',
            'tamat_sd' => 'Tamat SD/Sederajat',
            'sltp' => 'Tamat SLTP/Sederajat',
            'slta' => 'Tamat SLTA/Sederajat',
            'diploma' => 'D1/D2/D3 (Diploma)',
            's1_s2' => 'S1/S2',
            'tidak_sekolah' => 'Tidak Sekolah',
            's1' => 'S1',
            's2' => 'S2',
            's3' => 'S3',
        ];

        $result = [];
        foreach ($this->pendidikan as $key => $value) {
            $label = $labels[$key] ?? ucwords(str_replace('_', ' ', $key));
            $result[$label] = $value;
        }

        return $result;
    }

    /**
     * Accessor for penduduk_by_pekerjaan with readable labels.
     */
    public function getPendudukByPekerjaanAttribute(): array
    {
        if (!$this->pekerjaan) {
            return [];
        }

        $labels = [
            'petani' => 'Petani',
            'buruh_tani' => 'Buruh Tani',
            'karyawan_pabrik' => 'Karyawan Pabrik',
            'pengrajin_kayu' => 'Pengrajin Kayu',
            'pns_tni_polri' => 'PNS/TNI/Polri',
            'pedagang' => 'Pedagang',
            'lainnya' => 'Lain-lain',
            'pelajar_mahasiswa' => 'Pelajar/Mahasiswa',
            'belum_tidak_bekerja' => 'Belum/Tidak Bekerja',
            'mengurus_rumah_tangga' => 'Ibu Rumah Tangga',
            'karyawan_swasta' => 'Karyawan Swasta',
            'wiraswasta' => 'Wiraswasta',
            'pns' => 'PNS',
        ];

        $result = [];
        foreach ($this->pekerjaan as $key => $value) {
            $label = $labels[$key] ?? ucwords(str_replace('_', ' ', $key));
            $result[$label] = $value;
        }

        return $result;
    }

    /**
     * Accessor for penduduk_by_usia with readable labels.
     */
    public function getPendudukByUsiaAttribute(): array
    {
        if (!$this->kelompok_umur) {
            return [];
        }

        // Define the correct chronological order for age groups based on database keys
        $orderedKeys = [
            '0-4', '5-9', '10-14', '15-19', '20-24', '25-29', '30-34', 
            '35-39', '40-44', '45-49', '50-54', '55-59', '60-64', '65+'
        ];

        $result = [];
        foreach ($orderedKeys as $key) {
            if (isset($this->kelompok_umur[$key])) {
                $value = $this->kelompok_umur[$key];
                $total = ($value['laki_laki'] ?? 0) + ($value['perempuan'] ?? 0);
                $result[$key . ' Tahun'] = $total;
            }
        }

        return $result;
    }

    /**
     * Get default kelompok umur structure.
     */
    public static function getDefaultKelompokUmur(): array
    {
        return [
            '0-4' => ['laki_laki' => 0, 'perempuan' => 0],
            '5-9' => ['laki_laki' => 0, 'perempuan' => 0],
            '10-14' => ['laki_laki' => 0, 'perempuan' => 0],
            '15-19' => ['laki_laki' => 0, 'perempuan' => 0],
            '20-24' => ['laki_laki' => 0, 'perempuan' => 0],
            '25-29' => ['laki_laki' => 0, 'perempuan' => 0],
            '30-34' => ['laki_laki' => 0, 'perempuan' => 0],
            '35-39' => ['laki_laki' => 0, 'perempuan' => 0],
            '40-44' => ['laki_laki' => 0, 'perempuan' => 0],
            '45-49' => ['laki_laki' => 0, 'perempuan' => 0],
            '50-54' => ['laki_laki' => 0, 'perempuan' => 0],
            '55-59' => ['laki_laki' => 0, 'perempuan' => 0],
            '60-64' => ['laki_laki' => 0, 'perempuan' => 0],
            '65-69' => ['laki_laki' => 0, 'perempuan' => 0],
            '70-74' => ['laki_laki' => 0, 'perempuan' => 0],
            '75+' => ['laki_laki' => 0, 'perempuan' => 0],
        ];
    }

    /**
     * Get default pendidikan structure.
     */
    public static function getDefaultPendidikan(): array
    {
        return [
            'tidak_sekolah' => 0,
            'belum_tamat_sd' => 0,
            'tamat_sd' => 0,
            'sltp' => 0,
            'slta' => 0,
            'diploma' => 0,
            's1' => 0,
            's2' => 0,
            's3' => 0,
        ];
    }

    /**
     * Get default agama structure.
     */
    public static function getDefaultAgama(): array
    {
        return [
            'islam' => 0,
            'kristen' => 0,
            'katolik' => 0,
            'hindu' => 0,
            'buddha' => 0,
            'konghucu' => 0,
            'kepercayaan_lainnya' => 0,
        ];
    }

    /**
     * Get default status perkawinan structure.
     */
    public static function getDefaultStatusPerkawinan(): array
    {
        return [
            'belum_kawin' => 0,
            'kawin' => 0,
            'kawin_tercatat' => 0,
            'cerai_hidup' => 0,
            'cerai_mati' => 0,
            'kawin_tidak_tercatat' => 0,
        ];
    }

    /**
     * Accessor for jumlah_penduduk (alias of total_penduduk).
     */
    public function getJumlahPendudukAttribute()
    {
        return $this->total_penduduk;
    }

    /**
     * Accessor for jumlah_laki_laki (alias of laki_laki).
     */
    public function getJumlahLakiLakiAttribute()
    {
        return $this->laki_laki;
    }

    /**
     * Accessor for jumlah_perempuan (alias of perempuan).
     */
    public function getJumlahPerempuanAttribute()
    {
        return $this->perempuan;
    }

    /**
     * Accessor for jumlah_kk (alias of total_kk).
     */
    public function getJumlahKkAttribute()
    {
        return $this->total_kk;
    }

    // ========== PENDIDIKAN ACCESSORS ==========

    /**
     * Accessor for tidak_sekolah from pendidikan JSON.
     */
    public function getTidakSekolahAttribute()
    {
        return ($this->pendidikan['tidak_tamat_sd'] ?? 0) + ($this->pendidikan['belum_tamat_sd'] ?? 0);
    }

    /**
     * Accessor for SD from pendidikan JSON.
     */
    public function getSdAttribute()
    {
        return $this->pendidikan['tamat_sd'] ?? 0;
    }

    /**
     * Accessor for SMP from pendidikan JSON.
     */
    public function getSmpAttribute()
    {
        return $this->pendidikan['sltp'] ?? 0;
    }

    /**
     * Accessor for SMA from pendidikan JSON.
     */
    public function getSmaAttribute()
    {
        return $this->pendidikan['slta'] ?? 0;
    }

    /**
     * Accessor for diploma from pendidikan JSON.
     */
    public function getDiplomaAttribute()
    {
        return $this->pendidikan['diploma'] ?? 0;
    }

    /**
     * Accessor for sarjana from pendidikan JSON.
     */
    public function getSarjanaAttribute()
    {
        return $this->pendidikan['s1_s2'] ?? ($this->pendidikan['s1'] ?? 0);
    }

    /**
     * Accessor for pascasarjana from pendidikan JSON.
     */
    public function getPascasarjanaAttribute()
    {
        return ($this->pendidikan['s2'] ?? 0) + ($this->pendidikan['s3'] ?? 0);
    }

    // ========== PEKERJAAN ACCESSORS ==========

    /**
     * Accessor for petani from pekerjaan JSON.
     */
    public function getPetaniAttribute()
    {
        return ($this->pekerjaan['petani'] ?? 0) + ($this->pekerjaan['buruh_tani'] ?? 0);
    }

    /**
     * Accessor for nelayan from pekerjaan JSON.
     */
    public function getNelayanAttribute()
    {
        return $this->pekerjaan['nelayan'] ?? 0;
    }

    /**
     * Accessor for pedagang from pekerjaan JSON.
     */
    public function getPedagangAttribute()
    {
        return $this->pekerjaan['pedagang'] ?? 0;
    }

    /**
     * Accessor for PNS from pekerjaan JSON.
     */
    public function getPnsAttribute()
    {
        return $this->pekerjaan['pns_tni_polri'] ?? ($this->pekerjaan['pns'] ?? 0);
    }

    /**
     * Accessor for karyawan from pekerjaan JSON.
     */
    public function getKaryawanAttribute()
    {
        return $this->pekerjaan['karyawan_pabrik'] ?? ($this->pekerjaan['karyawan_swasta'] ?? 0);
    }

    /**
     * Accessor for wiraswasta from pekerjaan JSON.
     */
    public function getWiraswastaAttribute()
    {
        return ($this->pekerjaan['pengrajin_kayu'] ?? 0) + ($this->pekerjaan['wiraswasta'] ?? 0);
    }

    /**
     * Accessor for pekerjaan_lain from pekerjaan JSON.
     */
    public function getPekerjaanLainAttribute()
    {
        return $this->pekerjaan['lainnya'] ?? 0;
    }

    // ========== AGAMA ACCESSORS ==========

    /**
     * Accessor for islam from agama JSON.
     */
    public function getIslamAttribute()
    {
        return $this->agama['islam'] ?? 0;
    }

    /**
     * Accessor for kristen from agama JSON.
     */
    public function getKristenAttribute()
    {
        return $this->agama['kristen'] ?? 0;
    }

    /**
     * Accessor for katolik from agama JSON.
     */
    public function getKatolikAttribute()
    {
        return $this->agama['katolik'] ?? 0;
    }

    /**
     * Accessor for hindu from agama JSON.
     */
    public function getHinduAttribute()
    {
        return $this->agama['hindu'] ?? 0;
    }

    /**
     * Accessor for buddha from agama JSON.
     */
    public function getBuddhaAttribute()
    {
        return $this->agama['buddha'] ?? 0;
    }

    /**
     * Accessor for konghucu from agama JSON.
     */
    public function getKonghucuAttribute()
    {
        return $this->agama['konghucu'] ?? 0;
    }
    /**
     * Helper to sum age groups.
     */
    private function sumAgeGroups(array $keys): int
    {
        if (!$this->kelompok_umur) return 0;
        
        $total = 0;
        foreach ($keys as $key) {
            if (isset($this->kelompok_umur[$key])) {
                $total += ($this->kelompok_umur[$key]['laki_laki'] ?? 0) + ($this->kelompok_umur[$key]['perempuan'] ?? 0);
            }
        }
        return $total;
    }

    public function getUsia05Attribute()
    {
        return $this->sumAgeGroups(['0-4']);
    }

    public function getUsia612Attribute()
    {
        return $this->sumAgeGroups(['5-9']);
    }

    public function getUsia1317Attribute()
    {
        return $this->sumAgeGroups(['10-14']);
    }

    public function getUsia1825Attribute()
    {
        return $this->sumAgeGroups(['15-19', '20-24']);
    }

    public function getUsia2640Attribute()
    {
        return $this->sumAgeGroups(['25-29', '30-34', '35-39']);
    }

    public function getUsia4160Attribute()
    {
        return $this->sumAgeGroups(['40-44', '45-49', '50-54', '55-59']);
    }

    public function getUsia60PlusAttribute()
    {
        return $this->sumAgeGroups(['60-64', '65-69', '70-74', '75+']);
    }
}

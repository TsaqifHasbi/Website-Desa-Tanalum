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
}

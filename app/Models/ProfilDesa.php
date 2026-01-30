<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilDesa extends Model
{
    use HasFactory;

    protected $table = 'profil_desa';

    protected $fillable = [
        'nama_desa',
        'kode_desa',
        'kecamatan',
        'kabupaten',
        'provinsi',
        'kode_pos',
        'alamat_kantor',
        'telepon',
        'email',
        'website',
        'logo',
        'visi',
        'misi',
        'sejarah',
        'luas_wilayah',
        'jumlah_penduduk',
        'jumlah_kk',
        'batas_utara',
        'batas_selatan',
        'batas_timur',
        'batas_barat',
        'latitude',
        'longitude',
        'kode_wilayah',
        'sosial_media',
    ];

    protected $casts = [
        'sosial_media' => 'array',
        'luas_wilayah' => 'decimal:2',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    /**
     * Get formatted luas wilayah.
     */
    public function getLuasWilayahFormatAttribute(): string
    {
        if (!$this->luas_wilayah) {
            return '-';
        }

        if ($this->luas_wilayah >= 1000000) {
            return number_format($this->luas_wilayah / 1000000, 2) . ' km²';
        }

        return number_format($this->luas_wilayah, 0) . ' m²';
    }

    /**
     * Get full address.
     */
    public function getAlamatLengkapAttribute(): string
    {
        $parts = array_filter([
            $this->nama_desa,
            'Kecamatan ' . $this->kecamatan,
            'Kabupaten ' . $this->kabupaten,
            'Provinsi ' . $this->provinsi,
            $this->kode_pos,
        ]);

        return implode(', ', $parts);
    }
}

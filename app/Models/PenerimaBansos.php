<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PenerimaBansos extends Model
{
    use HasFactory;

    protected $table = 'penerima_bansos';

    protected $fillable = [
        'jenis_bansos_id',
        'nik',
        'nama',
        'no_kk',
        'alamat',
        'dusun',
        'rt',
        'rw',
        'tahun_penerima',
        'status',
        'keterangan',
    ];

    /**
     * Get jenis bansos.
     */
    public function jenisBansos(): BelongsTo
    {
        return $this->belongsTo(JenisBansos::class, 'jenis_bansos_id');
    }

    /**
     * Scope by NIK.
     */
    public function scopeByNik($query, $nik)
    {
        return $query->where('nik', $nik);
    }

    /**
     * Scope by tahun.
     */
    public function scopeTahun($query, $tahun)
    {
        return $query->where('tahun_penerima', $tahun);
    }

    /**
     * Scope aktif.
     */
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }

    /**
     * Get status label.
     */
    public function getStatusLabelAttribute(): string
    {
        $labels = [
            'aktif' => 'Aktif',
            'tidak_aktif' => 'Tidak Aktif',
            'selesai' => 'Selesai',
        ];

        return $labels[$this->status] ?? $this->status;
    }

    /**
     * Get alamat lengkap.
     */
    public function getAlamatLengkapAttribute(): string
    {
        $parts = array_filter([
            $this->alamat,
            $this->rt ? 'RT ' . $this->rt : null,
            $this->rw ? 'RW ' . $this->rw : null,
            $this->dusun ? 'Dusun ' . $this->dusun : null,
        ]);

        return implode(', ', $parts);
    }

    /**
     * Search penerima by NIK.
     */
    public static function searchByNik($nik)
    {
        return self::with('jenisBansos')
            ->where('nik', $nik)
            ->aktif()
            ->get();
    }
}

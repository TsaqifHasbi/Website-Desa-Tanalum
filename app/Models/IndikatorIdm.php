<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IndikatorIdm extends Model
{
    use HasFactory;

    protected $table = 'indikator_idm';

    protected $fillable = [
        'data_idm_id',
        'nomor',
        'nama_indikator',
        'skor',
        'keterangan',
        'kegiatan_dapat_dilakukan',
        'kantor_pelaksana',
        'volume',
        'satuan',
        'perkiraan_biaya',
        'sumber_biaya',
        'kategori',
    ];

    protected $casts = [
        'skor' => 'decimal:4',
        'volume' => 'decimal:2',
        'perkiraan_biaya' => 'decimal:2',
    ];

    /**
     * Get data IDM.
     */
    public function dataIdm(): BelongsTo
    {
        return $this->belongsTo(DataIdm::class, 'data_idm_id');
    }

    /**
     * Scope by kategori.
     */
    public function scopeKategori($query, $kategori)
    {
        return $query->where('kategori', $kategori);
    }

    /**
     * Scope IKS.
     */
    public function scopeIks($query)
    {
        return $query->where('kategori', 'iks');
    }

    /**
     * Scope IKE.
     */
    public function scopeIke($query)
    {
        return $query->where('kategori', 'ike');
    }

    /**
     * Scope IKL.
     */
    public function scopeIkl($query)
    {
        return $query->where('kategori', 'ikl');
    }

    /**
     * Get kategori label.
     */
    public function getKategoriLabelAttribute(): string
    {
        $labels = [
            'iks' => 'Indeks Ketahanan Sosial',
            'ike' => 'Indeks Ketahanan Ekonomi',
            'ikl' => 'Indeks Ketahanan Lingkungan',
        ];

        return $labels[$this->kategori] ?? $this->kategori;
    }
}

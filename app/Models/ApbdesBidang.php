<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ApbdesBidang extends Model
{
    use HasFactory;

    protected $table = 'apbdes_bidang';

    protected $fillable = [
        'apbdes_id',
        'nama_bidang',
        'kode_bidang',
        'anggaran',
        'realisasi',
        'persentase',
        'detail_kegiatan',
    ];

    protected $casts = [
        'anggaran' => 'decimal:2',
        'realisasi' => 'decimal:2',
        'persentase' => 'decimal:2',
        'detail_kegiatan' => 'array',
    ];

    /**
     * Get APBDes for this bidang.
     */
    public function apbdes(): BelongsTo
    {
        return $this->belongsTo(Apbdes::class, 'apbdes_id');
    }

    /**
     * Calculate persentase before saving.
     */
    public function calculatePersentase(): void
    {
        if ($this->anggaran > 0) {
            $this->persentase = ($this->realisasi / $this->anggaran) * 100;
        } else {
            $this->persentase = 0;
        }
    }
}

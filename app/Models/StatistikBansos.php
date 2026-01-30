<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StatistikBansos extends Model
{
    use HasFactory;

    protected $table = 'statistik_bansos';

    protected $fillable = [
        'jenis_bansos_id',
        'tahun',
        'jumlah_penerima',
        'total_anggaran',
        'keterangan',
    ];

    protected $casts = [
        'total_anggaran' => 'decimal:2',
    ];

    /**
     * Get jenis bansos.
     */
    public function jenisBansos(): BelongsTo
    {
        return $this->belongsTo(JenisBansos::class, 'jenis_bansos_id');
    }

    /**
     * Scope by tahun.
     */
    public function scopeTahun($query, $tahun)
    {
        return $query->where('tahun', $tahun);
    }
}

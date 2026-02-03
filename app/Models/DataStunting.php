<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataStunting extends Model
{
    use HasFactory;

    protected $table = 'data_stunting';

    protected $fillable = [
        'tahun',
        'bulan',
        'jumlah_balita',
        'jumlah_stunting',
        'jumlah_gizi_buruk',
        'jumlah_gizi_kurang',
        'persentase',
        'detail',
        'catatan',
        'keterangan',
    ];

    protected $casts = [
        'persentase' => 'decimal:2',
        'detail' => 'array',
    ];

    /**
     * Scope by tahun.
     */
    public function scopeTahun($query, $tahun)
    {
        return $query->where('tahun', $tahun);
    }

    /**
     * Get latest data.
     */
    public static function getLatest()
    {
        return self::orderBy('tahun', 'desc')->first();
    }

    /**
     * Calculate persentase.
     */
    public function calculatePersentase(): void
    {
        if ($this->jumlah_balita > 0) {
            $this->persentase = ($this->jumlah_stunting / $this->jumlah_balita) * 100;
        } else {
            $this->persentase = 0;
        }
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DataIdm extends Model
{
    use HasFactory;

    protected $table = 'data_idm';

    protected $fillable = [
        'tahun',
        'skor_idm',
        'status',
        'target_status',
        'skor_iks',
        'skor_ike',
        'skor_ikl',
        'skor_minimal',
        'penambahan',
        'detail_indikator',
        'keterangan',
    ];

    protected $casts = [
        'skor_idm' => 'decimal:4',
        'skor_iks' => 'decimal:4',
        'skor_ike' => 'decimal:4',
        'skor_ikl' => 'decimal:4',
        'skor_minimal' => 'decimal:4',
        'penambahan' => 'decimal:4',
        'detail_indikator' => 'array',
    ];

    /**
     * Get indikator for this IDM.
     */
    public function indikator(): HasMany
    {
        return $this->hasMany(IndikatorIdm::class, 'data_idm_id');
    }

    /**
     * Scope by tahun.
     */
    public function scopeTahun($query, $tahun)
    {
        return $query->where('tahun', $tahun);
    }

    /**
     * Get latest IDM data.
     */
    public static function getLatest()
    {
        return self::orderBy('tahun', 'desc')->first();
    }

    /**
     * Get status label.
     */
    public function getStatusLabelAttribute(): string
    {
        $labels = [
            'sangat_tertinggal' => 'Sangat Tertinggal',
            'tertinggal' => 'Tertinggal',
            'berkembang' => 'Berkembang',
            'maju' => 'Maju',
            'mandiri' => 'Mandiri',
        ];

        return $labels[$this->status] ?? $this->status;
    }

    /**
     * Get status color.
     */
    public function getStatusColorAttribute(): string
    {
        $colors = [
            'sangat_tertinggal' => 'red',
            'tertinggal' => 'orange',
            'berkembang' => 'yellow',
            'maju' => 'blue',
            'mandiri' => 'green',
        ];

        return $colors[$this->status] ?? 'gray';
    }

    /**
     * Get historical data for chart.
     */
    public static function getHistoricalData($limit = 5)
    {
        return self::orderBy('tahun', 'desc')
            ->limit($limit)
            ->get()
            ->reverse()
            ->values();
    }
}

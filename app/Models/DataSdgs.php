<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSdgs extends Model
{
    use HasFactory;

    protected $table = 'data_sdgs';

    protected $fillable = [
        'tahun',
        'skor_total',
        'sdg_1',
        'sdg_2',
        'sdg_3',
        'sdg_4',
        'sdg_5',
        'sdg_6',
        'sdg_7',
        'sdg_8',
        'sdg_9',
        'sdg_10',
        'sdg_11',
        'sdg_12',
        'sdg_13',
        'sdg_14',
        'sdg_15',
        'sdg_16',
        'sdg_17',
        'sdg_18',
        'keterangan',
    ];

    protected $casts = [
        'skor_total' => 'decimal:2',
        'sdg_1' => 'decimal:2',
        'sdg_2' => 'decimal:2',
        'sdg_3' => 'decimal:2',
        'sdg_4' => 'decimal:2',
        'sdg_5' => 'decimal:2',
        'sdg_6' => 'decimal:2',
        'sdg_7' => 'decimal:2',
        'sdg_8' => 'decimal:2',
        'sdg_9' => 'decimal:2',
        'sdg_10' => 'decimal:2',
        'sdg_11' => 'decimal:2',
        'sdg_12' => 'decimal:2',
        'sdg_13' => 'decimal:2',
        'sdg_14' => 'decimal:2',
        'sdg_15' => 'decimal:2',
        'sdg_16' => 'decimal:2',
        'sdg_17' => 'decimal:2',
        'sdg_18' => 'decimal:2',
    ];

    /**
     * SDGs labels.
     */
    public static function getSdgsLabels(): array
    {
        return [
            'sdg_1' => 'Desa Tanpa Kemiskinan',
            'sdg_2' => 'Desa Tanpa Kelaparan',
            'sdg_3' => 'Desa Sehat dan Sejahtera',
            'sdg_4' => 'Pendidikan Desa Berkualitas',
            'sdg_5' => 'Keterlibatan Perempuan Desa',
            'sdg_6' => 'Desa Layak Air Bersih dan Sanitasi',
            'sdg_7' => 'Desa Berenergi Bersih dan Terbarukan',
            'sdg_8' => 'Pertumbuhan Ekonomi Desa Merata',
            'sdg_9' => 'Infrastruktur dan Inovasi Desa Sesuai Kebutuhan',
            'sdg_10' => 'Desa Tanpa Kesenjangan',
            'sdg_11' => 'Kawasan Pemukiman Desa Aman dan Nyaman',
            'sdg_12' => 'Konsumsi dan Produksi Desa Sadar Lingkungan',
            'sdg_13' => 'Desa Tanggap Perubahan Iklim',
            'sdg_14' => 'Desa Peduli Lingkungan Laut',
            'sdg_15' => 'Desa Peduli Lingkungan Darat',
            'sdg_16' => 'Desa Damai Berkeadilan',
            'sdg_17' => 'Kemitraan Untuk Pembangunan Desa',
            'sdg_18' => 'Kelembagaan Desa Dinamis dan Budaya Desa Adaptif',
        ];
    }

    /**
     * Scope by tahun.
     */
    public function scopeTahun($query, $tahun)
    {
        return $query->where('tahun', $tahun);
    }

    /**
     * Get latest SDGs data.
     */
    public static function getLatest()
    {
        return self::orderBy('tahun', 'desc')->first();
    }

    /**
     * Get all SDGs scores as array.
     */
    public function getAllScoresAttribute(): array
    {
        $labels = self::getSdgsLabels();
        $scores = [];

        foreach ($labels as $key => $label) {
            $scores[] = [
                'key' => $key,
                'number' => (int) str_replace('sdg_', '', $key),
                'label' => $label,
                'score' => $this->{$key},
            ];
        }

        return $scores;
    }
}

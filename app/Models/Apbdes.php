<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Apbdes extends Model
{
    use HasFactory;

    protected $table = 'apbdes';

    protected $fillable = [
        'tahun',
        'pendapatan_asli_desa',
        'pendapatan_transfer',
        'pendapatan_lain',
        'total_pendapatan',
        'belanja_pegawai',
        'belanja_barang_jasa',
        'belanja_modal',
        'belanja_tidak_terduga',
        'total_belanja',
        'penerimaan_pembiayaan',
        'pengeluaran_pembiayaan',
        'surplus_defisit',
        'detail_pendapatan',
        'detail_belanja',
        'detail_pembiayaan',
        'keterangan',
    ];

    protected $casts = [
        'pendapatan_asli_desa' => 'decimal:2',
        'pendapatan_transfer' => 'decimal:2',
        'pendapatan_lain' => 'decimal:2',
        'total_pendapatan' => 'decimal:2',
        'belanja_pegawai' => 'decimal:2',
        'belanja_barang_jasa' => 'decimal:2',
        'belanja_modal' => 'decimal:2',
        'belanja_tidak_terduga' => 'decimal:2',
        'total_belanja' => 'decimal:2',
        'penerimaan_pembiayaan' => 'decimal:2',
        'pengeluaran_pembiayaan' => 'decimal:2',
        'surplus_defisit' => 'decimal:2',
        'detail_pendapatan' => 'array',
        'detail_belanja' => 'array',
        'detail_pembiayaan' => 'array',
    ];

    /**
     * Get bidang for this APBDes.
     */
    public function bidang(): HasMany
    {
        return $this->hasMany(ApbdesBidang::class, 'apbdes_id');
    }

    /**
     * Scope by tahun.
     */
    public function scopeTahun($query, $tahun)
    {
        return $query->where('tahun', $tahun);
    }

    /**
     * Get latest APBDes.
     */
    public static function getLatest()
    {
        return self::orderBy('tahun', 'desc')->first();
    }

    /**
     * Format currency.
     */
    public static function formatCurrency($amount): string
    {
        return 'Rp' . number_format($amount, 2, ',', '.');
    }

    /**
     * Get formatted total pendapatan.
     */
    public function getTotalPendapatanFormatAttribute(): string
    {
        return self::formatCurrency($this->total_pendapatan);
    }

    /**
     * Get formatted total belanja.
     */
    public function getTotalBelanjaFormatAttribute(): string
    {
        return self::formatCurrency($this->total_belanja);
    }

    /**
     * Get formatted surplus/defisit.
     */
    public function getSurplusDefisitFormatAttribute(): string
    {
        return self::formatCurrency($this->surplus_defisit);
    }

    /**
     * Calculate totals before saving.
     */
    public function calculateTotals(): void
    {
        $this->total_pendapatan = $this->pendapatan_asli_desa +
            $this->pendapatan_transfer +
            $this->pendapatan_lain;

        $this->total_belanja = $this->belanja_pegawai +
            $this->belanja_barang_jasa +
            $this->belanja_modal +
            $this->belanja_tidak_terduga;

        $this->surplus_defisit = $this->total_pendapatan - $this->total_belanja;
    }
}

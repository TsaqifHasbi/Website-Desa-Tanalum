<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KepalaDesa extends Model
{
    use HasFactory;

    protected $table = 'kepala_desa';

    protected $fillable = [
        'nama',
        'foto',
        'tahun_mulai',
        'tahun_selesai',
        'keterangan',
        'urutan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'tahun_mulai' => 'integer',
        'tahun_selesai' => 'integer',
    ];

    /**
     * Scope for active records.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for ordered records.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan', 'asc')->orderBy('tahun_mulai', 'desc');
    }

    /**
     * Get formatted periode.
     */
    public function getPeriodeAttribute(): string
    {
        if (!$this->tahun_mulai) {
            return '-';
        }

        if (!$this->tahun_selesai) {
            return $this->tahun_mulai . ' - Sekarang';
        }

        return $this->tahun_mulai . ' - ' . $this->tahun_selesai;
    }
}

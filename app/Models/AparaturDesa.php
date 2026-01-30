<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AparaturDesa extends Model
{
    use HasFactory;

    protected $table = 'aparatur_desa';

    protected $fillable = [
        'nama',
        'nip',
        'jabatan',
        'jenis',
        'foto',
        'telepon',
        'email',
        'alamat',
        'tanggal_mulai_jabatan',
        'tanggal_akhir_jabatan',
        'tugas_pokok',
        'urutan',
        'is_active',
    ];

    protected $casts = [
        'tanggal_mulai_jabatan' => 'date',
        'tanggal_akhir_jabatan' => 'date',
        'is_active' => 'boolean',
    ];

    /**
     * Scope for active aparatur.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for pemerintah desa.
     */
    public function scopePemerintahDesa($query)
    {
        return $query->where('jenis', 'pemerintah_desa');
    }

    /**
     * Scope for BPD.
     */
    public function scopeBpd($query)
    {
        return $query->where('jenis', 'bpd');
    }

    /**
     * Scope ordered by urutan.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan')->orderBy('nama');
    }

    /**
     * Get foto URL.
     */
    public function getFotoUrlAttribute(): string
    {
        if ($this->foto) {
            return asset('storage/' . $this->foto);
        }

        return asset('images/default-avatar.png');
    }
}

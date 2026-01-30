<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dusun extends Model
{
    use HasFactory;

    protected $table = 'dusun';

    protected $fillable = [
        'nama',
        'kepala_dusun',
        'jumlah_rt',
        'jumlah_rw',
        'keterangan',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Scope for active dusun.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}

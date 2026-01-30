<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class JenisBansos extends Model
{
    use HasFactory;

    protected $table = 'jenis_bansos';

    protected $fillable = [
        'nama',
        'slug',
        'singkatan',
        'deskripsi',
        'sumber_dana',
        'icon',
        'warna',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->nama);
            }
        });
    }

    /**
     * Get statistik for this jenis bansos.
     */
    public function statistik(): HasMany
    {
        return $this->hasMany(StatistikBansos::class, 'jenis_bansos_id');
    }

    /**
     * Get penerima for this jenis bansos.
     */
    public function penerima(): HasMany
    {
        return $this->hasMany(PenerimaBansos::class, 'jenis_bansos_id');
    }

    /**
     * Scope for active jenis.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}

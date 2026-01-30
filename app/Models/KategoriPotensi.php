<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class KategoriPotensi extends Model
{
    use HasFactory;

    protected $table = 'kategori_potensi';

    protected $fillable = [
        'nama',
        'slug',
        'icon',
        'deskripsi',
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
     * Get potensi for this kategori.
     */
    public function potensi(): HasMany
    {
        return $this->hasMany(PotensiDesa::class, 'kategori_id');
    }

    /**
     * Scope for active kategori.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}

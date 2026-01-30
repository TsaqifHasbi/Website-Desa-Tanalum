<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class KategoriGaleri extends Model
{
    use HasFactory;

    protected $table = 'kategori_galeri';

    protected $fillable = [
        'nama',
        'slug',
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
     * Get galeri for this kategori.
     */
    public function galeri(): HasMany
    {
        return $this->hasMany(Galeri::class, 'kategori_id');
    }

    /**
     * Scope for active kategori.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class KategoriProduk extends Model
{
    use HasFactory;

    protected $table = 'kategori_produk';

    protected $fillable = [
        'nama',
        'slug',
        'deskripsi',
        'icon',
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
     * Get produk for this kategori.
     */
    public function produk(): HasMany
    {
        return $this->hasMany(ProdukUmkm::class, 'kategori_id');
    }

    /**
     * Scope for active kategori.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}

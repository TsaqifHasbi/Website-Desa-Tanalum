<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class PotensiDesa extends Model
{
    use HasFactory;

    protected $table = 'potensi_desa';

    protected $fillable = [
        'kategori_id',
        'nama',
        'slug',
        'deskripsi',
        'konten',
        'gambar_utama',
        'galeri',
        'lokasi',
        'latitude',
        'longitude',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'galeri' => 'array',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->nama) . '-' . Str::random(5);
            }
        });
    }

    /**
     * Get kategori of the potensi.
     */
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriPotensi::class, 'kategori_id');
    }

    /**
     * Scope for active potensi.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for featured potensi.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Get gambar utama URL.
     */
    public function getGambarUrlAttribute(): string
    {
        if ($this->gambar_utama) {
            return asset('storage/' . $this->gambar_utama);
        }

        return asset('images/default-potensi.jpg');
    }
}

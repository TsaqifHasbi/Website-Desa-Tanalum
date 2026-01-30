<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class ProdukUmkm extends Model
{
    use HasFactory;

    protected $table = 'produk_umkm';

    protected $fillable = [
        'kategori_id',
        'nama',
        'slug',
        'deskripsi',
        'harga',
        'harga_diskon',
        'satuan',
        'stok',
        'gambar_utama',
        'galeri',
        'pemilik',
        'kontak_pemilik',
        'alamat_pemilik',
        'rating',
        'jumlah_rating',
        'views',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'galeri' => 'array',
        'harga' => 'decimal:2',
        'harga_diskon' => 'decimal:2',
        'rating' => 'decimal:2',
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
     * Get kategori of the produk.
     */
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriProduk::class, 'kategori_id');
    }

    /**
     * Scope for active produk.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for featured produk.
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

        return asset('images/default-product.jpg');
    }

    /**
     * Get formatted harga.
     */
    public function getHargaFormatAttribute(): string
    {
        return 'Rp' . number_format($this->harga, 0, ',', '.');
    }

    /**
     * Get formatted harga diskon.
     */
    public function getHargaDiskonFormatAttribute(): ?string
    {
        if ($this->harga_diskon) {
            return 'Rp' . number_format($this->harga_diskon, 0, ',', '.');
        }

        return null;
    }

    /**
     * Check if produk has discount.
     */
    public function hasDiscount(): bool
    {
        return $this->harga_diskon && $this->harga_diskon < $this->harga;
    }

    /**
     * Get discount percentage.
     */
    public function getDiscountPercentageAttribute(): ?int
    {
        if (!$this->hasDiscount()) {
            return null;
        }

        return (int) round((($this->harga - $this->harga_diskon) / $this->harga) * 100);
    }

    /**
     * Increment views.
     */
    public function incrementViews(): void
    {
        $this->increment('views');
    }
}

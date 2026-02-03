<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class WisataDesa extends Model
{
    use HasFactory;

    protected $table = 'wisata_desa';

    protected $fillable = [
        'nama',
        'slug',
        'kategori',
        'deskripsi',
        'konten',
        'gambar_utama',
        'galeri',
        'lokasi',
        'latitude',
        'longitude',
        'jam_buka',
        'jam_tutup',
        'hari_operasional',
        'harga_tiket',
        'fasilitas',
        'kontak',
        'views',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'galeri' => 'array',
        'fasilitas' => 'array',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
        'harga_tiket' => 'decimal:2',
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
     * Scope for active wisata.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for featured wisata.
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

        return asset('images/default-wisata.jpg');
    }

    /**
     * Get formatted harga tiket.
     */
    public function getHargaTiketFormatAttribute(): string
    {
        if (!$this->harga_tiket || $this->harga_tiket == 0) {
            return 'Gratis';
        }

        return 'Rp' . number_format($this->harga_tiket, 0, ',', '.');
    }

    /**
     * Get jam operasional.
     */
    public function getJamOperasionalAttribute(): string
    {
        if ($this->jam_buka && $this->jam_tutup) {
            // Check if they are valid time strings for formatting
            $buka = strtotime($this->jam_buka);
            $tutup = strtotime($this->jam_tutup);
            
            if ($buka && $tutup) {
                return date('H:i', $buka) . ' - ' . date('H:i', $tutup);
            }
            
            return $this->jam_buka . ' - ' . $this->jam_tutup;
        }

        return $this->jam_buka ?: ($this->jam_tutup ?: '-');
    }

    /**
     * Increment views.
     */
    public function incrementViews(): void
    {
        $this->increment('views');
    }
}

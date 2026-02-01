<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Galeri extends Model
{
    use HasFactory;

    protected $table = 'galeri';

    protected $fillable = [
        'kategori_id',
        'judul',
        'slug',
        'deskripsi',
        'tipe',
        'file_path',
        'thumbnail',
        'video_url',
        'tanggal',
        'lokasi',
        'urutan',
        'is_featured',
        'is_active',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
    ];

    /**
     * Get kategori of the galeri.
     */
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriGaleri::class, 'kategori_id');
    }

    /**
     * Scope for active galeri.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for featured galeri.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope for foto.
     */
    public function scopeFoto($query)
    {
        return $query->where('tipe', 'foto');
    }

    /**
     * Scope for video.
     */
    public function scopeVideo($query)
    {
        return $query->where('tipe', 'video');
    }

    /**
     * Scope ordered.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('urutan')->orderBy('created_at', 'desc');
    }

    /**
     * Get file URL.
     */
    public function getFileUrlAttribute(): string
    {
        return asset('storage/' . $this->file_path);
    }

    /**
     * Get thumbnail URL.
     */
    public function getThumbnailUrlAttribute(): string
    {
        if ($this->thumbnail) {
            return asset('storage/' . $this->thumbnail);
        }

        if ($this->tipe === 'foto') {
            return $this->file_url;
        }

        return asset('images/default-video-thumb.jpg');
    }
}

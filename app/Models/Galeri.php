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
     * Check if the video is from YouTube.
     */
    public function getIsYoutubeAttribute(): bool
    {
        if ($this->tipe !== 'video' || !$this->video_url) {
            return false;
        }

        $url = strtolower($this->video_url);
        // Check for common domains or if it looks like a raw 11-char ID
        return str_contains($url, 'youtube.com') || 
               str_contains($url, 'youtu.be') || 
               (strlen($this->video_url) === 11 && preg_match('/^[a-zA-Z0-9_-]{11}$/', $this->video_url));
    }

    /**
     * Get YouTube Video ID.
     */
    public function getYoutubeVideoIdAttribute(): ?string
    {
        if (!$this->is_youtube) {
            return null;
        }

        $url = $this->video_url;
        
        // 1. Check if it's already a raw ID
        if (strlen($url) === 11 && preg_match('/^[a-zA-Z0-9_-]{11}$/', $url)) {
            return $url;
        }

        // 2. Comprehensive YouTube Regex (covers shorts, live, embed, v, etc)
        $pattern = '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?|shorts|live)/|.*[?&]v=)|youtu\.be/)([^"&?/\s]{11})%i';
        
        if (preg_match($pattern, $url, $match)) {
            return $match[1];
        }

        return null;
    }

    /**
     * Get YouTube Embed URL.
     */
    public function getYoutubeEmbedUrlAttribute(): ?string
    {
        if (!$this->is_youtube || !$this->youtube_video_id) {
            return null;
        }

        return "https://www.youtube.com/embed/{$this->youtube_video_id}?autoplay=1&rel=0";
    }

    /**
     * Get file URL.
     */
    public function getFileUrlAttribute(): string
    {
        if ($this->file_path) {
            return asset('storage/' . $this->file_path);
        }
        return '';
    }

    /**
     * Get thumbnail URL.
     */
    public function getThumbnailUrlAttribute(): string
    {
        if ($this->thumbnail) {
            return asset('storage/' . $this->thumbnail);
        }

        if ($this->tipe === 'foto' && $this->file_path) {
            return $this->file_url;
        }

        if ($this->is_youtube && $this->youtube_video_id) {
            return "https://img.youtube.com/vi/{$this->youtube_video_id}/hqdefault.jpg";
        }

        // Return a generic video placeholder if no thumbnail found
        return asset('img/video-placeholder.jpg');
    }
}

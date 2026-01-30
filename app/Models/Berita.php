<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Berita extends Model
{
    use HasFactory;

    protected $table = 'berita';

    protected $fillable = [
        'kategori_id',
        'user_id',
        'judul',
        'slug',
        'ringkasan',
        'konten',
        'gambar_utama',
        'galeri',
        'views',
        'status',
        'published_at',
        'is_featured',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'galeri' => 'array',
        'published_at' => 'datetime',
        'is_featured' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->slug)) {
                $model->slug = Str::slug($model->judul) . '-' . Str::random(5);
            }
        });
    }

    /**
     * Get kategori of the berita.
     */
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriBerita::class, 'kategori_id');
    }

    /**
     * Get author of the berita.
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * Scope for published berita.
     */
    public function scopePublished($query)
    {
        return $query->where('status', 'published')
            ->where('published_at', '<=', now());
    }

    /**
     * Scope for featured berita.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Scope for latest berita.
     */
    public function scopeLatest($query)
    {
        return $query->orderBy('published_at', 'desc');
    }

    /**
     * Increment views.
     */
    public function incrementViews(): void
    {
        $this->increment('views');
    }

    /**
     * Get gambar utama URL.
     */
    public function getGambarUrlAttribute(): string
    {
        if ($this->gambar_utama) {
            return asset('storage/' . $this->gambar_utama);
        }

        return asset('images/default-berita.jpg');
    }

    /**
     * Get formatted date.
     */
    public function getTanggalFormatAttribute(): string
    {
        return $this->published_at
            ? $this->published_at->translatedFormat('d F Y')
            : $this->created_at->translatedFormat('d F Y');
    }

    /**
     * Get short content.
     */
    public function getRingkasanShortAttribute(): string
    {
        if ($this->ringkasan) {
            return Str::limit($this->ringkasan, 150);
        }

        return Str::limit(strip_tags($this->konten), 150);
    }
}

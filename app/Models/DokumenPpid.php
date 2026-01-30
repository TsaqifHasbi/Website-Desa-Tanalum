<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class DokumenPpid extends Model
{
    use HasFactory;

    protected $table = 'dokumen_ppid';

    protected $fillable = [
        'kategori_id',
        'judul',
        'slug',
        'deskripsi',
        'nomor_dokumen',
        'tanggal_dokumen',
        'file_path',
        'file_type',
        'file_size',
        'download_count',
        'view_count',
        'tahun',
        'is_active',
    ];

    protected $casts = [
        'tanggal_dokumen' => 'date',
        'is_active' => 'boolean',
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
     * Get kategori of the dokumen.
     */
    public function kategori(): BelongsTo
    {
        return $this->belongsTo(KategoriPpid::class, 'kategori_id');
    }

    /**
     * Scope for active dokumen.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Increment download count.
     */
    public function incrementDownloads(): void
    {
        $this->increment('download_count');
    }

    /**
     * Increment view count.
     */
    public function incrementViews(): void
    {
        $this->increment('view_count');
    }

    /**
     * Get file URL.
     */
    public function getFileUrlAttribute(): string
    {
        return asset('storage/' . $this->file_path);
    }

    /**
     * Get formatted file size.
     */
    public function getFileSizeFormatAttribute(): string
    {
        if (!$this->file_size) {
            return '-';
        }

        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];

        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Get formatted date.
     */
    public function getTanggalFormatAttribute(): string
    {
        return $this->tanggal_dokumen
            ? $this->tanggal_dokumen->translatedFormat('d F Y')
            : '-';
    }
}

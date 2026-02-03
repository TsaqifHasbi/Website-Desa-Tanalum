<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PermohonanInformasi extends Model
{
    use HasFactory;

    protected $table = 'permohonan_informasi';

    protected $fillable = [
        'nomor_tiket',
        'nama_pemohon',
        'nik',
        'email',
        'telepon',
        'alamat',
        'pekerjaan',
        'informasi_diminta',
        'alasan_permohonan',
        'cara_memperoleh',
        'cara_mendapat_salinan',
        'status',
        'catatan_admin',
        'tanggapan',
        'dokumen_pendukung',
        'file_balasan',
        'tanggal_selesai',
    ];

    protected $casts = [
        'tanggal_selesai' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->nomor_tiket)) {
                $model->nomor_tiket = 'PPID-' . date('Ymd') . '-' . strtoupper(Str::random(6));
            }
        });
    }

    /**
     * Scope by status.
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope pending.
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    /**
     * Get cara memperoleh label.
     */
    public function getCaraMemperolehLabelAttribute(): string
    {
        $labels = [
            'melihat' => 'Melihat',
            'membaca' => 'Membaca',
            'mendengar' => 'Mendengar',
            'mencatat' => 'Mencatat',
            'mendapat_salinan' => 'Mendapat Salinan',
        ];

        return $labels[$this->cara_memperoleh] ?? $this->cara_memperoleh;
    }

    /**
     * Get cara mendapat salinan label.
     */
    public function getCaraMendapatSalinanLabelAttribute(): string
    {
        $labels = [
            'email' => 'Email',
            'fax' => 'Fax',
            'pos' => 'Pos',
            'ambil_langsung' => 'Ambil Langsung',
        ];

        return $labels[$this->cara_mendapat_salinan] ?? $this->cara_mendapat_salinan;
    }

    /**
     * Get status label.
     */
    public function getStatusLabelAttribute(): string
    {
        $labels = [
            'pending' => 'Menunggu',
            'diproses' => 'Sedang Diproses',
            'selesai' => 'Selesai',
            'ditolak' => 'Ditolak',
        ];

        return $labels[$this->status] ?? $this->status;
    }

    /**
     * Get status color.
     */
    public function getStatusColorAttribute(): string
    {
        $colors = [
            'pending' => 'yellow',
            'diproses' => 'blue',
            'selesai' => 'green',
            'ditolak' => 'red',
        ];

        return $colors[$this->status] ?? 'gray';
    }
}

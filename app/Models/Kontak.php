<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kontak extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'kontaks';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'email',
        'telepon',
        'subjek',
        'pesan',
        'status',
        'balasan',
        'dibalas_oleh',
        'dibalas_pada',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'dibalas_pada' => 'datetime',
    ];

    /**
     * Scope for unread messages.
     */
    public function scopeBelumDibaca($query)
    {
        return $query->where('status', 'baru');
    }

    /**
     * Scope for read messages.
     */
    public function scopeSudahDibaca($query)
    {
        return $query->where('status', '!=', 'baru');
    }

    /**
     * Get the user who replied.
     */
    public function pembalas()
    {
        return $this->belongsTo(User::class, 'dibalas_oleh');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Penjemputan extends Model
{
    use HasFactory;

    protected $table = 'penjemputan';

    protected $primaryKey = 'id_penjemputan';

    protected $fillable = [
        'id_user',
        'id_siswa',
        'id_ortu_wali',
        'waktu',
        'keterangan',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'waktu' => 'datetime',
        ];
    }

    /**
     * Relasi ke User / Petugas Penjemputan (One-to-Many dari sisi User)
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user', 'id_user');
    }

    /**
     * Relasi agregat ke Siswa
     */
    public function siswa(): BelongsTo
    {
        return $this->belongsTo(Siswa::class, 'id_siswa', 'id_siswa');
    }

    /**
     * Relasi agregat ke Orang Tua / Wali
     */
    public function orangTua(): BelongsTo
    {
        return $this->belongsTo(OrangTuaWali::class, 'id_ortu_wali', 'id_ortu_wali');
    }
}


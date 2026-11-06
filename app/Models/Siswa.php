<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';

    protected $primaryKey = 'id_siswa';

    protected $fillable = [
        'id_ortu_wali',
        'nis',
        'nama',
        'tahun_ajaran',
        'status',
        'jenis_kelamin',
        'qr_code_siswa',
    ];

    /**
     * Relasi Many-to-One ke Orang Tua / Wali
     */
    public function orangTua(): BelongsTo
    {
        return $this->belongsTo(OrangTuaWali::class, 'id_ortu_wali', 'id_ortu_wali');
    }

    /**
     * Relasi ke riwayat Penjemputan
     */
    public function penjemputan(): HasMany
    {
        return $this->hasMany(Penjemputan::class, 'id_siswa', 'id_siswa');
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OrangTuaWali extends Model
{
    use HasFactory;

    protected $table = 'orang_tua_wali';

    protected $primaryKey = 'id_ortu_wali';

    protected $fillable = [
        'nama',
        'no_telp',
        'qr_code_penjemput',
    ];

    /**
     * Relasi One-to-Many ke Siswa (1 orang tua memiliki banyak anak/siswa)
     */
    public function siswa(): HasMany
    {
        return $this->hasMany(Siswa::class, 'id_ortu_wali', 'id_ortu_wali');
    }

    /**
     * Relasi ke riwayat Penjemputan
     */
    public function penjemputan(): HasMany
    {
        return $this->hasMany(Penjemputan::class, 'id_ortu_wali', 'id_ortu_wali');
    }
}


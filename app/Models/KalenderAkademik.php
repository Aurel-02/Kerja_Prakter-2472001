<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KalenderAkademik extends Model
{
    use HasFactory;

    protected $table = 'kalender_akademik';

    protected $primaryKey = 'id_kalender';

    protected $fillable = [
        'id_profil',
        'judul_kegiatan',
        'tahun_ajaran',
        'kategori',
        'icon',
        'tanggal_mulai',
        'tanggal_selesai',
        'keterangan',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_mulai' => 'date',
            'tanggal_selesai' => 'date',
        ];
    }

    public function sekolah(): BelongsTo
    {
        return $this->belongsTo(Sekolah::class, 'id_profil', 'id_profil');
    }
}

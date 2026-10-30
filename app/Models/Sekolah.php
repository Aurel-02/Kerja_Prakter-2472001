<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Sekolah extends Model
{
    use HasFactory;

    protected $table = 'sekolah';

    protected $primaryKey = 'id_profil';

    protected $fillable = [
        'visi',
        'misi',
        'link_maps',
        'kontak',
    ];

    public function galeri(): HasMany
    {
        return $this->hasMany(Galeri::class, 'id_profil', 'id_profil');
    }

    public function strukturSekolah(): HasMany
    {
        return $this->hasMany(StrukturSekolah::class, 'id_profil', 'id_profil');
    }

    public function kalenderAkademik(): HasMany
    {
        return $this->hasMany(KalenderAkademik::class, 'id_profil', 'id_profil');
    }

    public function kurikulum(): HasMany
    {
        return $this->hasMany(Kurikulum::class, 'id_profil', 'id_profil');
    }
}

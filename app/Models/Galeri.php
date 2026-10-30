<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Galeri extends Model
{
    use HasFactory;

    protected $table = 'galeri';

    protected $primaryKey = 'id_galeri';

    protected $fillable = [
        'id_profil',
        'judul',
        'kategori',
        'link_foto',
        'deskripsi',
    ];

    public function sekolah(): BelongsTo
    {
        return $this->belongsTo(Sekolah::class, 'id_profil', 'id_profil');
    }

    public function strukturSekolah(): HasMany
    {
        return $this->hasMany(StrukturSekolah::class, 'id_galeri', 'id_galeri');
    }
}

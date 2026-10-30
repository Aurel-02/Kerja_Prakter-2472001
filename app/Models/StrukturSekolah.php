<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StrukturSekolah extends Model
{
    use HasFactory;

    protected $table = 'struktur_sekolah';

    protected $primaryKey = 'nip';

    public $incrementing = false;

    protected $keyType = 'string';

    protected $fillable = [
        'nip',
        'id_profil',
        'id_galeri',
        'nama',
        'jabatan',
    ];

    public function sekolah(): BelongsTo
    {
        return $this->belongsTo(Sekolah::class, 'id_profil', 'id_profil');
    }

    public function galeri(): BelongsTo
    {
        return $this->belongsTo(Galeri::class, 'id_galeri', 'id_galeri');
    }
}

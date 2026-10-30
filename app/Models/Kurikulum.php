<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Kurikulum extends Model
{
    use HasFactory;

    protected $table = 'kurikulum';

    protected $primaryKey = 'id_kurikulum';

    protected $fillable = [
        'id_profil',
        'kategori',
        'judul',
        'deskripsi',
    ];

    public function sekolah(): BelongsTo
    {
        return $this->belongsTo(Sekolah::class, 'id_profil', 'id_profil');
    }
}

<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Nama tabel di database sesuai ERD
     */
    protected $table = 'user';

    /**
     * Primary key tabel
     */
    protected $primaryKey = 'id_user';

    /**
     * Atribut yang dapat diisi secara massal
     */
    protected $fillable = [
        'username',
        'password',
        'nama',
        'role',
        'status',
    ];

    /**
     * Atribut yang disembunyikan dalam serialisasi
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Tipe data casting
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    /**
     * Relasi One-to-Many ke Penjemputan
     */
    public function penjemputan(): HasMany
    {
        return $this->hasMany(Penjemputan::class, 'id_user', 'id_user');
    }
}

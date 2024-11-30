<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    use HasFactory;

    protected $primaryKey = 'id_user';

    protected $fillable = [
        'nama_pengguna',
        'google_id',
        'email',
        'password',
    ];

    public function profil(): HasOne
    {
        return $this->hasOne(Profil::class, 'id_user');
    }

    public function obat(): HasMany
    {
        return $this->hasMany(Obat::class, 'id_user');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Penyakit extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_penyakit';

    protected $fillable = [
        'nama_penyakit',
        'gejala',
        'status',
        'pengobatan',
        'catatan',
    ];

    public function profils(): HasMany
    {
        return $this->hasMany(Profil::class, 'id_penyakit');
    }
}

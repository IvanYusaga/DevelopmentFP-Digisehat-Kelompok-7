<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RiwayatPenyakit extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_riwayat_penyakit';

    protected $fillable = [
        'nama_riwayat_penyakit',
        'gejala',
        'pengobatan',
        'catatan',
    ];

    public function profils(): HasMany
    {
        return $this->hasMany(Profil::class, 'id_riwayat_penyakit');
    }
}

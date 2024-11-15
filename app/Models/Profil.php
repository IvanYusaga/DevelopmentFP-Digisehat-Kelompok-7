<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profil extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_profil';

    protected $fillable = [
        'id_user',
        'id_penyakit',
        'id_riwayat_penyakit',
        'nama_panjang',
        'umur',
        'jenis_kelamin',
        'tinggi_badan',
        'berat_badan',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function penyakit(): BelongsTo
    {
        return $this->belongsTo(Penyakit::class, 'id_penyakit');
    }

    public function riwayatPenyakit(): BelongsTo
    {
        return $this->belongsTo(RiwayatPenyakit::class, 'id_riwayat_penyakit');
    }
}

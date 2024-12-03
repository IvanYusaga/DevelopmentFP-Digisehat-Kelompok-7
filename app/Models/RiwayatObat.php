<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class RiwayatObat extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_riwayatObat';

    protected $fillable = [
        'id_user',
        'id_jadwal',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function jadwalPengingat(): BelongsTo
    {
        return $this->belongsTo(JadwalPengingat::class, 'id_jadwal');
    }
}

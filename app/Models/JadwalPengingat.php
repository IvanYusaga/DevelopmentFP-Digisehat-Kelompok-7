<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JadwalPengingat extends Model
{
    use HasFactory;
    protected $primaryKey = 'id_jadwal';

    protected $fillable = [
        'id_user',
        'id_obat',
        'caraPenggunaanObat',
        'jumlah_obat',
        'tanggal_konsumsi',
        'frekuensi',
        'waktu_pengingat',
        'waktu_pengingat.*',
        'status',
    ];


    public function obat(): BelongsTo
    {
        return $this->belongsTo(Obat::class, 'id_obat');
    }
}

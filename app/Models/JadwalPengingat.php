<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class JadwalPengingat extends Model
{
    use HasFactory;

    protected $table = 'jadwal_pengingat'; // Pastikan tabel sesuai
    protected $primaryKey = 'id_jadwal';

    protected $fillable = [
        'id_obat',
        'durasi_pengingat',
        'dosis',
        'jumlah_obat',
        'frekuensi',
        'tanggal_konsumsi',
        'status',
    ];

    public function obat(): BelongsTo
    {
        return $this->belongsTo(Obat::class, 'id_obat');
    }
}

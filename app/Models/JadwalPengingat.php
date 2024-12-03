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
        'id_obat' => 'required|exists:obats,id_obat',
        'caraPenggunaanObat' => 'required|string',
        'jumlah_obat' => 'required|integer|min:1',
        'tanggal_konsumsi' => 'required|date',
        'frekuensi' => 'required|integer|min:1',
        'rentanghari' => 'required|integer|min:1',
        'waktu_pengingat' => 'required|array',
        'waktu_pengingat.*' => 'required|date_format:H:i',
        'status',
    ];


    public function obat(): BelongsTo
    {
        return $this->belongsTo(Obat::class, 'id_obat');
    }
}

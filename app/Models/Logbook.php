<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Logbook extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_logbook';

    protected $fillable = [
        'id_jadwal',
    ];

    public function jadwalPengingat(): BelongsTo
    {
        return $this->belongsTo(JadwalPengingat::class, 'id_jadwal');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Obat extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_obat';

    protected $fillable = [
        'id_user',
        'nama_obat',
        'cara_penggunaan',
        'deskripsi',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function jadwalPengingats(): HasMany
    {
        return $this->hasMany(JadwalPengingat::class, 'id_obat');
    }
}

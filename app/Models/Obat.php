<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_obat',
        'date',
        'penggunaan_obat',
        'deskripsi',
    ];
}

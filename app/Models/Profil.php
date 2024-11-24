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
        'profile_image',
        'nama_lengkap',
        'usia',
        'jenis_kelamin',
        'riwayat_penyakit',
    ];

    /**
     * Relationship with User model
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    /**
     * Mutator for storing profile_image
     */
    public function setProfileImageAttribute($value)
    {
        // Pastikan bahwa nilai $value adalah objek file dan valid
        if ($value && $value instanceof \Illuminate\Http\UploadedFile) {
            $fileName = time() . '_' . $value->getClientOriginalName();
            $value->move(public_path('assets'), $fileName);
            $this->attributes['profile_image'] = 'assets/' . $fileName;
        }
    }

    /**
     * Accessor for profile_image
     */
    public function getProfileImageAttribute($value)
    {
        return asset($value);
    }
}

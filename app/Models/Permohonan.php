<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permohonan extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'tanggal_surat',
        'asal_kampus',
        'jurusan',
        'tanggal_mulai',
        'tanggal_selesai',
        'durasi',
        'cv_path',
        'surat_pernyataan_path',
        'status',
        'alasan_cancel',
    ];

    // Relasi balik ke User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

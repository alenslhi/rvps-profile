<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    // Menentukan kolom mana yang boleh diisi
    protected $fillable = [
        'nama_lengkap',
        'peran',
        'foto_profil',
        'biodata_singkat',
        'email',
        'whatsapp',
        'instagram',
        'github',
        'linkedin',
        'file_cv',
        'riwayat_pendidikan',
        'pengalaman_organisasi',
        'keahlian_umum',
    ];

    // Mengubah string JSON dari database menjadi Array di PHP
    protected $casts = [
        'riwayat_pendidikan' => 'array',
        'pengalaman_organisasi' => 'array',
        'keahlian_umum' => 'array',
    ];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'slug',
        'kategori',
        'deskripsi_singkat',
        'galeri_foto',
        'tools_digunakan',
        'link_eksternal',
    ];

    protected $casts = [
        'galeri_foto' => 'array', // Filament butuh ini untuk multiple upload image
        'tools_digunakan' => 'array',
    ];
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'slug',
        'kategori',
        'konten',
        'thumbnail',
        'estimasi_waktu_baca',
        'is_published',
    ];

    protected $casts = [
        'is_published' => 'boolean', // Memastikan nilainya selalu true/false
    ];
}
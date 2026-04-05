<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WebSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'hero_judul',
        'hero_subjudul',
        'logo_terang',
        'logo_gelap',
    ];
}
<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profile;
use App\Models\WebSetting;
use App\Models\Portfolio;
use App\Models\Article;

class HomeController extends Controller
{
    // 1. Halaman Beranda (Tampil 3 data saja)
    public function index()
    {
        $profile = Profile::first();
        $setting = WebSetting::first();
        
        // HANYA AMBIL 3 TERBARU
        $portfolios = Portfolio::latest()->take(3)->get();
        $articles = Article::where('is_published', true)->latest()->take(3)->get();

        return view('welcome', compact('profile', 'setting', 'portfolios', 'articles'));
    }

    // 2. Halaman Khusus Semua Galeri
    public function galeri()
    {
        // Ambil semua data galeri (bisa ditambah paginate() nanti jika sudah ratusan foto)
        $portfolios = Portfolio::latest()->get();
        return view('galeri', compact('portfolios'));
    }

    // 3. Halaman Khusus Semua Blog
    public function blog()
    {
        $articles = Article::where('is_published', true)->latest()->get();
        return view('blog', compact('articles'));
    }

    // 4. Halaman Baca 1 Artikel
    public function showArticle($slug)
    {
        $article = Article::where('slug', $slug)->where('is_published', true)->firstOrFail();
        return view('article', compact('article'));
    }
}
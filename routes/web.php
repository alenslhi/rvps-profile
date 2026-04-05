<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', [HomeController::class, 'index']);
Route::get('/galeri', [HomeController::class, 'galeri']);
Route::get('/blog', [HomeController::class, 'blog']);
Route::get('/blog/{slug}', [HomeController::class, 'showArticle']);
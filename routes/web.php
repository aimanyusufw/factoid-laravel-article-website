<?php

use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;

Route::get('/', [FrontendController::class, 'home']);
Route::get('/discover', [FrontendController::class, 'discover']);
Route::get('/recent-posts', [FrontendController::class, 'recentPosts']);
Route::get('/featured', [FrontendController::class, 'featured']);
Route::get('/post/{post}', [FrontendController::class, 'post']);

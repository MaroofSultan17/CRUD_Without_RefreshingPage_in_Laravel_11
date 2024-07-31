<?php

use App\Http\Controllers\AdminBlogController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\DataController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Data Management
Route::post('/add', [DataController::class, 'store'])->name('upload');
Route::delete('/delete', [DataController::class, 'destroy'])->name('delete');
Route::put('/edit', [DataController::class, 'update'])->name('edit');

// Show Blogs
Route::get('/blogs', [BlogController::class, 'index'])->name('blog.show');


// Blogs Management
Route::get('/admin', [AdminBlogController::class, 'index'])->name('dashboard');
Route::post('/admin/store', [AdminBlogController::class, 'store'])->name('blog.store');

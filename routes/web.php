<?php

use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ReviewController;

Route::get('/', [HomeController::class, 'productFirst']);

Route::get('/filterProduct', [HomeController::class, 'filterProduct']);

// Login
Route::get('/admin', [AuthController::class, 'login'])->name('login');
Route::post('/admin/login', [AuthController::class, 'authenticate']);
// Dashboard

Route::get('/profile', function () {
    return view('pages.profile');
});
Route::get('/product', [ProductController::class, 'indexProductPage']);
Route::get('/product/{id}', [ProductController::class, 'show']);

Route::get('/article', [ArticleController::class, 'indexArticlePage']);
Route::get('/article/{slug}', [ArticleController::class, 'showArticle']);

Route::get('/contact', function () {
    return view('pages.contact');
});
Route::post('/contact', [ContactController::class, 'send']);

Route::middleware(['auth', 'remember.page'])->group(function () {

    Route::get('/admin/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::put('/admin/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::get('/admin/product', [ProductController::class, 'index']);
    Route::get('/admin/product/create', [ProductController::class, 'create']);
    Route::post('/admin/product', [ProductController::class, 'store']);
    Route::get('/admin/product/{id}', [ProductController::class, 'edit']);
    Route::put('/admin/product/{id}', [ProductController::class, 'update']);
    Route::delete('/admin/product/{id}', [ProductController::class, 'delete']);
    Route::delete('/admin/product/gallery/{id}',[ProductController::class, 'deleteGalleryImage']);

    Route::get('/admin/article', [ArticleController::class, 'index']);
    Route::get('/admin/article/create', [ArticleController::class, 'create']);
    Route::post('/admin/article', [ArticleController::class, 'store']);
    Route::get('/admin/article/{id}', [ArticleController::class, 'edit']);
    Route::put('/admin/article/{id}', [ArticleController::class, 'update']);
    Route::delete('/admin/article/{id}', [ArticleController::class, 'delete']);
    Route::post('/admin/article/upload', [ArticleController::class, 'upload']);
    Route::post('/admin/article/delete-image', [ArticleController::class, 'deleteImage']);

    Route::get('/admin/review', [ReviewController::class, 'index']);
    Route::get('/admin/review/create', [ReviewController::class, 'create']);
    Route::post('/admin/review', [ReviewController::class, 'store']);
    Route::get('/admin/review/{review}', [ReviewController::class, 'edit']);
    Route::put('/admin/review/{review}', [ReviewController::class, 'update']);
    Route::delete('/admin/review/{review}', [ReviewController::class, 'delete']);

    Route::get('/admin/logout', [AuthController::class, 'login']);
    Route::post('/admin/logout', [AuthController::class, 'logout']);
});
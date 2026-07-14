<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;

Route::get('/', HomeController::class);
Route::get('/article/{article:slug}', [ArticleController::class, 'show']);
Route::get('/category/{category:slug}', [CategoryController::class, 'show']);
Route::get('/category/{category:slug}/load-more', [CategoryController::class, 'loadMore'])->name('categories.load-more');
Route::get('/search/load-more', [SearchController::class, 'loadMore'])->name('search.load-more');
Route::post('/article/{article:slug}/comments', [ArticleController::class, 'storeComment']);
Route::get('/search', SearchController::class);
Route::post('/newsletter', NewsletterController::class);
Route::get('/page/{slug}', PageController::class);

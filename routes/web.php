<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ArticleController::class, 'index'] )->name('index');

Route::get('/{article}', [ArticleController::class, 'show'])->name('article.show'); 

Route::get('/articles/create', [ArticleController::class,'create'])->name('article.create');

Route::post('/articles', [ArticleController::class, 'store'])->name('article.store');

Route::get('articles/edit/{article}', [ArticleController::class, 'edit'])->name('article.edit');

Route::put('articles/{article}', [ArticleController::class, 'update'])->name('article.update');

Route::delete('articles/{article}', [ArticleController::class, 'destroy'])->name('article.destroy');

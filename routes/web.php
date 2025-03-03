<?php

use App\Http\Controllers\ArticleController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ArticleController::class, 'index'] )->name('index');

Route::get('/articles/create', [ArticleController::class,'create'])->name('article.create');

Route::get('/articles/{article}', [ArticleController::class, 'show'])->name('article.show'); 

// Route::get('/articles/{article}/qrcode', [ArticleController::class, 'generateQrCode'])->name('article.qrcode');

Route::post('/articles', [ArticleController::class, 'store'])->name('article.store');

Route::get('articles/{article}/edit', [ArticleController::class, 'edit'])->name('article.edit');

Route::put('articles/{article}', [ArticleController::class, 'update'])->name('article.update');

Route::delete('articles/{article}', [ArticleController::class, 'destroy'])->name('article.destroy');

Route::get('/articles/{article}/pdf', [ArticleController::class, 'pdfView'])->name('article.pdf');

Route::get('article/scanner', [ArticleController::class, 'scannage'])->name('article.scanner');

Route::get('/generate{article}', [ArticleController::class, 'generate'])->name('article.generate');



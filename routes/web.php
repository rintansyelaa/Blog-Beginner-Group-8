<?php

use App\Http\Controllers\ArticlesController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TagsController;
use Illuminate\Support\Facades\Route;

Route::get('/', [SiteController::class, 'homepage'])->name('home');
Route::get('/about', [SiteController::class, 'aboutUs'])->name('about');
Route::get('/articles/detail/{article}', [ArticlesController::class, 'viewArticle'])->name('articles.detail');

Route::middleware('auth')->group(function () {

    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::get('/dashboard', [SiteController::class, 'overview'])->name('dashboard');

    Route::prefix('tags')->group(function () {
        Route::get('/', [TagsController::class, 'listTags'])->name('tags.index');
        Route::get('/create', [TagsController::class, 'newTagForm'])->name('tags.create');
        Route::get('/edit/{tag}', [TagsController::class, 'editTag'])->name('tags.edit');
        Route::post('/', [TagsController::class, 'saveTag'])->name('tags.store');
        Route::put('/{tag}', [TagsController::class, 'updateTag'])->name('tags.update');
        Route::delete('/{tag}', [TagsController::class, 'removeTag'])->name('tags.delete');
    });
    Route::prefix('categories')->group(function () {
        Route::get('/', [CategoriesController::class, 'listCategories'])->name('categories.index');
        Route::get('/create', [CategoriesController::class, 'newCategoryForm'])->name('categories.create');
        Route::get('/edit/{category}', [CategoriesController::class, 'editCategory'])->name('categories.edit');
        Route::post('/', [CategoriesController::class, 'saveCategory'])->name('categories.store');
        Route::put('/{category}', [CategoriesController::class, 'updateCategory'])->name('categories.update');
        Route::delete('/{category}', [CategoriesController::class, 'removeCategory'])->name('categories.delete');
    });

    Route::prefix('articles')->group(function () {
        Route::get('/', [ArticlesController::class, 'listArticles'])->name('articles.index');
        Route::get('/create', [ArticlesController::class, 'newArticleForm'])->name('articles.create');
        Route::get('/edit/{article}', [ArticlesController::class, 'editArticle'])->name('articles.edit');
        Route::post('/', [ArticlesController::class, 'saveArticle'])->name('articles.store');
        Route::put('/{article}', [ArticlesController::class, 'updateArticle'])->name('articles.update');
        Route::delete('/{article}', [ArticlesController::class, 'removeArticle'])->name('articles.delete');
        Route::delete('/{article}/tag/{tag}', [ArticlesController::class, 'detachTag'])->name('articles.tag.delete');
    });

});
require __DIR__ . '/auth.php';

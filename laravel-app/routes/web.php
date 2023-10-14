<?php

use App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/', 'home')->name('home');

Route::view('/consulting', 'consulting')->name('consulting');

Route::view('/team', 'team')->name('team');

Route::redirect('/discord', 'https://discord.gg/filament')->name('discord');

Route::prefix('/community')->group(function () {
    Route::get('/', Controllers\Articles\ListArticlesController::class)->name('articles');

    Route::name('articles.')->group(function () {
        Route::prefix('/{article:slug}')->group(function () {
            Route::get('/', Controllers\Articles\ViewArticleController::class)->name('view');
        });
    });
});

Route::prefix('/features')->group(function () {
    Route::get('/', Controllers\Plugins\ListPluginsController::class)->name('features');

    Route::name('features.')->group(function () {
        
        Route::prefix('/{plugin:slug}')->group(function () {
            Route::get('/', Controllers\Plugins\ViewPluginController::class)->name('view');
        });
    });
});

Route::redirect('/blog', '/community');
Route::redirect('/tricks', '/community');
Route::get('/tricks/{slug}', function (string $slug) {
    return redirect("https://v2.filamentphp.com/tricks/{$slug}");
});

Route::redirect('/login', '/admin/login')->name('login');
//Route::redirect('/themes', '/plugins/filament-minimal-theme');

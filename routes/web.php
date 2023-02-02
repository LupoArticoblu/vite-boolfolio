<?php

use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\dashboardController;
use App\Http\Controllers\Admin\PortfolioController;
use App\Http\Controllers\Guest\PageController;
use App\Http\Controllers\ProfileController;
use App\Models\Portfolio;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [PageController::class, 'index'])->name('home');

Route::middleware(['auth', 'verified'])
    ->name('admin.')
    ->prefix('admin')
    ->group(function () {
        Route::get('/', [dashboardController::class, 'index'])->name('home');
        Route::get('/Portfolio/Portfolio-categories', [PortfolioController::class, 'category_portfolio'])->name('category_portfolio');
        Route::resource('portfolio', PortfolioController::class);
        Route::resource('tag', TagController::class)->except(['show', 'create', 'edit']);
        Route::resource('categories', CategoryController::class)->except(['show', 'create', 'edit']);
        Route::get('portfolios/orderby/{column}/{direction}', [PortfolioController::class, 'orderby'])->name('portfolios.orderby');
    });


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';


//rotte Vue (sempre a piè pagina)

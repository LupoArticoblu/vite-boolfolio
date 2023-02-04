<?php

use App\Http\Controllers\Api\PortfolioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Psy\CodeCleaner\ReturnTypePass;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// raggruppo le rotte di portfolios da Api
Route::namespace('Api')
    ->prefix('portfolios')
    ->group(function () {

        Route::get('/', [PortfolioController::class, 'index']);
        Route::get('/{slug}', [PortfolioController::class, 'show']);
    });

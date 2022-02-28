<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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

Route::get('/establecimientos', [ApiController::class, 'establecimientos'])->name('establecimientos');
Route::get('/establecimientos/{establecimiento}', [APIController::class, 'establecimiento'])->name('establecimiento');

Route::get('/categorias', [APIController::class, 'categorias'])->name('categorias');
Route::get('/categorias/{categoria}', [APIController::class, 'categoria'])->name('categoria');
Route::get('/{categoria}', [APIController::class, 'establecimientosPorCategoria'])->name('categoria2');

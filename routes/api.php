<?php

use App\Http\Controllers\NewsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


Route::post('noticias/buscar', [NewsController::class, 'search']);
Route::post('noticias/buscarPorLote', [NewsController::class, 'buscarPorLote']);
Route::post('noticias/guardar', [NewsController::class, 'save']);
Route::post('noticias/guardarPorLote', [NewsController::class, 'guardarPorLote']);
Route::post('noticias/limpiar', [NewsController::class, 'limpiar']);
Route::post('noticias/obtener', [NewsController::class, 'obtener']);
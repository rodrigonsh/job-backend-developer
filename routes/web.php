<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BuscaController;
use App\Http\Controllers\ProductController;

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

Route::get('/', [BuscaController::class, 'index']);

Route::post('/buscaTermo', [BuscaController::class, 'termo']);
Route::post('/categoria', [BuscaController::class, 'categoria']);
Route::post('/imagem', [BuscaController::class, 'imagem']);
Route::post('/id', [BuscaController::class, 'id']);

Route::get('/produto/{id}', [ProductController::class, 'view']);
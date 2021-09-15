<?php

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

Route::get('', [App\Http\Controllers\IndexController::class, 'index']);
Route::get('marvel/characters', [App\Http\Controllers\IndexController::class, 'marvelCharacters']);
Route::get('get/marvel/characters', [App\Http\Controllers\IndexController::class, 'getMarvelCharacters']);
Route::get('import', [App\Http\Controllers\IndexController::class, 'import']);
Route::get('datatable/imports', [App\Http\Controllers\IndexController::class, 'getImports']);
Route::post('import', [App\Http\Controllers\IndexController::class, 'saveImport']);

//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

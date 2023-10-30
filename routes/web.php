<?php

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::resource('productos', 'App\Http\Controllers\ProductoController')->names('producto');
Route::resource('categorias', 'App\Http\Controllers\CategoriaController')->names('categoria');


Route::get('/{any}', function () {
    return view('layouts.app');
})->where('any', '.*');



Auth::routes();

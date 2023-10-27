<?php

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/products', function () {
    return view('producto.index');
});

Route::get('/admin/product/create', function () {
    return view('producto.create');
});

Route::get('/admin/product/edit/{id}', function ($id) {
    return view('producto.edit');
});
Route::get('/admin/product/list', function () {
    return view('producto.index');
});






Route::get('/categorias', [CategoriaController::class, 'index'])->name('categorias.index');
Route::resource('productos', 'App\Http\Controllers\ProductoController')->names('producto');

<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;



Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Route::post("productos/{id}", [ProductoController::class, "update"]);





Route::resource('categorias', CategoriaController::class);
Route::resource('productos', ProductoController::class);
Route::resource('cart', CartController::class);

//  Route::put('productos/{}', 'ProductoController@update');

Auth::routes();

Route::get("/getInfoUser", [UserController::class, "getInfoUser"]);
Route::get("/getAuth", [UserController::class, "getAuth"]);


Route::get('/{any}', function () {
    return view('layouts.app');
})->where('any', '.*');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

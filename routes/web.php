<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CitiesDepartmentsController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\WebhooksController;





Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// Route::post("productos/{id}", [ProductoController::class, "update"]);





Route::resource('categorias', CategoriaController::class);
Route::resource('productos', ProductoController::class);
Route::resource('cart', CartController::class);

//  Route::put('productos/{}', 'ProductoController@update');
Route::get("/createPayment", [PaymentController::class, "createPayment"]);
Route::get("/paymentSuccess", [PaymentController::class, "successPayment"]);
Route::get("/purchaseHistory", [PaymentController::class, "purchaseHistory"]);
Auth::routes();

Route::get("/getInfoUser", [UserController::class, "getInfoUser"]);
Route::get("/getAuth", [UserController::class, "getAuth"]);

Route::get("/departments", [CitiesDepartmentsController::class, "getDepartments"]);
Route::get("/mercadopago-key", [PaymentController::class, "getMercadoPagoKey"]);
Route::get("/cities/{id}", [CitiesDepartmentsController::class, "getCities"]);

Route::get("/paymentTest", [PaymentController::class, "salesHistory"]);

Route::post(
    '/webhooks',
    WebhooksController::class
)->name('webhooks');


Route::get('/{any}', function () {
    return view('layouts.app');
})->where('any', '.*');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TypeProduitController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\TransactionController;


Route::get('/', function () {
    return view('welcome');
});

Route::resource('typeproduits', TypeProduitController::class);
Route::resource('produits', ProduitController::class);
Route::resource('stocks',StockController::class);
Route::resource('transactions',TransactionController::class);

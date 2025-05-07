<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\StockController;

Route::get('/dashboard', [StockController::class, 'dashboard'])->middleware('auth')->name('dashboard');
Route::post('/stock/add', [StockController::class, 'addStock'])->name('stock.add');
Route::post('/stock/in', [StockController::class, 'stockIn'])->name('stockin');
Route::post('/stock/out', [StockController::class, 'stockOut'])->name('stockout');
Route::delete('/stock/{id}', [StockController::class, 'destroy'])->name('stock.delete');
Route::get('/stock/{id}/edit', [StockController::class, 'edit'])->name('stock.update');
Route::get('/dashboard', [StockController::class, 'dashboard'])->name('dashboard');
Route::put('/stock/{id}', [StockController::class, 'update'])->name('stock.save');




//Login  & Register routes

require __DIR__.'/auth.php';
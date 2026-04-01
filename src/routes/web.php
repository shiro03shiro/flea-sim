<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PurchaseController;


Route::get('/', [ItemController::class, 'index'])->name('home');
Route::get('/item/{item_id}', [ItemController::class, 'show'])->name('items.show');

Route::middleware('auth')->group(function () {

    Route::post('/item/{item_id}/comments', [ItemController::class, 'comment'])->name('items.comment');

    Route::post('/item/{item_id}/likes', [ItemController::class, 'like'])->name('items.like');
    Route::delete('/item/{item_id}/likes', [ItemController::class, 'unlike'])->name('items.unlike');

    Route::get('/purchase/{item_id}', [PurchaseController::class, 'create'])->name('purchases.create');
    Route::post('/purchase/{item_id}', [PurchaseController::class, 'store'])->name('purchases.store');

    Route::get('/purchase/address/{item_id}', [PurchaseController::class, 'edit'])->name('purchases.edit');
    Route::patch('/purchase/address/{item_id}', [PurchaseController::class, 'update'])->name('purchases.update');

    Route::get('/sell', [ItemController::class, 'create'])->name('items.create');
    Route::post('/sell', [ItemController::class, 'store'])->name('items.store');

    Route::get('/mypage', [ProfileController::class, 'show'])->name('profile.show');
    
    Route::get('/mypage/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/mypage/profile', [ProfileController::class, 'update'])->name('profile.update');
});
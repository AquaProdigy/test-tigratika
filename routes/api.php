<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/item/update-position', [\App\Http\Controllers\ItemApiController::class, 'updatePosition']);
Route::delete('/item/delete/{id}', [\App\Http\Controllers\ItemApiController::class, 'delete'])->name('item.delete');

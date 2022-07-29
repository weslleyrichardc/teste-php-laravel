<?php

use App\Http\Controllers\ApiController;
use Illuminate\Support\Facades\Route;

Route::get('/hash', [ApiController::class, 'index'])->name('hash.index');
Route::post('/hash', [ApiController::class, 'create'])->name('hash.create');

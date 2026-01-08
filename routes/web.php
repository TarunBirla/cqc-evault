<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CqcVaultController;

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

    Route::get('/', [CqcVaultController::class,'index']);
    Route::get('cqc-vault', [CqcVaultController::class,'index']);
    Route::get('cqc-vault/folder/{id}', [CqcVaultController::class,'viewFolder']);
    Route::post('cqc-vault/upload', [CqcVaultController::class,'upload']);
    Route::get('cqc-vault/history/{id}', [CqcVaultController::class,'history']);




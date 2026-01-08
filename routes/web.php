<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CqcVaultController;



    Route::get('/', [CqcVaultController::class,'index']);
    Route::get('cqc-vault', [CqcVaultController::class,'index']);
    Route::get('cqc-vault/folder/{id}', [CqcVaultController::class,'viewFolder']);
    Route::post('cqc-vault/upload', [CqcVaultController::class,'upload']);
    Route::get('cqc-vault/history/{id}', [CqcVaultController::class,'history']);
Route::post('cqc-vault/folder/create',[CqcVaultController::class,'createFolder']);




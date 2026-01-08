<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CqcVaultController;

// Show main index page
Route::get('/', [CqcVaultController::class,'index']);
Route::get('cqc-vault', [CqcVaultController::class,'index']);

// Folder creation
Route::get('cqc-vault/folder/create', [CqcVaultController::class,'createFolderPage']);
Route::post('cqc-vault/folder/create', [CqcVaultController::class,'createFolder']);

// Folder view (show documents & subfolders)
Route::get('cqc-vault/folder/{id}', [CqcVaultController::class,'viewFolder']);

// Upload document
Route::post('cqc-vault/upload', [CqcVaultController::class,'upload']);

// Document history
Route::get('cqc-vault/history/{id}', [CqcVaultController::class,'history']);






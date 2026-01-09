<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\CqcVaultController;


use App\Http\Controllers\AuthController;

Route::get('/register',[AuthController::class,'showRegister']);
Route::post('/register',[AuthController::class,'register']);

Route::get('/login',[AuthController::class,'showLogin'])->name('login');
Route::post('/login',[AuthController::class,'login']);

Route::get('/logout',[AuthController::class,'logout']);

Route::middleware(['auth'])->group(function () {
    // Show main index page
Route::get('/', [CqcVaultController::class,'index']);
Route::get('cqc-vault', [CqcVaultController::class,'index']);

// Audit logs
Route::get('cqc-vault/audit-logs', [CqcVaultController::class,'auditLogs']);

// Folder creation
Route::get('cqc-vault/folder/create', [CqcVaultController::class,'createFolderPage']);
Route::post('cqc-vault/folder/create', [CqcVaultController::class,'createFolder']);

// Folder view (show documents & subfolders)
Route::get('cqc-vault/folder/{id}', [CqcVaultController::class,'viewFolder']);

// Upload document
Route::post('cqc-vault/upload', [CqcVaultController::class,'upload']);

// Document history
Route::get('cqc-vault/history/{id}', [CqcVaultController::class,'history']);

// Add multiple subfolders
Route::post('cqc-vault/folder/{id}/subfolders', [CqcVaultController::class,'addSubfolders']);

// Delete a folder
Route::delete('cqc-vault/folder/{id}', [CqcVaultController::class,'dFolder']);
Route::delete('cqc-vault/folder/{id}', [CqcVaultController::class,'deleteFolder']);
Route::delete('cqc-vault/document/{id}', [CqcVaultController::class, 'deleteDocument']);
});








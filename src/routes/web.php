<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AuthController;

Route::get('/', [ContactController::class, 'index'])->name('contact.index');
Route::post('/confirm', [ContactController::class, 'confirm'])->name('contact.confirm');
Route::post('/thanks', [ContactController::class, 'store'])->name('contact.store');

Route::middleware('auth')->group(function () {
    Route::get('/admin', [AuthController::class, 'dashboard'])->name('admin.dashboard');
    Route::delete('/admin/contact/{id}', [AuthController::class, 'destroy'])->name('admin.contact.destroy');
});

Route::get('/admin/search', [ContactController::class, 'search'])->name('admin.search');
Route::delete('/admin/contacts/{contact}', [ContactController::class, 'destroy'])->name('admin.destroy');
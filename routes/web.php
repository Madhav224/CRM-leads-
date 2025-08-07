<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\viewcontroller;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\leadcontroller;
use App\Http\Controllers\statuscontroller;



Route::get('/reset-password/{token}', [PasswordResetController::class, 'showResetForm'])
    ->middleware('guest')
    ->name('password.reset');




Route::get('/dashboard', [viewcontroller::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
// Route::resource('leads', leadcontroller::class);

Route::get('/leads', [leadcontroller::class, 'index'])->name('leads.index');
Route::get('/leads/create', [leadcontroller::class, 'create'])->name('leads.create');
Route::post('/leads', [leadcontroller::class, 'store'])->name('leads.store');
Route::get('/leads/{lead}/edit', [leadcontroller::class, 'edit'])->name('leads.edit');
Route::put('/leads/{lead}', [leadcontroller::class, 'update'])->name('leads.update');
Route::delete('/leads/{lead}', [leadcontroller::class, 'destroy'])->name('leads.destroy');

Route::get('/leads/filter-date/{date}', [leadcontroller::class, 'filterByDate'])->name('leads.filter-date');

Route::get('/leads/filter-status/{status_id}', [leadcontroller::class, 'filterByStatus'])->name('leads.filter-status');

// Route::get('/leads/search', [leadcontroller::class, 'search'])->name('leads.search');
Route::get('/leads/live-search', [leadcontroller::class, 'liveSearch'])->name('leads.live-search');


Route::get('/leads/kanban', [leadcontroller::class, 'kanban'])->name('leads.kanban');


Route::post('/leads/interaction-update', [leadcontroller::class, 'updateInteraction'])->name('leads.updateInteraction');




Route::resource('statuses', \App\Http\Controllers\statuscontroller::class)->except(['create', 'edit', 'show']);

Route::resource('products', \App\Http\Controllers\ProductController::class);




});

require __DIR__.'/auth.php';

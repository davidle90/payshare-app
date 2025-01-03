<?php

use App\Http\Controllers\CookiePolicyController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

Route::get('/cookie-policy', [CookiePolicyController::class, 'index'])->name('cookie-policy');

Route::middleware('auth', 'verified')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/', [PublicController::class, 'index'])->name('index');

    Route::get('/groups', [GroupController::class, 'index'])->name('groups.index');
    Route::get('/groups/{id}', [GroupController::class, 'view'])->name('groups.view');
});

Route::middleware(['auth', 'admin'])->group(function () {

});

require __DIR__.'/auth.php';

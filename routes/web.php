<?php

use App\Http\Controllers\CookiePolicyController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\PaymentController;
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
    Route::get('/groups/view/{id}', [GroupController::class, 'view'])->name('groups.view');
    Route::get('/groups/create', [GroupController::class, 'create'])->name('groups.create');
    Route::get('/groups/edit/{id}', [GroupController::class, 'edit'])->name('groups.edit');
    Route::post('/groups/store', [GroupController::class, 'store'])->name('groups.store');
    Route::post('/groups/delete', [GroupController::class, 'delete'])->name('groups.delete');

    Route::get('/groups/{group_id}/payments/view/{payment_id}', [PaymentController::class, 'view'])->name('payments.view');
    Route::get('/groups/{group_id}/payments/create', [PaymentController::class, 'create'])->name('payments.create');
    Route::get('/groups/{group_id}/payments/edit/{payment_id}', [PaymentController::class, 'edit'])->name('payments.edit');
    Route::post('/groups/payments/store', [PaymentController::class, 'store'])->name('payments.store');
    Route::post('/groups/payments/delete', [PaymentController::class, 'delete'])->name('payments.delete');
});

Route::middleware(['auth', 'admin'])->group(function () {

});

require __DIR__.'/auth.php';

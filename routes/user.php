<?php

use App\Http\Controllers\UserController;


Route::resource('user', UserController::class);
Route::put('user/update_password/{id}', [UserController::class, 'updatePassword'])->name('user.updatePassword');
Route::post('user/toggle_status', [UserController::class, 'toggleStatus'])->name('user.toggleStatus');

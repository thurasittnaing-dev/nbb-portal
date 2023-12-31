<?php

use App\Http\Controllers\PageController;

Route::get('/dashboard', [PageController::class, 'dashboard'])->name('dashboard');

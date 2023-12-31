<?php

use Illuminate\Support\Facades\Route;


# Redirect Route
Route::get('/', function () {
    return redirect('admin/dashboard');
});

# Authentication Routes
Auth::routes(['register' => false, 'reset' => false, 'verify' => false, 'login' => true]);


# Backend Routes
Route::group(['middleware' => 'auth', 'prefix' => 'admin'], function () {

    # Pages Route
    require_once('page.php');

    # User Route
    require_once('user.php');
});

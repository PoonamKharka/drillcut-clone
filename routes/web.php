<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;



Route::group(['middleware' => 'guest'], function () {
    Route::get('/', [AuthController::class, 'loginPage']);
    Route::post('login' , [AuthController::class, 'postLogin']);
  });
  Route::group(['middleware' => 'auth'], function () {
    Route::get('admin-dashboard', [AuthController::class, 'showDashboard']);
    Route::resources([
      'orders' => OrderController::class,
      'users' =>  UserController::class,
      'products' => ProductController::class,
    ]);
  });
 
  Route::post('logout', [AuthController::class, 'logout'])->name('logout');
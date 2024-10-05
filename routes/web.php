<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Middleware\CheckIsLogin;
use App\Http\Middleware\CheckIsNotLogin;
use Illuminate\Support\Facades\Route;

//userLogged
Route::middleware([CheckIsNotLogin::class])->group(function(){
    //auth routes
    Route::get('/login', [AuthController::class, 'login']);
    Route::post('/loginSubmit', [AuthController::class, 'loginsubmit']);
});

//userDontLogged
Route::middleware([CheckIsLogin::class])->group(function(){
    Route::get('/', [MainController::class, 'index'])->name('home');
    Route::get('/newNote', [MainController::class, 'newNote'])->name('new');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});




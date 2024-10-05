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
    //home route
    Route::get('/', [MainController::class, 'index'])->name('home');

    //new note
    Route::get('/newNote', [MainController::class, 'newNote'])->name('new');
    Route::post('/newNoteSubmit', [MainController::class, 'newNoteSubmit'])->name('newNoteSubmit');

    //edit note
    Route::get('/editNote/{id}', [MainController::class, 'editNote'])->name('edit');
    Route::post('editNoteSubmit', [MainController::class, 'editNoteSubmit'])->name('editNoteSubmit');

    //delete note
    Route::get('/deleteNote/{id}', [MainController::class, 'deleteNote'])->name('delete');
    Route::get('/deleteNoteConfirm/{id}', [MainController::class, 'deleteNoteConfirm'])->name('deleteConfirm');


    //logout
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
});




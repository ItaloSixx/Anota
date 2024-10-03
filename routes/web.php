<?php

use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    echo "Oioioi";
});

Route::get('/Sobre', function () {
    echo "É sobre isso";
});

Route::get('/Main', [MainController::class, 'index']);

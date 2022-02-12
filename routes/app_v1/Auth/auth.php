<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\v1\RestApiApp\Auth\AuthController;

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);

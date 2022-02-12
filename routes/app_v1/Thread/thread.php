<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\v1\RestApiApp\Thread\RestApiThreadController;

Route::controller(RestApiThreadController::class)
    ->group(function () {
        Route::get('/', 'list');
        Route::get('/my-threads', 'myThreads');

        Route::post('/', 'store');
        Route::put('/{thread_id}', 'update');

        Route::get('/{slug}', 'show');
        Route::get('/comments/{slug}', 'getComments');

        Route::get('/like/{slug}', 'like');
        Route::get('/dislike/{slug}', 'dislike');
    });

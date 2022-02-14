<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\v1\RestApiApp\Post\RestApiPostController;

Route::controller(RestApiPostController::class)
    ->group(function () {
        Route::get('/', 'list');
        Route::get('/my-posts', 'myPosts');

        Route::post('/', 'store');
        Route::put('/{post_id}', 'update');

        Route::get('/{slug}', 'show');
        Route::get('/comments/{slug}', 'getComments');

        Route::get('/like/{slug}', 'like');
        Route::get('/dislike/{slug}', 'dislike');
    });

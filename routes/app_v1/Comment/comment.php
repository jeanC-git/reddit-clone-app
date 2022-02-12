<?php

use App\Http\Controllers\v1\RestApiApp\Comment\RestApiCommentController;
use Illuminate\Support\Facades\Route;

Route::controller(RestApiCommentController::class)->group(function () {
    Route::get('/{comment}', 'show');

    Route::post('/', 'store');
    Route::put('/{comment}', 'update');


    Route::get('/{comment}/like', 'like');
    Route::get('/{comment}/dislike', 'dislike');

    Route::get('/{comment}/replies', 'replies');
});

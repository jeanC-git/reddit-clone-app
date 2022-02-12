<?php

use Illuminate\Support\Facades\Route;

Route::prefix('api/v1/auth')->group(base_path('routes/app_v1/Auth/auth.php'));

Route::group([
    'middleware' => ['auth:api'],
    'prefix' => 'api/v1'
], function () {
    Route::prefix('threads')->group(base_path('routes/app_v1/Thread/thread.php'));
    Route::prefix('comments')->group(base_path('routes/app_v1/Comment/comment.php'));
});

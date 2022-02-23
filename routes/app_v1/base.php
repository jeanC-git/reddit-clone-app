<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\v1\RestApiApp\Post\RestApiPostController;

Route::prefix('api/v1/auth')->group(base_path('routes/app_v1/Auth/auth.php'));

Route::group([
    'middleware' => ['auth:api'],
    'prefix' => 'api/v1'
], function () {
    Route::prefix('posts')->group(base_path('routes/app_v1/Post/post.php'));
    Route::prefix('comments')->group(base_path('routes/app_v1/Comment/comment.php'));
});

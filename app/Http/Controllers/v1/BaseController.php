<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;

class BaseController extends Controller
{
    use ApiResponse;

    public function parsePaginateResource($data, $key = 'data')
    {
        return [
            $key => $data->items(),
            'next_page' => $data->nextPageUrl(),
        ];
    }
}

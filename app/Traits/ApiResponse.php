<?php


namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;


trait ApiResponse
{
    /**
     * Success Response
     * @param $data
     * @param int $code
     * @return JsonResponse
     */
    public static function success($data, int $code = ResponseAlias::HTTP_OK): JsonResponse
    {
        return response()->json($data, $code);
    }

    /**
     * Error Response
     * @param $message
     * @param int $code
     * @return JsonResponse
     *
     */
    public static function error($message, $code = 100001, int $codeHTTP = 422): JsonResponse
    {
        return response()->json([
            'message' => $message,
            'code' => $code
        ], $codeHTTP);
    }
}

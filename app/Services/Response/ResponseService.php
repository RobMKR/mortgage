<?php

namespace App\Services\Response;

use Carbon\Carbon;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ResponseService
{
    /**
     * @param array $errors
     * @return JsonResponse
     */
    public static function invalid(array $errors = []): JsonResponse
    {
        return response()->json([
            'type' => 'ERR_INVALID',
            'errors' => $errors
        ], 422);
    }

    /**
     * @param string $msg
     * @param int $code
     * @param int $statusCode
     * @return JsonResponse
     */
    public static function errorMessage(string $msg, int $code, int $statusCode = 400): JsonResponse
    {
        return response()->json([
            'type' => 'ERR_MESSAGE',
            'error' => $code,
            'error_message' => $msg,
            'timestamp' => Carbon::now()->timestamp
        ], $statusCode);
    }

    /**
     * @param string $msg
     * @return JsonResponse
     */
    public static function successMessage(string $msg): JsonResponse
    {
        return response()->json([
            'msg' => $msg
        ], 200);
    }

    /**
     * @return Response
     */
    public static function successNoContent(): Response
    {
        return response('', 204);
    }

    /**
     * @param Arrayable $data
     * @param Arrayable|null $metadata
     * @return JsonResponse
     */
    public static function data(Arrayable $data, Arrayable $metadata = null): JsonResponse
    {
        return response()->json([
            'data' => $data->toArray(),
            'metadata' => $metadata->toArray(),
        ], 200);
    }
}

<?php

namespace App\Http\Controllers;

use App\Services\Response\ResponseService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * @param array $errors
     * @return JsonResponse
     */
    protected function buildFailedValidationResponse(array $errors): JsonResponse
    {
        dd(1);
        $_errors = [];

        foreach ($errors as $fieldName => $messages){
            $_errors[] = [
                'fieldName' => $fieldName,
                'messages' => $messages
            ];
        }

        return ResponseService::invalid($_errors);
    }
}

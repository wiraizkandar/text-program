<?php

namespace App\Traits;

use Symfony\Component\HttpFoundation\Response;
use App\Enum\ResponseMessageStatusEnum;

trait ApiResponseTrait
{
    public function successResponse($data, $message = ResponseMessageStatusEnum::SUCCESS)
    {
        return response()->json([
            'message' => $message,
            'data' => $data,
        ], Response::HTTP_OK);
    }


    /**
     * Error response
     *
     * @param string $message
     * @param string $errorCode
     * @return JsonResponse
     */
    public function errorResponse($message = ResponseMessageStatusEnum::ERROR, $errorCode = Response::HTTP_INTERNAL_SERVER_ERROR)
    {
        return response()->json([
            'message' => $message,
        ], $errorCode);
    }
}

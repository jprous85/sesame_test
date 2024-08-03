<?php

namespace App\Shared\Infrastructure\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait HttpResponse
{
    public float| string $startTime;

    public function successResponse(array $data): JsonResponse
    {
        return new JsonResponse(
            [
                'data' => $data,
                'status' => 'success',
                'code' => Response::HTTP_OK,
                'total_data' => count($data),
                'time_response' => $this->checkStatusTime()
            ]
        );
    }

    public function errorResponse(array $data): JsonResponse
    {
        return new JsonResponse(['data' => $data, 'status' => 'error', 'code' => Response::HTTP_INTERNAL_SERVER_ERROR]);
    }

    private function startTime(): void
    {
        $this->startTime = microtime(true);
    }

    private function checkStatusTime(): float
    {
        $endTime = microtime(true);
        $status = $endTime - $this->startTime;
        return number_format((float)$status, 4, '.', '');
    }
}
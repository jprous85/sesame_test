<?php

declare(strict_types=1);


namespace App\WorkEntry\Infrastructure\Controllers;


use App\Shared\Infrastructure\Controller\BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class WorkEntryGetController extends BaseController
{
    public function show(Request $request): JsonResponse
    {
        $workEntryRequest = $request->get('uuid');

        return $this->successResponse([]);
    }

    public function showAll(): JsonResponse
    {
        return $this->successResponse([]);
    }
}
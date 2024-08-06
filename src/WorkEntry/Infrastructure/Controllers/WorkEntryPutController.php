<?php

declare(strict_types=1);


namespace App\WorkEntry\Infrastructure\Controllers;


use App\Shared\Infrastructure\Controller\BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class WorkEntryPutController extends BaseController
{
    public function update(Request $request): JsonResponse
    {
        $requestData = json_decode($request->getContent(), true, JSON_THROW_ON_ERROR);

        return $this->successResponse(['work entry has been updated successfully']);
    }
}
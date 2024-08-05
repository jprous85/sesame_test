<?php

declare(strict_types=1);


namespace App\User\Infrastructure\Controllers;


use App\Shared\Infrastructure\Controller\BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class UserGetController extends BaseController
{
    public function show(Request $request): JsonResponse
    {
        $userRequest = $request->get('uuid');

        return $this->successResponse([]);
    }

    public function showAll(): JsonResponse
    {
        return $this->successResponse([]);
    }
}
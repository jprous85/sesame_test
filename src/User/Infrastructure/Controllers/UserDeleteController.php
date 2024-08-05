<?php

declare(strict_types=1);


namespace App\User\Infrastructure\Controllers;


use App\Shared\Infrastructure\Controller\BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class UserDeleteController extends BaseController
{
    public function delete(Request $request): JsonResponse
    {
        $userRequest = $request->get('uuid');

        return $this->successResponse(['user has been deleted']);
    }
}
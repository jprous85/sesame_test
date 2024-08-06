<?php

declare(strict_types=1);


namespace App\User\Infrastructure\Controllers;


use App\Shared\Infrastructure\Controller\BaseController;
use App\User\Application\Request\UserUuidRequest;
use App\User\Application\UseCases\GetAllUsersQuery;
use App\User\Application\UseCases\GetUserByUuidQuery;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Exception;
use Throwable;

final class UserGetController extends BaseController
{
    /**
     * @throws Throwable
     */
    public function show(Request $request): JsonResponse
    {
        $userRequest = $request->get('uuid');

        $getUserByUuidQuery = new GetUserByUuidQuery(
            new UserUuidRequest($userRequest)
        );

        try {
            $result = $this->manageQuery($getUserByUuidQuery);
            return $this->successResponse($result);
        } catch (Exception $e) {
            return $this->errorResponse([$e->getMessage()]);
        }
    }

    /**
     * @throws Throwable
     */
    public function showAll(): JsonResponse
    {
        $getAllUsersQuery = new GetAllUsersQuery();
        $result = $this->manageQuery($getAllUsersQuery);

        return $this->successResponse($result);
    }
}
<?php

declare(strict_types=1);


namespace App\User\Infrastructure\Controllers;


use App\Shared\Infrastructure\Controller\BaseController;
use App\User\Application\Request\UserUuidRequest;
use App\User\Application\UseCases\DeleteUSerCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Throwable;

final class UserDeleteController extends BaseController
{
    /**
     * @throws Throwable
     */
    public function delete(Request $request): JsonResponse
    {
        $userRequest = $request->get('uuid');

        $deleteUserCommand = new DeleteUSerCommand(
            new UserUuidRequest($userRequest)
        );
        $this->manageCommand($deleteUserCommand);

        return $this->successResponse(['user has been deleted']);
    }
}
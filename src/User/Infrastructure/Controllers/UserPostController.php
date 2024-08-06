<?php

declare(strict_types=1);


namespace App\User\Infrastructure\Controllers;


use App\Shared\Infrastructure\Controller\BaseController;
use App\User\Application\Request\CreateUserRequest;
use App\User\Application\UseCases\CreateUserCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Uid\Uuid;
use Throwable;

final class UserPostController extends BaseController
{
    public function __construct(
        private readonly MessageBusInterface $commandBus,
        private readonly MessageBusInterface $queryBus,
        private readonly UserPasswordHasherInterface $passwordHashes
    )
    {
        parent::__construct($this->commandBus, $this->queryBus);
    }

    /**
     * @throws Throwable
     */
    public function create(Request $request): JsonResponse
    {
        $requestData = json_decode($request->getContent(), true, JSON_THROW_ON_ERROR);

        $createUserRequest = $this->userRequestMapper($requestData);

        $createUserCommand = new CreateUserCommand($createUserRequest);
        $this->manageCommand($createUserCommand);

        return $this->successResponse(['user has been created']);
    }

    private function userRequestMapper(array $request): CreateUserRequest
    {
        $userEntity = new \App\Entity\User();
        $passwordTextHashed = $this->passwordHashes->hashPassword($userEntity, $request['password']);

        return new CreateUserRequest(
            (string) Uuid::v4(),
            $request['name'],
            $request['email'],
            $passwordTextHashed
        );
    }
}
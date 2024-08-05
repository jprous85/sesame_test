<?php

declare(strict_types=1);


namespace App\User\Infrastructure\Controllers;


use App\Shared\Infrastructure\Controller\BaseController;
use App\User\Application\Request\UpdateUserRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

final class UserPutController extends BaseController
{
    public function __construct(
        private readonly MessageBusInterface $commandBus,
        private readonly MessageBusInterface $queryBus,
        private readonly UserPasswordHasherInterface $passwordHashes
    )
    {
        parent::__construct($this->commandBus, $this->queryBus);
    }

    public function update(Request $request): JsonResponse
    {
        $userUuidRequest = $request->get('uuid');
        $requestData = json_decode($request->getContent(), true, JSON_THROW_ON_ERROR);

        return $this->successResponse(['user has been updated']);
    }

    private function userRequestMapper(array $request): UpdateUserRequest
    {
        $userEntity = new \App\Entity\User();
        $passwordTextHashed = $this->passwordHashes->hashPassword($userEntity, $request['password']);

        return new UpdateUserRequest(
            $request['name'],
            $request['email'],
            $passwordTextHashed
        );
    }
}
<?php

declare(strict_types=1);


namespace App\User\Infrastructure\Controllers;


use App\Shared\Infrastructure\Controller\BaseController;
use App\User\Application\Request\CreateUserRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Uid\Uuid;

final class UserPostController extends BaseController
{

    const ADMIN_ROLE = 'admin';

    public function __construct(
        private readonly MessageBusInterface $commandBus,
        private readonly MessageBusInterface $queryBus,
        private readonly UserPasswordHasherInterface $passwordHashes
    )
    {
        parent::__construct($this->commandBus, $this->queryBus);
    }

    public function create(Request $request): JsonResponse
    {
        $requestData = json_decode($request->getContent(), true, JSON_THROW_ON_ERROR);

        $createUserRequest = $this->createUserMapper($requestData);

        return $this->successResponse(['user has been created']);
    }

    private function createUserMapper(array $request): CreateUserRequest
    {
        $userEntity = new \App\Entity\User();
        $passwordTextHashed = $this->passwordHashes->hashPassword($userEntity, $request['password']);


        return new CreateUserRequest(
            (string) Uuid::v4(),
            $request['name'],
            $request['email'],
            $passwordTextHashed,
            self::ADMIN_ROLE
        );
    }
}
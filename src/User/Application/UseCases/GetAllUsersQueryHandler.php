<?php

declare(strict_types=1);


namespace App\User\Application\UseCases;


use App\Shared\Domain\QueryHandlerInterface;
use App\User\Application\Response\UserResponse;
use App\User\Domain\User;
use App\User\Domain\UserRepository;

final class GetAllUsersQueryHandler implements QueryHandlerInterface
{
    public function __construct(private readonly UserRepository $userRepository)
    {
    }

    public function __invoke(GetAllUsersQuery $allUsersQuery): array
    {
        return $this->map($this->userRepository->getAllUsers());
    }

    private function map(array $users): array
    {
        $usersResponses = [];

        /**
         * @var User $user
         */
        foreach ($users as $user) {
            $usersResponses[] = UserResponse::userResponseMapper($user)->toArray();
        }
        return $usersResponses;
    }
}
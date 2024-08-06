<?php

declare(strict_types=1);


namespace App\User\Application\UseCases;


use App\Shared\Domain\QueryHandlerInterface;
use App\User\Application\Response\UserResponse;
use App\User\Domain\UserNotFoundException;
use App\User\Domain\UserRepository;
use App\User\Domain\ValueObjects\UserUuidVO;
use Exception;

final class GetUserByUuidQueryHandler implements QueryHandlerInterface
{
    public function __construct(private readonly UserRepository $userRepository)
    {
    }

    /**
     * @throws Exception
     */
    public function __invoke(GetUserByUuidQuery $userByUuidQuery): array
    {
        $user = $this->userRepository->getUserByUuid(
            new UserUuidVO($userByUuidQuery->getUuid())
        );

        if (!$user) {
            throw new UserNotFoundException();
        }

        return UserResponse::userResponseMapper($user)->toArray();
    }
}
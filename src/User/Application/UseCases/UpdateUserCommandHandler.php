<?php

declare(strict_types=1);


namespace App\User\Application\UseCases;


use App\Shared\Domain\CommandHandlerInterface;
use App\User\Domain\UserNotFoundException;
use App\User\Domain\UserRepository;
use App\User\Domain\ValueObjects\UserEmailVO;
use App\User\Domain\ValueObjects\UserNameVO;
use App\User\Domain\ValueObjects\UserPasswordVO;
use App\User\Domain\ValueObjects\UserUuidVO;
use Exception;

final class UpdateUserCommandHandler implements CommandHandlerInterface
{
    public function __construct(private readonly UserRepository $userRepository)
    {
    }

    /**
     * @throws Exception
     */
    public function __invoke(UpdateUserCommand $updateUserCommand)
    {
        $user = $this->userRepository->getUserByUuid(
            new UserUuidVO($updateUserCommand->uuid())
        );

        if (!$user) {
            throw new UserNotFoundException();
        }

        $user->update(
            new UserNameVO($updateUserCommand->name()),
            new UserEmailVO($updateUserCommand->email()),
            new UserPasswordVO($updateUserCommand->password()),
        );

        $this->userRepository->update($user);
    }
}
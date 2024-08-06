<?php

declare(strict_types=1);


namespace App\User\Application\UseCases;


use App\Shared\Domain\CommandHandlerInterface;
use App\User\Domain\UserNotFoundException;
use App\User\Domain\UserRepository;
use App\User\Domain\ValueObjects\UserUuidVO;

final class DeleteUserCommandHandler implements CommandHandlerInterface
{
    public function __construct(private readonly UserRepository $userRepository)
    {
    }

    /**
     * @throws \Exception
     */
    public function __invoke(DeleteUserCommand $deleteUserCommand)
    {
        $user = $this->userRepository->getUserByUuid(
            new UserUuidVO($deleteUserCommand->getUuid())
        );

        if (!$user) {
            throw new UserNotFoundException();
        }

        $user->deleted();

        $this->userRepository->delete($user);
    }
}
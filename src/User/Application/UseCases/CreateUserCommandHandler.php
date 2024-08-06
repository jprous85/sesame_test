<?php

declare(strict_types=1);


namespace App\User\Application\UseCases;


use App\Shared\Domain\CommandHandlerInterface;
use App\User\Domain\User;
use App\User\Domain\UserRepository;
use App\User\Domain\ValueObjects\UserEmailVO;
use App\User\Domain\ValueObjects\UserNameVO;
use App\User\Domain\ValueObjects\UserPasswordVO;
use App\User\Domain\ValueObjects\UserUuidVO;
use Exception;

final class CreateUserCommandHandler implements CommandHandlerInterface
{
    public function __construct(private readonly UserRepository $userRepository)
    {
    }

    /**
     * @throws Exception
     */
    public function __invoke(CreateUserCommand $createUserCommand): void
    {
        $user = User::create(
            new UserUuidVO($createUserCommand->uuid()),
            new UserNameVO($createUserCommand->name()),
            new UserEmailVO($createUserCommand->email()),
            new UserPasswordVO($createUserCommand->password()),
        );
        $this->userRepository->save($user);
    }
}
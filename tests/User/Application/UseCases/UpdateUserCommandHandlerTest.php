<?php

declare(strict_types=1);


namespace App\Tests\User\Application\UseCases;


use App\Shared\Domain\CommandHandlerInterface;
use App\Tests\User\Domain\UserMother;
use App\User\Application\Request\UpdateUserRequest;
use App\User\Application\UseCases\UpdateUserCommand;
use App\User\Application\UseCases\UpdateUserCommandHandler;
use App\User\Domain\UserNotFoundException;
use App\User\Domain\UserRepository;
use Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class UpdateUserCommandHandlerTest extends TestCase
{
    private MockObject|UserRepository $userRepository;
    private UpdateUserCommandHandler  $updateUserCommandHandler;

    protected function setUp(): void
    {
        $this->userRepository           = $this->createMock(UserRepository::class);
        $this->updateUserCommandHandler = new UpdateUserCommandHandler($this->userRepository);
    }

    /**
     * @test
     * @return void
     * @throws Exception
     */
    public function ensureIsInstanceOf(): void
    {
        $this->assertInstanceOf(UpdateUserCommandHandler::class, $this->updateUserCommandHandler);
        $this->assertInstanceOf(CommandHandlerInterface::class, $this->updateUserCommandHandler);
    }

    /**
     * @test
     * throw_error_if_user_does_not_exist
     * @throws Exception
     */
    public function isShouldThrowErrorIfUserDoesNotExist ()
    {
        $this->expectException(UserNotFoundException::class);
        $this->userRepository
            ->method('getUserByUuid')
            ->willThrowException(throw new UserNotFoundException());

        $this->userRepository
            ->expects(self::never())
            ->method('update');

        $createUserRequest = new UpdateUserRequest(
            '',
            '',
            '',
            ''
        );
        $createUserCommand = new UpdateUserCommand($createUserRequest);

        ($this->updateUserCommandHandler)($createUserCommand);
    }

    /**
     * @test
     * update_successfully_user_data
     * @throws Exception
     */
    public function isShouldUpdateSuccessfullyUserData ()
    {
        $user = UserMother::random();
        $userUpdated = UserMother::random();

        $this->userRepository
            ->expects(self::once())
            ->method('getUserByUuid')
            ->willReturn($user);

        $this->userRepository
            ->expects(self::once())
            ->method('update');

        $createUserRequest = new UpdateUserRequest(
            $user->getUuid()->uuid(),
            $userUpdated->getName()->value(),
            $userUpdated->getEmail()->value(),
            $userUpdated->getPassword()->value()
        );
        $createUserCommand = new UpdateUserCommand($createUserRequest);

        ($this->updateUserCommandHandler)($createUserCommand);
    }
}
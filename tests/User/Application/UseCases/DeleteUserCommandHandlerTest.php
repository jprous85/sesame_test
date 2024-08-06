<?php

declare(strict_types=1);


namespace App\Tests\User\Application\UseCases;


use App\Shared\Domain\CommandHandlerInterface;
use App\Tests\User\Domain\UserMother;
use App\User\Application\Request\UpdateUserRequest;
use App\User\Application\Request\UserUuidRequest;
use App\User\Application\UseCases\DeleteUserCommand;
use App\User\Application\UseCases\DeleteUserCommandHandler;
use App\User\Application\UseCases\UpdateUserCommand;
use App\User\Application\UseCases\UpdateUserCommandHandler;
use App\User\Domain\UserNotFoundException;
use App\User\Domain\UserRepository;
use Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class DeleteUserCommandHandlerTest extends TestCase
{
    private MockObject|UserRepository $userRepository;
    private DeleteUserCommandHandler  $deleteUserCommandHandler;

    protected function setUp(): void
    {
        $this->userRepository           = $this->createMock(UserRepository::class);
        $this->deleteUserCommandHandler = new DeleteUserCommandHandler($this->userRepository);
    }

    /**
     * @test
     * @return void
     * @throws Exception
     */
    public function ensureIsInstanceOf(): void
    {
        $this->assertInstanceOf(DeleteUserCommandHandler::class, $this->deleteUserCommandHandler);
        $this->assertInstanceOf(CommandHandlerInterface::class, $this->deleteUserCommandHandler);
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
            ->method('delete');

        $deleteUserCommand = new DeleteUserCommand(
            new UserUuidRequest('')
        );
        $deleteUserCommand = new DeleteUserCommand($deleteUserCommand);

        ($this->deleteUserCommandHandler)($deleteUserCommand);
    }

    /**
     * @test
     * update_successfully_user_data
     * @throws Exception
     */
    public function isShouldDeleteUser ()
    {
        $user = UserMother::random();

        $this->userRepository
            ->expects(self::once())
            ->method('getUserByUuid')
            ->willReturn($user);

        $this->userRepository
            ->expects(self::once())
            ->method('delete');

        $deleteUserCommand = new DeleteUserCommand(
            new UserUuidRequest($user->getUuid()->uuid())
        );

        ($this->deleteUserCommandHandler)($deleteUserCommand);
    }
}
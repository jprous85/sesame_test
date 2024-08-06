<?php

declare(strict_types=1);


namespace App\Tests\User\Application\UseCases;


use App\Shared\Domain\CommandHandlerInterface;
use App\Tests\User\Domain\UserMother;
use App\User\Application\Request\CreateUserRequest;
use App\User\Application\UseCases\CreateUserCommand;
use App\User\Application\UseCases\CreateUserCommandHandler;
use App\User\Domain\UserRepository;
use Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class CreateUserCommandHandlerTest extends TestCase
{
    private MockObject|UserRepository $userRepository;
    private CreateUserCommandHandler $createUserCommandHandler;

    protected function setUp(): void
    {
        $this->userRepository = $this->createMock(UserRepository::class);
        $this->createUserCommandHandler = new CreateUserCommandHandler($this->userRepository);
    }

    /**
     * @test
     * @return void
     * @throws Exception
     */
    public function ensureIsInstanceOf(): void
    {
        $this->assertInstanceOf(CreateUserCommandHandler::class, $this->createUserCommandHandler);
        $this->assertInstanceOf(CommandHandlerInterface::class, $this->createUserCommandHandler);
    }

    /**
     * @test
     * return_correct_data
     * @throws Exception
     */
    public function isShouldCreatedSuccessfully()
    {
        $user = UserMother::random();
        $createUserRequest = new CreateUserRequest(
            $user->getUuid()->uuid(),
            $user->getName()->value(),
            $user->getEmail()->value(),
            $user->getPassword()->value()
        );

        $this->userRepository
            ->expects(self::once())
            ->method('save');

        $createUserCommand = new CreateUserCommand($createUserRequest);
        ($this->createUserCommandHandler)($createUserCommand);
    }
}
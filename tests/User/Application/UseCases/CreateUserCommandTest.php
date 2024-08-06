<?php

declare(strict_types=1);


namespace App\Tests\User\Application\UseCases;


use App\Tests\User\Domain\UserMother;
use App\User\Application\Request\CreateUserRequest;
use App\User\Application\UseCases\CreateUserCommand;
use Exception;
use PHPUnit\Framework\TestCase;

final class CreateUserCommandTest extends TestCase
{
    /**
     * @test
     * @return void
     * @throws Exception
     */
    public function ensureIsInstanceOf(): void
    {
        $createUserCommand = new CreateUserCommand(
            new CreateUserRequest(
                '',
                '',
                '',
                ''
            )
        );
        $this->assertInstanceOf(CreateUserCommand::class, $createUserCommand);
    }

    /**
     * @test
     * return_correct_data
     * @throws Exception
     */
    public function isShouldReturnCorrectData()
    {
        $user = UserMother::random();
        $createUserRequest = new CreateUserRequest(
            $user->getUuid()->uuid(),
            $user->getName()->value(),
            $user->getEmail()->value(),
            $user->getPassword()->value()
        );

        $createUserCommand = new CreateUserCommand($createUserRequest);

        $this->assertEquals($createUserCommand->uuid(), $user->getUuid()->uuid());
        $this->assertEquals($createUserCommand->name(), $user->getName()->value());
        $this->assertEquals($createUserCommand->email(), $user->getEmail()->value());
        $this->assertEquals($createUserCommand->password(), $user->getPassword()->value());
    }
}
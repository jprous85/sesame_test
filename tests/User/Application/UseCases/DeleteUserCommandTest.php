<?php

declare(strict_types=1);


namespace App\Tests\User\Application\UseCases;


use App\Tests\User\Domain\UserMother;
use App\Tests\User\Domain\ValueObjects\UserUuidVOMother;
use App\User\Application\Request\UserUuidRequest;
use App\User\Application\UseCases\DeleteUSerCommand;
use Exception;
use PHPUnit\Framework\TestCase;

final class DeleteUserCommandTest extends TestCase
{
    /**
     * @test
     * @return void
     * @throws Exception
     */
    public function ensureIsInstanceOf(): void
    {
        $deleteUserCommand = new DeleteUserCommand(
            new UserUuidRequest(UserUuidVOMother::random()->uuid())
        );

        $this->assertInstanceOf(DeleteUserCommand::class, $deleteUserCommand);
    }

    /**
     * @throws Exception
     */
    public function ensureHasCorrectData(): void
    {
        $user = UserMother::random();

        $deleteUserCommand = new DeleteUserCommand(
            new UserUuidRequest($user->getUuid()->uuid())
        );

        $this->assertEquals($deleteUserCommand->getUuid(), $user->getUuid()->uuid());
    }
}
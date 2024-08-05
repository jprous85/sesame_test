<?php

declare(strict_types=1);


namespace App\Tests\User\Application\UseCases;



use App\Shared\Domain\QueryHandlerInterface;
use App\Tests\User\Domain\UserMother;
use App\User\Application\Request\UserUuidRequest;
use App\User\Application\UseCases\GetUserByUuidQuery;
use App\User\Application\UseCases\GetUserByUuidQueryHandler;
use App\User\Domain\UserNotFoundException;
use App\User\Domain\UserRepository;
use Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class GetUserByUuidQueryHandlerTest extends TestCase
{
    private MockObject|UserRepository $userRepository;
    private GetUserByUuidQueryHandler $getUserByUuidQueryHandler;

    protected function setUp(): void
    {
        $this->userRepository = $this->createMock(UserRepository::class);
        $this->getUserByUuidQueryHandler = new GetUserByUuidQueryHandler($this->userRepository);
    }

    /**
     * @test
     * @return void
     * @throws Exception
     */
    public function ensureIsInstanceOf(): void
    {
        $this->assertInstanceOf(GetUserByUuidQueryHandler::class, $this->getUserByUuidQueryHandler);
        $this->assertInstanceOf(QueryHandlerInterface::class, $this->getUserByUuidQueryHandler);
    }

    /**
     * @test
     * throw_error_if_not_found_a_user
     * @throws Exception
     */
    public function isShouldThrowErrorIfNotFoundAUser ()
    {
        $this->expectException(UserNotFoundException::class);
        $this->userRepository
            ->method('getUserByUuid')
            ->willThrowException(throw new UserNotFoundException());

        ($this->getUserByUuidQueryHandler)(new GetUserByUuidQuery(new UserUuidRequest('')));
    }

    /**
     * @test
     * return_correct_data
     * @throws Exception
     */
    public function isShouldReturnCorrectData ()
    {
        $user = UserMother::random();

        $this->userRepository
            ->expects(self::once())
            ->method('getUserByUuid')
            ->willReturn($user);

        $query = new GetUserByUuidQuery(new UserUuidRequest($user->getUuid()->uuid()));
        ($this->getUserByUuidQueryHandler)($query);
    }
}
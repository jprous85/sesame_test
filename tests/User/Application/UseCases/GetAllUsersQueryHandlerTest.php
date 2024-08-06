<?php

declare(strict_types=1);


namespace App\Tests\User\Application\UseCases;


use App\Shared\Domain\QueryHandlerInterface;
use App\Tests\User\Domain\UserMother;
use App\User\Application\Response\UserResponse;
use App\User\Application\Response\UserResponses;
use App\User\Application\UseCases\GetAllUsersQuery;
use App\User\Application\UseCases\GetAllUsersQueryHandler;
use App\User\Domain\UserRepository;
use Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class GetAllUsersQueryHandlerTest extends TestCase
{
    private MockObject|UserRepository $userRepository;
    private GetAllUsersQueryHandler   $getUserByUuidQueryHandler;

    protected function setUp(): void
    {
        $this->userRepository            = $this->createMock(UserRepository::class);
        $this->getUserByUuidQueryHandler = new GetAllUsersQueryHandler($this->userRepository);
    }

    /**
     * @test
     * @return void
     * @throws Exception
     */
    public function ensureIsInstanceOf(): void
    {
        $this->assertInstanceOf(GetAllUsersQueryHandler::class, $this->getUserByUuidQueryHandler);
        $this->assertInstanceOf(QueryHandlerInterface::class, $this->getUserByUuidQueryHandler);
    }

    /**
     * @test
     * return_correct_data
     * @throws Exception
     */
    public function isShouldReturnCorrectData(): void
    {
        $user1 = UserMother::random();
        $user2 = UserMother::random();

        $userResponse1 = UserResponse::userResponseMapper($user1);
        $userResponse2 = UserResponse::userResponseMapper($user2);

        $userResponses = new UserResponses($userResponse1, $userResponse2);

        $this->userRepository
            ->expects(self::once())
            ->method('getAllUsers')
            ->willReturn([$user1, $user2]);

        $result = ($this->getUserByUuidQueryHandler)(new GetAllUsersQuery());

        $this->assertEquals($result, $userResponses->toArray());
    }
}
<?php

declare(strict_types=1);


namespace App\Tests\User\Application\UseCases;


use App\Tests\User\Domain\UserMother;
use App\Tests\User\Domain\ValueObjects\UserUuidVOMother;
use App\User\Application\Request\UserUuidRequest;
use App\User\Application\UseCases\GetUserByUuidQuery;
use Exception;
use PHPUnit\Framework\TestCase;

final class GetUserByUuidQueryTest extends TestCase
{
    /**
     * @test
     * @return void
     * @throws Exception
     */
    public function ensureIsInstanceOf(): void
    {
        $getUserByUuidQuery = new GetUserByUuidQuery(
            new UserUuidRequest(UserUuidVOMother::random()->uuid())
        );

        $this->assertInstanceOf(GetUserByUuidQuery::class, $getUserByUuidQuery);
    }

    /**
     * @throws Exception
     */
    public function ensureHasCorrectData(): void
    {
        $user = UserMother::random();

        $getUserByUuidQuery = new GetUserByUuidQuery(
            new UserUuidRequest($user->getUuid()->uuid())
        );

        $this->assertEquals($getUserByUuidQuery->getUuid(), $user->getUuid()->uuid());
    }
}
<?php

declare(strict_types=1);


namespace App\Tests\User\Application\UseCases;

use App\User\Application\UseCases\GetAllUsersQuery;
use Exception;
use PHPUnit\Framework\TestCase;

final class GetAllUsersQueryTest extends TestCase
{
    /**
     * @test
     * @return void
     * @throws Exception
     */
    public function ensureIsInstanceOf(): void
    {
        $getUserByUuidQuery = new GetAllUsersQuery();

        $this->assertInstanceOf(GetAllUsersQuery::class, $getUserByUuidQuery);
    }
}
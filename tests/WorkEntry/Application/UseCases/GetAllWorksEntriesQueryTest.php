<?php

declare(strict_types=1);


namespace App\Tests\WorkEntry\Application\UseCases;


use App\WorkEntry\Application\UseCases\GetAllWorksEntriesQuery;
use Exception;
use PHPUnit\Framework\TestCase;

final class GetAllWorksEntriesQueryTest extends TestCase
{
    /**
     * @test
     * @return void
     * @throws Exception
     */
    public function ensureIsInstanceOf(): void
    {
        $getUserByUuidQuery = new GetAllWorksEntriesQuery();

        $this->assertInstanceOf(GetAllWorksEntriesQuery::class, $getUserByUuidQuery);
    }
}
<?php

declare(strict_types=1);


namespace App\Tests\WorkEntry\Application\UseCases;


use App\Tests\WorkEntry\Domain\ValueObjects\WorkEntryUuidVOMother;
use App\Tests\WorkEntry\Domain\WorkEntryMother;
use App\WorkEntry\Application\Request\WorkEntryUuidRequest;
use App\WorkEntry\Application\UseCases\GetWorkEntryByUuidQuery;
use Exception;
use PHPUnit\Framework\TestCase;

final class GetWorkEntryByUuidQueryTest extends TestCase
{

    /**
     * @test
     * @return void
     * @throws Exception
     */
    public function ensureIsInstanceOf(): void
    {
        $getWorkEntryByUuidQuery = new GetWorkEntryByUuidQuery(
            new WorkEntryUuidRequest(WorkEntryUuidVOMother::random()->uuid())
        );

        $this->assertInstanceOf(GetWorkEntryByUuidQuery::class, $getWorkEntryByUuidQuery);
    }

    /**
     * @throws Exception
     */
    public function ensureHasCorrectData(): void
    {
        $workEntry = WorkEntryMother::random();

        $getWorkEntryByUuidQuery = new GetWorkEntryByUuidQuery(
            new WorkEntryUuidRequest($workEntry->getUuid()->uuid())
        );

        $this->assertEquals($getWorkEntryByUuidQuery->getUuid(), $workEntry->getUuid()->uuid());
    }
}
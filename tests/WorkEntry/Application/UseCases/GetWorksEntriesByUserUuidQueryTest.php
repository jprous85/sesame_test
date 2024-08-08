<?php

declare(strict_types=1);


namespace App\Tests\WorkEntry\Application\UseCases;


use App\Tests\WorkEntry\Domain\ValueObjects\WorkEntryUserUuidVOMother;
use App\Tests\WorkEntry\Domain\WorkEntryMother;
use App\WorkEntry\Application\Request\WorkEntryUuidRequest;
use App\WorkEntry\Application\UseCases\GetWorksEntriesByUserUuidQuery;
use Exception;
use PHPUnit\Framework\TestCase;

final class GetWorksEntriesByUserUuidQueryTest extends TestCase
{

    /**
     * @test
     * @return void
     * @throws Exception
     */
    public function ensureIsInstanceOf(): void
    {
        $workEntryByUserUuidQuery = new GetWorksEntriesByUserUuidQuery(
            new WorkEntryUuidRequest(WorkEntryUserUuidVOMother::random()->uuid())
        );

        $this->assertInstanceOf(GetWorksEntriesByUserUuidQuery::class, $workEntryByUserUuidQuery);
    }

    /**
     * @throws Exception
     */
    public function ensureHasCorrectData(): void
    {
        $workEntry = WorkEntryMother::random();

        $getWorkEntryByUserUuidQuery = new GetWorksEntriesByUserUuidQuery(
            new WorkEntryUuidRequest($workEntry->getUuid()->uuid())
        );

        $this->assertEquals($getWorkEntryByUserUuidQuery->getUuid(), $workEntry->getUuid()->uuid());
    }
}
<?php

declare(strict_types=1);


namespace App\Tests\WorkEntry\Application\UseCases;


use App\Tests\WorkEntry\Domain\ValueObjects\WorkEntryUserUuidVOMother;
use App\Tests\WorkEntry\Domain\WorkEntryMother;
use App\WorkEntry\Application\Request\WorkEntryUserUuidRequest;
use App\WorkEntry\Application\UseCases\GetWorkEntryByUserUuidQuery;
use Exception;
use PHPUnit\Framework\TestCase;

final class GetWorkEntryByUserUuidQueryTest extends TestCase
{

    /**
     * @test
     * @return void
     * @throws Exception
     */
    public function ensureIsInstanceOf(): void
    {
        $workEntryByUserUuidQuery = new GetWorkEntryByUserUuidQuery(
            new WorkEntryUserUuidRequest(WorkEntryUserUuidVOMother::random()->uuid())
        );

        $this->assertInstanceOf(GetWorkEntryByUserUuidQuery::class, $workEntryByUserUuidQuery);
    }

    /**
     * @throws Exception
     */
    public function ensureHasCorrectData(): void
    {
        $workEntry = WorkEntryMother::random();

        $getWorkEntryByUserUuidQuery = new GetWorkEntryByUserUuidQuery(
            new WorkEntryUserUuidRequest($workEntry->getUuid()->uuid())
        );

        $this->assertEquals($getWorkEntryByUserUuidQuery->getUuid(), $workEntry->getUuid()->uuid());
    }
}
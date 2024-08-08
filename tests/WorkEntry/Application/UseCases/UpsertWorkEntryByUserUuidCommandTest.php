<?php

declare(strict_types=1);


namespace App\Tests\WorkEntry\Application\UseCases;


use App\Tests\WorkEntry\Domain\ValueObjects\WorkEntryUserUuidVOMother;
use App\Tests\WorkEntry\Domain\ValueObjects\WorkEntryUuidVOMother;
use App\Tests\WorkEntry\Domain\WorkEntryMother;
use App\WorkEntry\Application\Request\WorkEntryUuidAndUserUuidRequest;
use App\WorkEntry\Application\UseCases\UpsertWorkEntryByUserUuidCommand;
use PHPUnit\Framework\TestCase;
use Exception;

final class UpsertWorkEntryByUserUuidCommandTest extends TestCase
{

    /**
     * @test
     * @return void
     * @throws Exception
     */
    public function ensureIsInstanceOf(): void
    {
        $upsertWorkEntryByUserUuidCommand = new UpsertWorkEntryByUserUuidCommand(
            new WorkEntryUuidAndUserUuidRequest(
                WorkEntryUuidVOMother::random()->uuid(),
                WorkEntryUserUuidVOMother::random()->uuid()
            )
        );

        $this->assertInstanceOf(UpsertWorkEntryByUserUuidCommand::class, $upsertWorkEntryByUserUuidCommand);
    }

    /**
     * @throws Exception
     */
    public function ensureHasCorrectData(): void
    {
        $workEntry = WorkEntryMother::random();

        $upsertWorkEntryByUserUuidCommand = new UpsertWorkEntryByUserUuidCommand(
            new WorkEntryUuidAndUserUuidRequest(
                $workEntry->getUuid()->uuid(),
                $workEntry->getUserUuid()->uuid()
            )
        );

        $this->assertEquals($upsertWorkEntryByUserUuidCommand->getUuid(), $workEntry->getUuid()->uuid());
    }
}
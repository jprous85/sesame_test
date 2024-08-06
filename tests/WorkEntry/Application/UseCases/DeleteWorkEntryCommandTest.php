<?php

declare(strict_types=1);


namespace App\Tests\WorkEntry\Application\UseCases;


use App\Tests\WorkEntry\Domain\ValueObjects\WorkEntryUuidVOMother;
use App\Tests\WorkEntry\Domain\WorkEntryMother;
use App\WorkEntry\Application\Request\WorkEntryUuidRequest;
use App\WorkEntry\Application\UseCases\DeleteWorkEntryCommand;
use Exception;
use PHPUnit\Framework\TestCase;

final class DeleteWorkEntryCommandTest extends TestCase
{
    /**
     * @test
     * @return void
     * @throws Exception
     */
    public function ensureIsInstanceOf(): void
    {
        $deleteWorkEntryCommand = new DeleteWorkEntryCommand(
            new WorkEntryUuidRequest(WorkEntryUuidVOMother::random()->uuid())
        );

        $this->assertInstanceOf(DeleteWorkEntryCommand::class, $deleteWorkEntryCommand);
    }

    /**
     * @test
     * @throws Exception
     */
    public function ensureHasCorrectData(): void
    {
        $workEntry = WorkEntryMother::random();

        $deleteWorkEntryCommand = new DeleteWorkEntryCommand(
            new WorkEntryUuidRequest($workEntry->getUuid()->uuid())
        );

        $this->assertEquals($deleteWorkEntryCommand->getUuid(), $workEntry->getUuid()->uuid());
    }
}
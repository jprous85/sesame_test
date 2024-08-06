<?php

declare(strict_types=1);


namespace App\Tests\WorkEntry\Application\UseCases;


use App\Tests\WorkEntry\Domain\WorkEntryMother;
use App\WorkEntry\Application\Request\UpdateWorkEntryRequest;
use App\WorkEntry\Application\UseCases\UpdateWorkEntryCommand;
use Exception;
use PHPUnit\Framework\TestCase;

final class UpdateWorkEntryCommandTest extends TestCase
{
    /**
     * @test
     * @return void
     * @throws Exception
     */
    public function ensureIsInstanceOf(): void
    {
        $updateWorkEntryCommand = new UpdateWorkEntryCommand(
            new UpdateWorkEntryRequest(
                '',
                '',
                ''
            )
        );
        $this->assertInstanceOf(UpdateWorkEntryCommand::class, $updateWorkEntryCommand);
    }

    /**
     * @test
     * return_correct_data
     * @throws Exception
     */
    public function isShouldReturnCorrectData()
    {
        $workEntry = WorkEntryMother::random();
        $updateWorkEntryRequest = new UpdateWorkEntryRequest(
            $workEntry->getUuid()->uuid(),
            $workEntry->getStartDate()->value()->format('Y-m-d h:i'),
            $workEntry->getEndDate()->value()->format('Y-m-d h:i'),
        );

        $updateWorkEntryCommand = new UpdateWorkEntryCommand($updateWorkEntryRequest);

        $this->assertEquals($updateWorkEntryCommand->getUuid(), $workEntry->getUuid()->uuid());
        $this->assertEquals($updateWorkEntryCommand->getStartDate(), $workEntry->getStartDate()->value()->format('Y-m-d h:i'));
        $this->assertEquals($updateWorkEntryCommand->getEndDate(), $workEntry->getEndDate()->value()->format('Y-m-d h:i'));
    }
}
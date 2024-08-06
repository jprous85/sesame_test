<?php

declare(strict_types=1);


namespace App\Tests\WorkEntry\Application\UseCases;


use App\Tests\WorkEntry\Domain\WorkEntryMother;
use App\WorkEntry\Application\Request\CreateWorkEntryRequest;
use App\WorkEntry\Application\UseCases\CreateWorkEntryCommand;
use Exception;
use PHPUnit\Framework\TestCase;

final class CreateWorkEntryCommandTest extends TestCase
{
    /**
     * @test
     * @return void
     * @throws Exception
     */
    public function ensureIsInstanceOf(): void
    {
        $workEntryCommand = new CreateWorkEntryCommand(
            new CreateWorkEntryRequest(
                '',
                '',
            )
        );
        $this->assertInstanceOf(CreateWorkEntryCommand::class, $workEntryCommand);
    }

    /**
     * @test
     * return_correct_data
     * @throws Exception
     */
    public function isShouldReturnCorrectData()
    {
        $workEntry = WorkEntryMother::random();

        $createWorkEntryRequest = new CreateWorkEntryRequest(
            $workEntry->getUuid()->uuid(),
            $workEntry->getUserUuid()->uuid()
        );

        $createWorkEntryCommand = new CreateWorkEntryCommand($createWorkEntryRequest);

        $this->assertEquals($createWorkEntryCommand->getUuid(), $workEntry->getUuid()->uuid());
        $this->assertEquals($createWorkEntryCommand->getUserUuid(), $workEntry->getUserUuid()->uuid());
    }

}
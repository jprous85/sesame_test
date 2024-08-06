<?php

declare(strict_types=1);


namespace App\Tests\WorkEntry\Application\UseCases;


use App\Shared\Domain\CommandHandlerInterface;
use App\Tests\WorkEntry\Domain\WorkEntryMother;
use App\WorkEntry\Application\Request\CreateWorkEntryRequest;
use App\WorkEntry\Application\UseCases\CreateWorkEntryCommand;
use App\WorkEntry\Application\UseCases\CreateWorkEntryCommandHandler;
use App\WorkEntry\Domain\WorkEntryRepository;
use Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class CreateWorkEntryCommandHandlerTest  extends TestCase
{

    private MockObject|WorkEntryRepository $workEntryRepository;
    private CreateWorkEntryCommandHandler  $createWorkEntryCommandHandler;

    protected function setUp(): void
    {
        $this->workEntryRepository = $this->createMock(WorkEntryRepository::class);
        $this->createWorkEntryCommandHandler = new CreateWorkEntryCommandHandler($this->workEntryRepository);
    }

    /**
     * @test
     * @return void
     * @throws Exception
     */
    public function ensureIsInstanceOf(): void
    {
        $this->assertInstanceOf(CreateWorkEntryCommandHandler::class, $this->createWorkEntryCommandHandler);
        $this->assertInstanceOf(CommandHandlerInterface::class, $this->createWorkEntryCommandHandler);
    }

    /**
     * @test
     * created_successfully
     * @throws Exception
     */
    public function isShouldCreatedSuccessfully ()
    {
        $workEntry = WorkEntryMother::random();
        $createWorkEntryRequest = new CreateWorkEntryRequest(
            $workEntry->getUuid()->uuid(),
            $workEntry->getUserUuid()->uuid()
        );

        $this->workEntryRepository
            ->expects(self::once())
            ->method('save');

        $createWorkEntryCommand = new CreateWorkEntryCommand($createWorkEntryRequest);
        ($this->createWorkEntryCommandHandler)($createWorkEntryCommand);
    }
}
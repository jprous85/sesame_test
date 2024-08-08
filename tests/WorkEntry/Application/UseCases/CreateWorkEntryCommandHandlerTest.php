<?php

declare(strict_types=1);


namespace App\Tests\WorkEntry\Application\UseCases;


use App\Shared\Domain\CommandHandlerInterface;
use App\Tests\WorkEntry\Domain\WorkEntryMother;
use App\WorkEntry\Application\Request\CreateWorkEntryRequest;
use App\WorkEntry\Application\UseCases\CreateWorkEntryCommand;
use App\WorkEntry\Application\UseCases\CreateWorkEntryCommandHandler;
use App\WorkEntry\Domain\WorkEntryAlreadyExistException;
use App\WorkEntry\Domain\WorkEntryRepository;
use Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

final class CreateWorkEntryCommandHandlerTest  extends TestCase
{

    private MockObject|WorkEntryRepository $workEntryRepository;
    private MockObject|EventDispatcherInterface $eventDispatcher;
    private CreateWorkEntryCommandHandler  $createWorkEntryCommandHandler;

    protected function setUp(): void
    {
        $this->workEntryRepository = $this->createMock(WorkEntryRepository::class);
        $this->eventDispatcher = $this->createMock(EventDispatcherInterface::class);
        $this->createWorkEntryCommandHandler = new CreateWorkEntryCommandHandler($this->workEntryRepository, $this->eventDispatcher);
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
     * throw_error_if_work_entry_is_already_exist
     * @throws Exception
     */
    public function isShouldThrowErrorIfWorkEntryIsAlreadyExist ()
    {
        $workEntry = WorkEntryMother::random();

        $this->expectException(WorkEntryAlreadyExistException::class);
        $this->workEntryRepository
            ->expects(self::once())
            ->method('getWorkEntryByUserUuid')
            ->willReturn($workEntry);

        $this->workEntryRepository
            ->expects(self::never())
            ->method('save');

        $this->eventDispatcher
            ->expects(self::never())
            ->method('dispatch');

        $workEntry = WorkEntryMother::random();
        $createWorkEntryRequest = new CreateWorkEntryRequest(
            $workEntry->getUuid()->uuid(),
            $workEntry->getUserUuid()->uuid()
        );

        $createWorkEntryCommand = new CreateWorkEntryCommand($createWorkEntryRequest);
        ($this->createWorkEntryCommandHandler)($createWorkEntryCommand);
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

        $this->eventDispatcher
            ->expects(self::once())
            ->method('dispatch');

        $createWorkEntryCommand = new CreateWorkEntryCommand($createWorkEntryRequest);
        ($this->createWorkEntryCommandHandler)($createWorkEntryCommand);
    }
}
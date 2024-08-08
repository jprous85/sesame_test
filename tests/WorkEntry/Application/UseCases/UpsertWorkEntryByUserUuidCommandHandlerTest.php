<?php

declare(strict_types=1);


namespace App\Tests\WorkEntry\Application\UseCases;


use App\Shared\Domain\CommandHandlerInterface;
use App\Tests\WorkEntry\Domain\WorkEntryMother;
use App\WorkEntry\Application\Request\WorkEntryUuidAndUserUuidRequest;
use App\WorkEntry\Application\UseCases\UpsertWorkEntryByUserUuidCommand;
use App\WorkEntry\Application\UseCases\UpsertWorkEntryByUserUuidCommandHandler;
use App\WorkEntry\Domain\WorkEntryRepository;
use Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

final class UpsertWorkEntryByUserUuidCommandHandlerTest extends TestCase
{
    private MockObject|WorkEntryRepository          $workEntryRepository;
    private MockObject|EventDispatcherInterface     $eventDispatcher;
    private UpsertWorkEntryByUserUuidCommandHandler $upsertWorkEntryByUserUuidCommandHandler;

    protected function setUp(): void
    {
        $this->workEntryRepository = $this->createMock(WorkEntryRepository::class);
        $this->eventDispatcher     = $this->createMock(EventDispatcherInterface::class);

        $this->upsertWorkEntryByUserUuidCommandHandler = new UpsertWorkEntryByUserUuidCommandHandler($this->workEntryRepository, $this->eventDispatcher);
    }

    /**
     * @test
     * @return void
     * @throws Exception
     */
    public function ensureIsInstanceOf(): void
    {
        $this->assertInstanceOf(UpsertWorkEntryByUserUuidCommandHandler::class, $this->upsertWorkEntryByUserUuidCommandHandler);
        $this->assertInstanceOf(CommandHandlerInterface::class, $this->upsertWorkEntryByUserUuidCommandHandler);
    }

    /**
     * @test
     * create_work_entry_if_does_not_exist
     * @throws Exception
     */
    public function isShouldCreateWorkEntryIfDoesNotExist ()
    {
        $this->workEntryRepository
            ->expects(self::once())
            ->method('getWorkEntryByUserUuid');

        $this->workEntryRepository
            ->expects(self::once())
            ->method('save');

        $this->eventDispatcher
            ->expects(self::once())
            ->method('dispatch');

        $workEntry = WorkEntryMother::random();

        $upsertWorkEntryByUserUuidCommand = new UpsertWorkEntryByUserUuidCommand(
            new WorkEntryUuidAndUserUuidRequest(
                $workEntry->getUuid()->uuid(),
                $workEntry->getUserUuid()->uuid()
            )
        );
        ($this->upsertWorkEntryByUserUuidCommandHandler)($upsertWorkEntryByUserUuidCommand);
    }

    /**
     * @test
     * create_work_entry_if_does_not_exist
     * @throws Exception
     */
    public function isShouldUpdateWorkEntryIfExist ()
    {
        $workEntry = WorkEntryMother::random();

        $this->workEntryRepository
            ->expects(self::once())
            ->method('getWorkEntryByUserUuid')
            ->willReturn($workEntry);

        $this->workEntryRepository
            ->expects(self::once())
            ->method('update');

        $this->eventDispatcher
            ->expects(self::once())
            ->method('dispatch');

        $upsertWorkEntryByUserUuidCommand = new UpsertWorkEntryByUserUuidCommand(
            new WorkEntryUuidAndUserUuidRequest(
                $workEntry->getUuid()->uuid(),
                $workEntry->getUserUuid()->uuid()
            )
        );
        ($this->upsertWorkEntryByUserUuidCommandHandler)($upsertWorkEntryByUserUuidCommand);
    }

}
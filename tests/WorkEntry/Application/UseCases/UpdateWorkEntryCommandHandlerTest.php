<?php

declare(strict_types=1);


namespace App\Tests\WorkEntry\Application\UseCases;


use App\Shared\Domain\CommandHandlerInterface;
use App\Tests\WorkEntry\Domain\WorkEntryMother;
use App\User\Application\Request\UpdateUserRequest;
use App\User\Application\UseCases\UpdateUserCommand;
use App\User\Domain\UserNotFoundException;
use App\WorkEntry\Application\Request\UpdateWorkEntryRequest;
use App\WorkEntry\Application\UseCases\UpdateWorkEntryCommand;
use App\WorkEntry\Application\UseCases\UpdateWorkEntryCommandHandler;
use App\WorkEntry\Domain\WorkEntryNotFoundException;
use App\WorkEntry\Domain\WorkEntryRepository;
use Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

final class UpdateWorkEntryCommandHandlerTest extends TestCase
{
    private MockObject|WorkEntryRepository      $workEntryRepository;
    private MockObject|EventDispatcherInterface $eventDispatcher;
    private UpdateWorkEntryCommandHandler       $updateWorkEntryCommandHandler;

    protected function setUp(): void
    {
        $this->workEntryRepository = $this->createMock(WorkEntryRepository::class);
        $this->eventDispatcher = $this->createMock(EventDispatcherInterface::class);
        $this->updateWorkEntryCommandHandler = new UpdateWorkEntryCommandHandler($this->workEntryRepository, $this->eventDispatcher);
    }

    /**
     * @test
     * @return void
     * @throws Exception
     */
    public function ensureIsInstanceOf(): void
    {
        $this->assertInstanceOf(UpdateWorkEntryCommandHandler::class, $this->updateWorkEntryCommandHandler);
        $this->assertInstanceOf(CommandHandlerInterface::class, $this->updateWorkEntryCommandHandler);
    }

    /**
     * @test
     * throw_error_if_user_does_not_exist
     * @throws Exception
     */
    public function isShouldThrowErrorIfUserDoesNotExist()
    {
        $this->expectException(WorkEntryNotFoundException::class);
        $this->workEntryRepository
            ->method('getWorkEntryByUuid')
            ->willThrowException(throw new WorkEntryNotFoundException());

        $this->workEntryRepository
            ->expects(self::never())
            ->method('update');

        $this->eventDispatcher
            ->expects(self::never())
            ->method('dispatch');

        $updateUserRequest = new UpdateWorkEntryRequest(
            '',
            '',
            '',
        );
        $updateUserCommand = new UpdateWorkEntryCommand($updateUserRequest);

        ($this->updateWorkEntryCommandHandler)($updateUserCommand);
    }

    /**
     * @test
     * update_successfully_user_data
     * @throws Exception
     */
    public function isShouldUpdateSuccessfullyUserData()
    {
        $workEntry        = WorkEntryMother::random();
        $workEntryUpdated = WorkEntryMother::random();

        $this->workEntryRepository
            ->expects(self::once())
            ->method('getWorkEntryByUuid')
            ->willReturn($workEntry);

        $this->workEntryRepository
            ->expects(self::once())
            ->method('update');

        $this->eventDispatcher
            ->expects(self::once())
            ->method('dispatch');

        $updateUserRequest = new UpdateWorkEntryRequest(
            $workEntry->getUuid()->uuid(),
            $workEntryUpdated->getStartDate()->value()->format('Y-m-d h:i'),
            $workEntryUpdated->getEndDate()->value()->format('Y-m-d h:i'),
        );
        $updateUserCommand = new UpdateWorkEntryCommand($updateUserRequest);

        ($this->updateWorkEntryCommandHandler)($updateUserCommand);
    }

}
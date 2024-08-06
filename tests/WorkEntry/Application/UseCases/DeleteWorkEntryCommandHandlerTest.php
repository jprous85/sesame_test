<?php

declare(strict_types=1);


namespace App\Tests\WorkEntry\Application\UseCases;


use App\Shared\Domain\CommandHandlerInterface;
use App\WorkEntry\Application\Request\WorkEntryUuidRequest;
use App\WorkEntry\Application\UseCases\DeleteWorkEntryCommand;
use App\WorkEntry\Application\UseCases\DeleteWorkEntryCommandHandler;
use App\WorkEntry\Domain\WorkEntryNotFoundException;
use App\WorkEntry\Domain\WorkEntryRepository;
use Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

final class DeleteWorkEntryCommandHandlerTest  extends TestCase
{

    private MockObject|WorkEntryRepository $workEntryRepository;
    private DeleteWorkEntryCommandHandler  $deleteWorkEntryCommandHandler;

    protected function setUp(): void
    {
        $this->workEntryRepository           = $this->createMock(WorkEntryRepository::class);
        $this->deleteWorkEntryCommandHandler = new DeleteWorkEntryCommandHandler($this->workEntryRepository);
    }

    /**
     * @test
     * @return void
     * @throws Exception
     */
    public function ensureIsInstanceOf(): void
    {
        $this->assertInstanceOf(DeleteWorkEntryCommandHandler::class, $this->deleteWorkEntryCommandHandler);
        $this->assertInstanceOf(CommandHandlerInterface::class, $this->deleteWorkEntryCommandHandler);
    }

    /**
     * @test
     * throw_error_if_user_does_not_exist
     * @throws Exception
     */
    public function isShouldThrowErrorIfUserDoesNotExist ()
    {
        $this->expectException(WorkEntryNotFoundException::class);
        $this->workEntryRepository
            ->method('getWorkEntryByUuid')
            ->willThrowException(throw new WorkEntryNotFoundException());

        $this->workEntryRepository
            ->expects(self::never())
            ->method('delete');

        $deleteUserCommand = new DeleteWorkEntryCommand(
            new WorkEntryUuidRequest('')
        );
        ($this->deleteWorkEntryCommandHandler)($deleteUserCommand);
    }
}
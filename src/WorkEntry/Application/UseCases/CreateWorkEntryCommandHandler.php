<?php

declare(strict_types=1);


namespace App\WorkEntry\Application\UseCases;


use App\Shared\Domain\CommandHandlerInterface;
use App\WorkEntry\Domain\ValueObjects\WorkEntryUserUuidVO;
use App\WorkEntry\Domain\ValueObjects\WorkEntryUuidVO;
use App\WorkEntry\Domain\WorkEntry;
use App\WorkEntry\Domain\WorkEntryRepository;
use Exception;

final class CreateWorkEntryCommandHandler implements CommandHandlerInterface
{
    public function __construct(private readonly WorkEntryRepository $workEntryRepository)
    {
    }

    /**
     * @throws Exception
     */
    public function __invoke(CreateWorkEntryCommand $createWorkEntryCommand): void
    {
        $workEntry = WorkEntry::create(
            new WorkEntryUuidVO($createWorkEntryCommand->getUuid()),
            new WorkEntryUserUuidVO($createWorkEntryCommand->getUserUuid()),
        );

        $this->workEntryRepository->save($workEntry);
    }
}
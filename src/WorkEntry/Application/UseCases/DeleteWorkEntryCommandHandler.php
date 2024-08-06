<?php

declare(strict_types=1);


namespace App\WorkEntry\Application\UseCases;


use App\Shared\Domain\CommandHandlerInterface;
use App\WorkEntry\Domain\ValueObjects\WorkEntryUuidVO;
use App\WorkEntry\Domain\WorkEntryNotFoundException;
use App\WorkEntry\Domain\WorkEntryRepository;
use Exception;

final class DeleteWorkEntryCommandHandler implements CommandHandlerInterface
{
    public function __construct(private readonly WorkEntryRepository $workEntryRepository)
    {
    }

    /**
     * @throws Exception
     */
    public function __invoke(DeleteWorkEntryCommand $deleteWorkEntryCommand): void
    {
        $workEntry = $this->workEntryRepository->getWorkEntryByUuid(
            new WorkEntryUuidVO($deleteWorkEntryCommand->getUuid())
        );

        if (!$workEntry) {
            throw new WorkEntryNotFoundException();
        }

        $workEntry->delete();

        $this->workEntryRepository->delete($workEntry);
    }
}
<?php

declare(strict_types=1);


namespace App\WorkEntry\Application\UseCases;


use App\Shared\Domain\CommandHandlerInterface;
use App\WorkEntry\Domain\ValueObjects\WorkEntryUserUuidVO;
use App\WorkEntry\Domain\ValueObjects\WorkEntryUuidVO;
use App\WorkEntry\Domain\WorkEntry;
use App\WorkEntry\Domain\WorkEntryRepository;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;
use Exception;

final class UpsertWorkEntryByUserUuidCommandHandler implements CommandHandlerInterface
{
    public function __construct(
        private readonly WorkEntryRepository $workEntryRepository,
        private readonly EventDispatcherInterface $eventDispatcher
    )
    {
    }

    /**
     * @throws Exception
     */
    public function __invoke(UpsertWorkEntryByUserUuidCommand $upsertWorkEntryByUserUuidCommand): void
    {
        $existWorkEntry = $this->workEntryRepository->getWorkEntryByUserUuid(
            new WorkEntryUserUuidVO($upsertWorkEntryByUserUuidCommand->getUserUuid())
        );

        if (!$existWorkEntry) {
            $this->createWorkEntry($upsertWorkEntryByUserUuidCommand);
        } else {
            $this->updateWorkEntry($existWorkEntry);
        }
    }

    /**
     * @throws Exception
     */
    private function createWorkEntry(UpsertWorkEntryByUserUuidCommand $upsertWorkEntryByUserUuidCommand): void
    {
        $workEntry = WorkEntry::create(
            new WorkEntryUuidVO($upsertWorkEntryByUserUuidCommand->getUuid()),
            new WorkEntryUserUuidVO($upsertWorkEntryByUserUuidCommand->getUserUuid()),
        );

        $this->workEntryRepository->save($workEntry);
        $this->eventDispatcher->dispatch(...$workEntry->pullDomainEvents());
    }

    /**
     * @throws Exception
     */
    private function updateWorkEntry(WorkEntry $workEntry)
    {
        $workEntry->finishDate();

        $this->workEntryRepository->update($workEntry);
        $this->eventDispatcher->dispatch(...$workEntry->pullDomainEvents());
    }
}
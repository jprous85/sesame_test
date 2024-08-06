<?php

declare(strict_types=1);


namespace App\WorkEntry\Application\UseCases;


use App\Shared\Domain\CommandHandlerInterface;
use App\Shared\Infrastructure\Services\DateTimeService;
use App\WorkEntry\Domain\ValueObjects\WorkEntryEndDateVO;
use App\WorkEntry\Domain\ValueObjects\WorkEntryStartDateVO;
use App\WorkEntry\Domain\ValueObjects\WorkEntryUuidVO;
use App\WorkEntry\Domain\WorkEntryNotFoundException;
use App\WorkEntry\Domain\WorkEntryRepository;
use Exception;
use Symfony\Contracts\EventDispatcher\EventDispatcherInterface;

final class UpdateWorkEntryCommandHandler implements CommandHandlerInterface
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
    public function __invoke(UpdateWorkEntryCommand $updateWorkEntryCommand): void
    {
        $workEntry = $this->workEntryRepository->getWorkEntryByUuid(
            new WorkEntryUuidVO($updateWorkEntryCommand->getUuid())
        );

        if (!$workEntry) {
            throw new WorkEntryNotFoundException();
        }

        $workEntry->update(
            new WorkEntryStartDateVO(DateTimeService::timeToTimeStamp($updateWorkEntryCommand->getStartDate())),
            new WorkEntryEndDateVO(DateTimeService::timeToTimeStamp($updateWorkEntryCommand->getEndDate())),
        );

        $this->workEntryRepository->update($workEntry);

        $this->eventDispatcher->dispatch(...$workEntry->pullDomainEvents());
    }
}
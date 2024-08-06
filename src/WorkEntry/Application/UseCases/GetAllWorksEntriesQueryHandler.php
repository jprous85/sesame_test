<?php

declare(strict_types=1);


namespace App\WorkEntry\Application\UseCases;


use App\Shared\Domain\QueryHandlerInterface;
use App\WorkEntry\Application\Response\WorkEntryResponse;
use App\WorkEntry\Domain\WorkEntry;
use App\WorkEntry\Domain\WorkEntryRepository;

final class GetAllWorksEntriesQueryHandler implements QueryHandlerInterface
{
    public function __construct(private readonly WorkEntryRepository $workEntryRepository)
    {
    }

    public function __invoke(GetAllWorksEntriesQuery $allWorksEntriesQuery): array
    {
        return $this->map($this->workEntryRepository->getAllWorksEntries());
    }

    private function map(array $worksEntries): array
    {
        $worksEntriesResponses = [];

        /**
         * @var WorkEntry $workEntry
         */
        foreach ($worksEntries as $workEntry) {
            $worksEntriesResponses[] = WorkEntryResponse::workEntryResponseMapper($workEntry)->toArray();
        }
        return $worksEntriesResponses;
    }
}
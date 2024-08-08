<?php

declare(strict_types=1);


namespace App\WorkEntry\Application\UseCases;


use App\Shared\Domain\QueryHandlerInterface;
use App\WorkEntry\Application\Response\WorkEntryResponse;
use App\WorkEntry\Domain\ValueObjects\WorkEntryUserUuidVO;
use App\WorkEntry\Domain\WorkEntry;
use App\WorkEntry\Domain\WorkEntryRepository;
use Exception;

final class GetWorksEntriesByUserUuidQueryHandler implements QueryHandlerInterface
{
    public function __construct(private readonly WorkEntryRepository $workEntryRepository)
    {
    }

    /**
     * @throws Exception
     */
    public function __invoke(GetWorksEntriesByUserUuidQuery $getWorksEntriesByUserUuidQuery): array
    {
        return $this->map($this->workEntryRepository->getWorksEntriesByUserUuid(
            new WorkEntryUserUuidVO($getWorksEntriesByUserUuidQuery->getUuid())
        ));
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
<?php

declare(strict_types=1);


namespace App\WorkEntry\Application\UseCases;


use App\Shared\Domain\QueryHandlerInterface;
use App\WorkEntry\Application\Response\WorkEntryResponse;
use App\WorkEntry\Domain\ValueObjects\WorkEntryUuidVO;
use App\WorkEntry\Domain\WorkEntryNotFoundException;
use App\WorkEntry\Domain\WorkEntryRepository;
use Exception;

final class GetWorkEntryByUuidQueryHandler implements QueryHandlerInterface
{
    public function __construct(private readonly WorkEntryRepository $workEntryRepository)
    {
    }

    /**
     * @throws Exception
     */
    public function __invoke(GetWorkEntryByUuidQuery $workEntryByUuidQuery): array
    {
        $workEntry = $this->workEntryRepository->getWorkEntryByUuid(
            new WorkEntryUuidVO($workEntryByUuidQuery->getUuid())
        );

        if (!$workEntry) {
            throw new WorkEntryNotFoundException();
        }

        return WorkEntryResponse::workEntryResponseMapper($workEntry)->toArray();
    }
}
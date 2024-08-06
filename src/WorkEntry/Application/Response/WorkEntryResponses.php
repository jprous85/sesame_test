<?php

declare(strict_types=1);

namespace App\WorkEntry\Application\Response;

final class WorkEntryResponses
{
    private array $workEntryResponses;

    public function __construct(WorkEntryResponse ...$workEntryResponses)
    {
        $this->workEntryResponses = $workEntryResponses;
    }

    public function getEntryResponses(): array
    {
        return $this->workEntryResponses;
    }

    public function toArray(): array
    {
        $workEntryResponseArray = [];
        foreach ($this->workEntryResponses as $workEntryResponse)
        {
            $workEntryResponseArray[] = $workEntryResponse->toArray();
        }
        return $workEntryResponseArray;
    }
}

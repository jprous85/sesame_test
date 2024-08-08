<?php

declare(strict_types=1);


namespace App\WorkEntry\Application\UseCases;


use App\WorkEntry\Application\Request\WorkEntryUuidRequest;

final class GetWorksEntriesByUserUuidQuery
{
    public function __construct(private readonly WorkEntryUuidRequest $uuidRequest)
    {
    }

    public function getUuid(): string
    {
        return $this->uuidRequest->getUuid();
    }
}
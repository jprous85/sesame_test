<?php

declare(strict_types=1);


namespace App\WorkEntry\Application\UseCases;


use App\WorkEntry\Application\Request\WorkEntryUserUuidRequest;

final class GetWorkEntryByUserUuidQuery
{
    public function __construct(private readonly WorkEntryUserUuidRequest $uuidRequest)
    {
    }

    public function getUuid(): string
    {
        return $this->uuidRequest->getUuid();
    }
}
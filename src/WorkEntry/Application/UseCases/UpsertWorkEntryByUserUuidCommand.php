<?php

declare(strict_types=1);


namespace App\WorkEntry\Application\UseCases;


use App\WorkEntry\Application\Request\WorkEntryUuidAndUserUuidRequest;

final class UpsertWorkEntryByUserUuidCommand
{
    public function __construct(private readonly WorkEntryUuidAndUserUuidRequest $uuidRequest)
    {
    }

    public function getUuid(): string
    {
        return $this->uuidRequest->getUuid();
    }

    public function getUserUuid(): string
    {
        return $this->uuidRequest->getUserUuid();
    }
}
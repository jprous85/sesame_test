<?php

declare(strict_types=1);


namespace App\WorkEntry\Application\UseCases;


use App\WorkEntry\Application\Request\WorkEntryUuidRequest;

final class DeleteWorkEntryCommand
{
    public function __construct(private readonly WorkEntryUuidRequest $entryUuid)
    {
    }

    public function getUuid(): string
    {
        return $this->entryUuid->getUuid();
    }
}
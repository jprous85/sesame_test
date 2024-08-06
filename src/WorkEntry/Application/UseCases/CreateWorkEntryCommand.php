<?php

declare(strict_types=1);


namespace App\WorkEntry\Application\UseCases;


use App\WorkEntry\Application\Request\CreateWorkEntryRequest;

final class CreateWorkEntryCommand
{
    public function __construct(private CreateWorkEntryRequest $createWorkEntryRequest)
    {
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->createWorkEntryRequest->getUuid();
    }

    /**
     * @return string
     */
    public function getUserUuid(): string
    {
        return $this->createWorkEntryRequest->getUserUuid();
    }
}
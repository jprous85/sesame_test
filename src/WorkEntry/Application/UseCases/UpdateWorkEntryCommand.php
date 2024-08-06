<?php

declare(strict_types=1);


namespace App\WorkEntry\Application\UseCases;


use App\WorkEntry\Application\Request\UpdateWorkEntryRequest;

final class UpdateWorkEntryCommand
{
    public function __construct(private UpdateWorkEntryRequest $updateWorkEntryRequest)
    {
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->updateWorkEntryRequest->getUuid();
    }

    /**
     * @return string
     */
    public function getStartDate(): string
    {
        return $this->updateWorkEntryRequest->getStartDate();
    }

    /**
     * @return string
     */
    public function getEndDate(): string
    {
        return $this->updateWorkEntryRequest->getEndDate();
    }
}
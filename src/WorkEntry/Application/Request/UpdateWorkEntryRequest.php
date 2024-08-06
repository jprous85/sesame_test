<?php

declare(strict_types=1);


namespace App\WorkEntry\Application\Request;


final class UpdateWorkEntryRequest
{
    public function __construct(
        private string $uuid,
        private string $startDate,
        private string $endDate,
    )
    {
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @return string
     */
    public function getStartDate(): string
    {
        return $this->startDate;
    }

    /**
     * @return string
     */
    public function getEndDate(): string
    {
        return $this->endDate;
    }
}
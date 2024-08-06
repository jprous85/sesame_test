<?php

declare(strict_types=1);


namespace App\WorkEntry\Application\Request;


final class WorkEntryUuidRequest
{
    public function __construct(private readonly string $uuid)
    {
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }
}
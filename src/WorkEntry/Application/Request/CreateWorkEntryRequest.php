<?php

declare(strict_types=1);


namespace App\WorkEntry\Application\Request;


final class CreateWorkEntryRequest
{
    public function __construct(
        private string $uuid,
        private string $userUuid
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
    public function getUserUuid(): string
    {
        return $this->userUuid;
    }
}
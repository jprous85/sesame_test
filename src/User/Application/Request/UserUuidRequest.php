<?php

declare(strict_types=1);


namespace App\User\Application\Request;


final class UserUuidRequest
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
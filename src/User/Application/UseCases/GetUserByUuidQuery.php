<?php

declare(strict_types=1);


namespace App\User\Application\UseCases;


use App\User\Application\Request\UserUuidRequest;

final class GetUserByUuidQuery
{
    public function __construct(private readonly UserUuidRequest $uuidRequest)
    {
    }

    public function getUuid(): string
    {
        return $this->uuidRequest->getUuid();
    }
}
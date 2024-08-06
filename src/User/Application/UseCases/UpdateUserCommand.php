<?php

declare(strict_types=1);


namespace App\User\Application\UseCases;


use App\User\Application\Request\UpdateUserRequest;

final class UpdateUserCommand
{
    public function __construct(private readonly UpdateUserRequest $request)
    {
    }

    public function uuid(): string
    {
        return $this->request->getUuid();
    }

    public function name(): string
    {
        return $this->request->getName();
    }

    public function email(): string
    {
        return $this->request->getEmail();
    }

    public function password(): string
    {
        return $this->request->getPassword();
    }
}
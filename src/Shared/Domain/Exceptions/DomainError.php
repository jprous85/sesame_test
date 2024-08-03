<?php

declare(strict_types=1);

namespace App\Shared\Domain\Exceptions;

use DomainException;
use Symfony\Component\HttpFoundation\Response;

abstract class DomainError extends DomainException
{

    public function __construct()
    {
        parent::__construct($this->errorMessage(), $this->errorCode());
    }

    protected function errorCode(): int
    {
        return Response::HTTP_INTERNAL_SERVER_ERROR;
    }

    abstract protected function errorMessage(): string;
}
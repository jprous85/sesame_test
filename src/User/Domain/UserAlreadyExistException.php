<?php

declare(strict_types=1);

namespace App\User\Domain;

use App\Shared\Domain\Exceptions\DomainError;

final class UserAlreadyExistException extends DomainError
{
    public function __construct(private readonly ?string $email = null)
    {
        parent::__construct();
    }

    protected function errorMessage(): string
    {
        if ($this->email) {
            return sprintf('This user with email <%s> is already exist', $this->email);
        }
        return 'User already exist';
    }
}
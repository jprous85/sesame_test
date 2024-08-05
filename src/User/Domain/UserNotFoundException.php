<?php

declare(strict_types=1);

namespace App\User\Domain;

use App\Shared\Domain\Exceptions\DomainError;

final class UserNotFoundException extends DomainError
{
    public function __construct(private readonly ?string $uuid = null)
    {
        parent::__construct();
    }

    protected function errorMessage(): string
    {
        if ($this->uuid) {
            return sprintf('User not fount with uuid <%s>', $this->uuid);
        }
        return 'User not found';
    }
}
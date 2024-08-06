<?php

declare(strict_types=1);

namespace App\WorkEntry\Domain;

use App\Shared\Domain\Exceptions\DomainError;

final class WorkEntryNotFoundException extends DomainError
{
    public function __construct(private readonly ?string $uuid = null)
    {
        parent::__construct();
    }

    protected function errorMessage(): string
    {
        if ($this->uuid) {
            return sprintf('Work entry not fount with uuid <%s>', $this->uuid);
        }
        return 'Work entry not found';
    }
}
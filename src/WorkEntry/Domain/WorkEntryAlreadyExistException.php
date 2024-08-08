<?php

declare(strict_types=1);

namespace App\WorkEntry\Domain;

use App\Shared\Domain\Exceptions\DomainError;

final class WorkEntryAlreadyExistException extends DomainError
{
    public function __construct(private readonly ?string $workEntryUuid = null)
    {
        parent::__construct();
    }

    protected function errorMessage(): string
    {
        if ($this->workEntryUuid) {
            return sprintf('This workEntry with uuid <%s> is already exist', $this->workEntryUuid);
        }
        return 'User already exist';
    }
}
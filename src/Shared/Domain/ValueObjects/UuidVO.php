<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObjects;

use Exception;

class UuidVO
{
    /**
     * @throws Exception
     */
    public function __construct(private readonly string $uuid)
    {
        $this->ensureIsUuidValue($this->uuid);
    }

    public function uuid(): string
    {
        return $this->uuid;
    }

    /**
     * @throws Exception
     */
    private function ensureIsUuidValue(string $uuid): void
    {
        if (preg_match('/^[0-9a-f]{8}-[0-9a-f]{4}-4[0-9a-f]{3}-[89ab][0-9a-f]{3}-[0-9a-f]{12}$/', $uuid) !== 1) {
            throw new Exception('no uuid correct format');
        }
    }
}
<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObjects;


abstract class EmailVO
{
    private string $value;

    public function __construct(string $value)
    {
        $this->ensureIsNotNull($value);
        $this->ensureThatStringNotBeMoreLengthThan255Chars($value);
        $this->ensureIsValidEmail($value);
        $this->value = $value;
    }

    private function ensureIsNotNull(string $value): void
    {
        if (!isset($value))
            throw new \InvalidArgumentException('This string is null');
    }

    private function ensureThatStringNotBeMoreLengthThan255Chars (string $value): void
    {
        if (strlen($value) > 255) {
            throw new \InvalidArgumentException('This string is too large');
        }
    }

    private function ensureIsValidEmail (string $value): void
    {
        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException('Bad email format: '. $value);
        }
    }

    public function value(): string
    {
        return $this->value;
    }
}

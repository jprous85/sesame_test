<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObjects;


abstract class IntegerOrNullVO
{
    private ?int $value;

    public function __construct(?int $value)
    {
        $this->value = $value;
    }

    public function value(): ?int
    {
        return $this->value;
    }
}

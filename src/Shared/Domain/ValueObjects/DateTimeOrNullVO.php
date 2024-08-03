<?php

declare(strict_types=1);

namespace App\Shared\Domain\ValueObjects;


use DateTime;

abstract class DateTimeOrNullVO
{
    private ?DateTime $value;

    public function __construct(?DateTime $value)
    {
        $this->value = $value;
    }

    public function value(): ?DateTime
    {
        return $this->value;
    }
}

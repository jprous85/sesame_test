<?php

declare(strict_types=1);

namespace App\Shared\Infrastructure\Services;

use DateTime;
use DateTimeImmutable;
use DateTimeZone;
use Exception;

final class DateTimeService
{
    /**
     * @throws Exception
     */
    public static function nowWithDateTimeFormat(): DateTime
    {
        return new DateTime('now', new DateTimeZone("Europe/Madrid"));
    }

    /**
     * @throws Exception
     */
    public static function now(): string
    {
        return (new DateTimeImmutable('now', new DateTimeZone("Europe/Madrid")))->format('Y-m-d H:i:s');
    }

    /**
     * @throws Exception
     */
    public static function addHours(int $hours = 24): string
    {
        $currentDate = new DateTimeImmutable('now', new DateTimeZone("Europe/Madrid"));
        $currentDateMore24Hours = $currentDate->modify("+$hours hours");

        return $currentDateMore24Hours->format('Y-m-d H:i:s');
    }

    /**
     * @throws Exception
     */
    public static function nowInMilliseconds(): string
    {
        return (new DateTimeImmutable('now', new DateTimeZone("Europe/Madrid")))->format('Uv');
    }
}
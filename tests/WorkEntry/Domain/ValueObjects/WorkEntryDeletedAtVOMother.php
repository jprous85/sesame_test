<?php

declare(strict_types=1);


namespace App\Tests\WorkEntry\Domain\ValueObjects;


use App\WorkEntry\Domain\ValueObjects\WorkEntryDeletedAtVO;
use DateTime;
use Exception;
use Faker\Factory;

final class WorkEntryDeletedAtVOMother
{
    private static function create(DateTime $value): WorkEntryDeletedAtVO
    {
        return new WorkEntryDeletedAtVO($value);
    }

    /**
     * @throws Exception
     */
    public static function random(): WorkEntryDeletedAtVO
    {
        $faker = Factory::create();
        return self::create(new DateTime($faker->date()));
    }
}
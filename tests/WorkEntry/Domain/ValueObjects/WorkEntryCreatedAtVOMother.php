<?php

declare(strict_types=1);


namespace App\Tests\WorkEntry\Domain\ValueObjects;


use App\WorkEntry\Domain\ValueObjects\WorkEntryCreatedAtVO;
use DateTime;
use Exception;
use Faker\Factory;

final class WorkEntryCreatedAtVOMother
{
    private static function create(DateTime $value): WorkEntryCreatedAtVO
    {
        return new WorkEntryCreatedAtVO($value);
    }

    /**
     * @throws Exception
     */
    public static function random(): WorkEntryCreatedAtVO
    {
        $faker = Factory::create();
        return self::create(new DateTime($faker->date()));
    }
}
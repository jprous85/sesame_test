<?php

declare(strict_types=1);


namespace App\Tests\WorkEntry\Domain\ValueObjects;


use App\WorkEntry\Domain\ValueObjects\WorkEntryUpdatedAtVO;
use DateTime;
use Exception;
use Faker\Factory;

final class WorkEntryUpdatedAtVOMother
{
    private static function create(DateTime $value): WorkEntryUpdatedAtVO
    {
        return new WorkEntryUpdatedAtVO($value);
    }

    /**
     * @throws Exception
     */
    public static function random(): WorkEntryUpdatedAtVO
    {
        $faker = Factory::create();
        return self::create(new DateTime($faker->date()));
    }
}
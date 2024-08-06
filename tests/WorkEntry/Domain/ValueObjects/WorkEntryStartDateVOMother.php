<?php

declare(strict_types=1);


namespace App\Tests\WorkEntry\Domain\ValueObjects;


use App\WorkEntry\Domain\ValueObjects\WorkEntryStartDateVO;
use DateTime;
use Exception;
use Faker\Factory;

final class WorkEntryStartDateVOMother
{
    private static function create(DateTime $value): WorkEntryStartDateVO
    {
        return new WorkEntryStartDateVO($value);
    }

    /**
     * @throws Exception
     */
    public static function random(): WorkEntryStartDateVO
    {
        $faker = Factory::create();
        return self::create(new DateTime($faker->date()));
    }
}
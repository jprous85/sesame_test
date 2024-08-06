<?php

declare(strict_types=1);


namespace App\Tests\WorkEntry\Domain\ValueObjects;


use App\WorkEntry\Domain\ValueObjects\WorkEntryEndDateVO;
use DateTime;
use Exception;
use Faker\Factory;

final class WorkEntryEndDateVOMother
{
    private static function create(DateTime $value): WorkEntryEndDateVO
    {
        return new WorkEntryEndDateVO($value);
    }

    /**
     * @throws Exception
     */
    public static function random(): WorkEntryEndDateVO
    {
        $faker = Factory::create();
        return self::create(new DateTime($faker->date()));
    }
}
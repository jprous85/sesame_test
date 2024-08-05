<?php

declare(strict_types=1);


namespace App\Tests\User\Domain\ValueObjects;


use App\User\Domain\ValueObjects\UserCreatedAtVO;
use DateTime;
use Exception;
use Faker\Factory;

final class UserCreatedAtVOMother
{
    public static function create(DateTime $value): UserCreatedAtVO
    {
        return new UserCreatedAtVO($value);
    }

    /**
     * @throws Exception
     */
    public static function random(): UserCreatedAtVO
    {
        $faker = Factory::create();
        return self::create(new DateTime($faker->date()));
    }
}
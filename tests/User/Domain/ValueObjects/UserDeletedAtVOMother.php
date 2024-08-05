<?php

declare(strict_types=1);


namespace App\Tests\User\Domain\ValueObjects;


use App\User\Domain\ValueObjects\UserDeletedAtVO;
use DateTime;
use Exception;
use Faker\Factory;

final class UserDeletedAtVOMother
{
    public static function create(DateTime  $value): UserDeletedAtVO
    {
        return new UserDeletedAtVO($value);
    }

    /**
     * @throws Exception
     */
    public static function random(): UserDeletedAtVO
    {
        $faker = Factory::create();
        return self::create(new DateTime($faker->date()));
    }
}
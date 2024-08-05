<?php

declare(strict_types=1);


namespace App\Tests\User\Domain\ValueObjects;


use App\User\Domain\ValueObjects\UserUpdatedAtVO;
use DateTime;
use Exception;
use Faker\Factory;

final class UserUpdatedAtVOMother
{
    public static function create(DateTime  $value): UserUpdatedAtVO
    {
        return new UserUpdatedAtVO($value);
    }

    /**
     * @throws Exception
     */
    public static function random(): UserUpdatedAtVO
    {
        $faker = Factory::create();
        return self::create(new DateTime($faker->date()));
    }
}
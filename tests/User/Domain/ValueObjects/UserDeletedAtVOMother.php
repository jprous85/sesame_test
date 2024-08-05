<?php

declare(strict_types=1);


namespace App\Tests\User\Domain\ValueObjects;


use App\User\Domain\ValueObjects\UserDeletedAtVO;
use Faker\Factory;

final class UserDeletedAtVOMother
{
    public static function create(string  $value): UserDeletedAtVO
    {
        return new UserDeletedAtVO($value);
    }

    public static function random(): UserDeletedAtVO
    {
        $faker = Factory::create();
        return self::create($faker->date);
    }
}
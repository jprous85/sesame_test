<?php

declare(strict_types=1);


namespace App\Tests\User\Domain\ValueObjects;


use App\User\Domain\ValueObjects\UserCreatedAtVO;
use Faker\Factory;

final class UserCreatedAtVOMother
{
    public static function create(string  $value): UserCreatedAtVO
    {
        return new UserCreatedAtVO($value);
    }

    public static function random(): UserCreatedAtVO
    {
        $faker = Factory::create();
        return self::create($faker->date);
    }
}
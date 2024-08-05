<?php

declare(strict_types=1);


namespace App\Tests\User\Domain\ValueObjects;


use App\User\Domain\ValueObjects\UserEmailVO;
use Faker\Factory;

final class UserEmailVOMother
{
    public static function create(string  $value): UserEmailVO
    {
        return new UserEmailVO($value);
    }

    public static function random(): UserEmailVO
    {
        $faker = Factory::create();
        return self::create($faker->email());
    }
}
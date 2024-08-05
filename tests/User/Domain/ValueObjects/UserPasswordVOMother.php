<?php

declare(strict_types=1);


namespace App\Tests\User\Domain\ValueObjects;


use App\User\Domain\ValueObjects\UserPasswordVO;
use Faker\Factory;

final class UserPasswordVOMother
{
    public static function create(string  $value): UserPasswordVO
    {
        return new UserPasswordVO($value);
    }

    public static function random(): UserPasswordVO
    {
        $faker = Factory::create();
        return self::create($faker->password());
    }
}
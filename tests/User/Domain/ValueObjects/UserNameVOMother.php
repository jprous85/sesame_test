<?php

declare(strict_types=1);


namespace App\Tests\User\Domain\ValueObjects;


use App\User\Domain\ValueObjects\UserNameVO;
use Faker\Factory;

final class UserNameVOMother
{
    public static function create(string  $value): UserNameVO
    {
        return new UserNameVO($value);
    }

    public static function random(): UserNameVO
    {
        $faker = Factory::create();
        return self::create($faker->name());
    }
}
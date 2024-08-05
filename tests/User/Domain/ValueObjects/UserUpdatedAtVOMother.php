<?php

declare(strict_types=1);


namespace App\Tests\User\Domain\ValueObjects;


use App\User\Domain\ValueObjects\UserUpdatedAtVO;
use Faker\Factory;

final class UserUpdatedAtVOMother
{
    public static function create(string  $value): UserUpdatedAtVO
    {
        return new UserUpdatedAtVO($value);
    }

    public static function random(): UserUpdatedAtVO
    {
        $faker = Factory::create();
        return self::create($faker->date);
    }
}
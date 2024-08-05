<?php

declare(strict_types=1);


namespace App\Tests\User\Domain\ValueObjects;


use App\User\Domain\ValueObjects\UserUuidVO;
use Exception;
use Faker\Factory;

final class UserUuidVOMother
{
    /**
     * @throws Exception
     */
    public static function create(string $value): UserUuidVO
    {
        return new UserUuidVO($value);
    }

    /**
     * @throws Exception
     */
    public static function random(): UserUuidVO
    {
        $faker = Factory::create();
        return self::create($faker->uuid);
    }
}
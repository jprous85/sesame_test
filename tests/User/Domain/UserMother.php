<?php

declare(strict_types=1);


namespace App\Tests\User\Domain;


use App\Tests\User\Domain\ValueObjects\UserCreatedAtVOMother;
use App\Tests\User\Domain\ValueObjects\UserDeletedAtVOMother;
use App\Tests\User\Domain\ValueObjects\UserEmailVOMother;
use App\Tests\User\Domain\ValueObjects\UserNameVOMother;
use App\Tests\User\Domain\ValueObjects\UserPasswordVOMother;
use App\Tests\User\Domain\ValueObjects\UserUpdatedAtVOMother;
use App\Tests\User\Domain\ValueObjects\UserUuidVOMother;
use App\User\Domain\User;
use App\User\Domain\ValueObjects\UserCreatedAtVO;
use App\User\Domain\ValueObjects\UserDeletedAtVO;
use App\User\Domain\ValueObjects\UserEmailVO;
use App\User\Domain\ValueObjects\UserNameVO;
use App\User\Domain\ValueObjects\UserPasswordVO;
use App\User\Domain\ValueObjects\UserUpdatedAtVO;
use App\User\Domain\ValueObjects\UserUuidVO;
use Exception;

final class UserMother
{
    private static function create(
        UserUuidVO      $uuid,
        UserNameVO      $name,
        UserEmailVO     $email,
        UserPasswordVO  $password,
        UserCreatedAtVO $created_at,
        UserUpdatedAtVO $updated_at,
        UserDeletedAtVO $deleted_at
    ): User
    {
        return new User(
            $uuid,
            $name,
            $email,
            $password,
            $created_at,
            $updated_at,
            $deleted_at
        );
    }

    /**
     * @throws Exception
     */
    public static function random(): User
    {
        return self::create(
            UserUuidVOMother::random(),
            UserNameVOMother::random(),
            UserEmailVOMother::random(),
            UserPasswordVOMother::random(),
            UserCreatedAtVOMother::random(),
            UserUpdatedAtVOMother::random(),
            UserDeletedAtVOMother::random(),
        );
    }
}
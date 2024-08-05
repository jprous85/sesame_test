<?php

declare(strict_types=1);


namespace App\Tests\User\Domain\ValueObjects;


use App\User\Domain\ValueObjects\UserUuidVO;
use Exception;
use Symfony\Component\Uid\Uuid;

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
        return self::create((string) Uuid::v4());
    }
}
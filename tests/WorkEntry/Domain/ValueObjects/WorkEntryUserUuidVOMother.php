<?php

declare(strict_types=1);


namespace App\Tests\WorkEntry\Domain\ValueObjects;


use App\WorkEntry\Domain\ValueObjects\WorkEntryUserUuidVO;
use Exception;
use Symfony\Component\Uid\Uuid;

final class WorkEntryUserUuidVOMother
{
    /**
     * @throws Exception
     */
    private static function create(string $value): WorkEntryUserUuidVO
    {
        return new WorkEntryUserUuidVO($value);
    }

    /**
     * @throws Exception
     */
    public static function random(): WorkEntryUserUuidVO
    {
        return self::create((string) Uuid::v4());
    }
}
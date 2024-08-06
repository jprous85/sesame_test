<?php

declare(strict_types=1);


namespace App\Tests\WorkEntry\Domain\ValueObjects;


use App\WorkEntry\Domain\ValueObjects\WorkEntryUuidVO;
use Exception;
use Symfony\Component\Uid\Uuid;

final class WorkEntryUuidVOMother
{
    /**
     * @throws Exception
     */
    private static function create(string $value): WorkEntryUuidVO
    {
        return new WorkEntryUuidVO($value);
    }

    /**
     * @throws Exception
     */
    public static function random(): WorkEntryUuidVO
    {
        return self::create((string)Uuid::v4());
    }
}
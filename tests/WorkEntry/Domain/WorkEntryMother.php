<?php

declare(strict_types=1);


namespace App\Tests\WorkEntry\Domain;


use App\Tests\WorkEntry\Domain\ValueObjects\WorkEntryCreatedAtVOMother;
use App\Tests\WorkEntry\Domain\ValueObjects\WorkEntryDeletedAtVOMother;
use App\Tests\WorkEntry\Domain\ValueObjects\WorkEntryEndDateVOMother;
use App\Tests\WorkEntry\Domain\ValueObjects\WorkEntryStartDateVOMother;
use App\Tests\WorkEntry\Domain\ValueObjects\WorkEntryUpdatedAtVOMother;
use App\Tests\WorkEntry\Domain\ValueObjects\WorkEntryUserUuidVOMother;
use App\Tests\WorkEntry\Domain\ValueObjects\WorkEntryUuidVOMother;
use App\WorkEntry\Domain\ValueObjects\WorkEntryCreatedAtVO;
use App\WorkEntry\Domain\ValueObjects\WorkEntryDeletedAtVO;
use App\WorkEntry\Domain\ValueObjects\WorkEntryEndDateVO;
use App\WorkEntry\Domain\ValueObjects\WorkEntryStartDateVO;
use App\WorkEntry\Domain\ValueObjects\WorkEntryUpdatedAtVO;
use App\WorkEntry\Domain\ValueObjects\WorkEntryUserUuidVO;
use App\WorkEntry\Domain\ValueObjects\WorkEntryUuidVO;
use App\WorkEntry\Domain\WorkEntry;
use Exception;

final class WorkEntryMother
{
    private static function create(
        WorkEntryUuidVO      $uuid,
        WorkEntryUserUuidVO  $userUuid,
        WorkEntryStartDateVO $startDate,
        WorkEntryEndDateVO   $endDate,
        WorkEntryCreatedAtVO $createdAt,
        WorkEntryUpdatedAtVO $updatedAt,
        WorkEntryDeletedAtVO $deletedAt,
    ): WorkEntry
    {
        return new WorkEntry(
            $uuid,
            $userUuid,
            $startDate,
            $endDate,
            $createdAt,
            $updatedAt,
            $deletedAt,
        );
    }

    /**
     * @throws Exception
     */
    public static function random(): WorkEntry
    {
        return self::create(
            WorkEntryUuidVOMother::random(),
            WorkEntryUserUuidVOMother::random(),
            WorkEntryStartDateVOMother::random(),
            WorkEntryEndDateVOMother::random(),
            WorkEntryCreatedAtVOMother::random(),
            WorkEntryUpdatedAtVOMother::random(),
            WorkEntryDeletedAtVOMother::random(),
        );
    }
}
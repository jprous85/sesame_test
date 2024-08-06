<?php

declare(strict_types=1);


namespace App\WorkEntry\Domain;


use App\Shared\Infrastructure\Services\DateTimeService;
use App\WorkEntry\Domain\ValueObjects\WorkEntryCreatedAtVO;
use App\WorkEntry\Domain\ValueObjects\WorkEntryDeletedAtVO;
use App\WorkEntry\Domain\ValueObjects\WorkEntryEndDateVO;
use App\WorkEntry\Domain\ValueObjects\WorkEntryStartDateVO;
use App\WorkEntry\Domain\ValueObjects\WorkEntryUpdatedAtVO;
use App\WorkEntry\Domain\ValueObjects\WorkEntryUserUuidVO;
use App\WorkEntry\Domain\ValueObjects\WorkEntryUuidVO;
use Exception;

final class WorkEntry
{
    public function __construct(
        private WorkEntryUuidVO      $uuid,
        private WorkEntryUserUuidVO  $userUuid,
        private WorkEntryStartDateVO $startDate,
        private WorkEntryEndDateVO   $endDate,
        private WorkEntryCreatedAtVO $createdAt,
        private WorkEntryUpdatedAtVO $updatedAt,
        private WorkEntryDeletedAtVO $deletedAt,
    )
    {
    }


    /*************
     *  METHODS  *
     *************/


    /**
     * @throws Exception
     */
    public static function create(
        WorkEntryUuidVO     $uuid,
        WorkEntryUserUuidVO $userUuid
    ): self
    {
        return new self(
            $uuid,
            $userUuid,
            new WorkEntryStartDateVO(DateTimeService::nowWithDateTimeFormat()),
            new WorkEntryEndDateVO(null),
            new WorkEntryCreatedAtVO(DateTimeService::nowWithDateTimeFormat()),
            new WorkEntryUpdatedAtVO(null),
            new WorkEntryDeletedAtVO(null)
        );
    }

    /**
     * @throws Exception
     */
    public function update(
        WorkEntryStartDateVO $startDate,
        WorkEntryEndDateVO   $endDate,
    ): void
    {
        $this->startDate = $startDate;
        $this->endDate   = $endDate;
        $this->updatedAt = new WorkEntryUpdatedAtVO(DateTimeService::nowWithDateTimeFormat());
    }

    /**
     * @throws Exception
     */
    public function finishDate()
    {
        $this->endDate = new WorkEntryEndDateVO(DateTimeService::nowWithDateTimeFormat());
    }

    /**
     * @throws Exception
     */
    public function delete()
    {
        $this->deletedAt = new WorkEntryDeletedAtVO(DateTimeService::nowWithDateTimeFormat());
    }


    /*************
     *  GETTERS  *
     *************/


    /**
     * @return WorkEntryUuidVO
     */
    public function getUuid(): WorkEntryUuidVO
    {
        return $this->uuid;
    }

    /**
     * @return WorkEntryUserUuidVO
     */
    public function getUserUuid(): WorkEntryUserUuidVO
    {
        return $this->userUuid;
    }

    /**
     * @return WorkEntryStartDateVO
     */
    public function getStartDate(): WorkEntryStartDateVO
    {
        return $this->startDate;
    }

    /**
     * @return WorkEntryEndDateVO
     */
    public function getEndDate(): WorkEntryEndDateVO
    {
        return $this->endDate;
    }

    /**
     * @return WorkEntryCreatedAtVO
     */
    public function getCreatedAt(): WorkEntryCreatedAtVO
    {
        return $this->createdAt;
    }

    /**
     * @return WorkEntryUpdatedAtVO
     */
    public function getUpdatedAt(): WorkEntryUpdatedAtVO
    {
        return $this->updatedAt;
    }

    /**
     * @return WorkEntryDeletedAtVO
     */
    public function getDeletedAt(): WorkEntryDeletedAtVO
    {
        return $this->deletedAt;
    }

}
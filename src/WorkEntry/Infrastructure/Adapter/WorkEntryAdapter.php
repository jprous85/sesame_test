<?php

declare(strict_types=1);


namespace App\WorkEntry\Infrastructure\Adapter;


use App\WorkEntry\Domain\ValueObjects\WorkEntryCreatedAtVO;
use App\WorkEntry\Domain\ValueObjects\WorkEntryDeletedAtVO;
use App\WorkEntry\Domain\ValueObjects\WorkEntryEndDateVO;
use App\WorkEntry\Domain\ValueObjects\WorkEntryStartDateVO;
use App\WorkEntry\Domain\ValueObjects\WorkEntryUpdatedAtVO;
use App\WorkEntry\Domain\ValueObjects\WorkEntryUserUuidVO;
use App\WorkEntry\Domain\ValueObjects\WorkEntryUuidVO;
use App\WorkEntry\Domain\WorkEntry;
use App\WorkEntry\Domain\WorkEntryAdapterRepository;

final class WorkEntryAdapter implements WorkEntryAdapterRepository
{

    public function __construct(private ?\App\Entity\WorkEntry $workEntryEntity)
    {
    }

    /**
     * @throws \Exception
     */
    public function workEntryDatabaseAdapter(): ?WorkEntry
    {
        if (!$this->workEntryEntity) {
            return null;
        }

        return new WorkEntry(
            new WorkEntryUuidVO($this->getUuid()),
            new WorkEntryUserUuidVO($this->getUserUuid()),
            new WorkEntryStartDateVO($this->getStartDate()),
            new WorkEntryEndDateVO($this->getEndDate()),
            new WorkEntryCreatedAtVO($this->getCreatedAt()),
            new WorkEntryUpdatedAtVO($this->getUpdatedAt()),
            new WorkEntryDeletedAtVO($this->getDeletedAt()),
        );
    }

    private function getUuid()
    {
        return $this->workEntryEntity->getUuid();
    }

    private function getUserUuid()
    {
        return $this->workEntryEntity->getUserUuid();
    }

    private function getStartDate()
    {
        return $this->workEntryEntity->getStartDate();
    }

    private function getEndDate()
    {
        return $this->workEntryEntity->getEndDate();
    }

    private function getCreatedAt()
    {
        return $this->workEntryEntity->getCreatedAt();
    }

    private function getUpdatedAt()
    {
        return $this->workEntryEntity->getUpdatedAt();
    }

    private function getDeletedAt()
    {
        return $this->workEntryEntity->getDeletedAt();
    }
}
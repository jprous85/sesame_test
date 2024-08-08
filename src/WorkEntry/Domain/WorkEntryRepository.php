<?php

namespace App\WorkEntry\Domain;

use App\WorkEntry\Domain\ValueObjects\WorkEntryUserUuidVO;
use App\WorkEntry\Domain\ValueObjects\WorkEntryUuidVO;

interface WorkEntryRepository
{
    public function getWorkEntryByUuid(WorkEntryUuidVO $uuid): ?WorkEntry;

    public function getWorksEntriesByUserUuid(WorkEntryUserUuidVO $uuid): array;

    public function getWorkEntryByUserUuid(WorkEntryUserUuidVO $uuid): ?WorkEntry;

    public function getAllWorksEntries(): array;

    public function save(WorkEntry $workEntry): void;

    public function update(WorkEntry $workEntry): void;

    public function delete(WorkEntry $workEntry): void;


}
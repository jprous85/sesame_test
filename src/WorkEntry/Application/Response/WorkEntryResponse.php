<?php

declare(strict_types=1);


namespace App\WorkEntry\Application\Response;


use App\WorkEntry\Domain\WorkEntry;

final class WorkEntryResponse
{
    public function __construct(
        private readonly string $uuid,
        private readonly string $userUuid,
        private readonly string $startDate,
        private readonly ?string $endDate,
        private readonly string $createdAt,
        private readonly ?string $updatedAt,
        private readonly ?string $deletedAt,
    )
    {
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @return string
     */
    public function getUserUuid(): string
    {
        return $this->userUuid;
    }

    /**
     * @return string
     */
    public function getStartDate(): string
    {
        return $this->startDate;
    }

    /**
     * @return string|null
     */
    public function getEndDate(): ?string
    {
        return $this->endDate;
    }

    /**
     * @return string
     */
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    /**
     * @return string|null
     */
    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }

    /**
     * @return string|null
     */
    public function getDeletedAt(): ?string
    {
        return $this->deletedAt;
    }

    public function toArray(): array
    {
        return [
            "uuid"       => $this->getUuid(),
            "user_uuid"  => $this->getUserUuid(),
            "start_date" => $this->getStartDate(),
            "end_date"   => $this->getEndDate(),
            "created_at" => $this->getCreatedAt(),
            "updated_at" => $this->getUpdatedAt(),
            "deleted_at" => $this->getDeletedAt(),
        ];
    }

    public static function workEntryResponseMapper(WorkEntry $workEntry): self
    {
        return new self (
            $workEntry->getUuid()->uuid(),
            $workEntry->getUserUuid()->uuid(),
            $workEntry->getStartDate()->value()->format('Y-m-d h:i'),
            $workEntry->getEndDate()->value()?->format('Y-m-d h:i'),
            $workEntry->getCreatedAt()->value()->format('Y-m-d h:i'),
            $workEntry->getUpdatedAt()->value()?->format('Y-m-d h:i'),
            $workEntry->getDeletedAt()->value()?->format('Y-m-d h:i'),
        );
    }
}
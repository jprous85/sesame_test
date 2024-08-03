<?php

declare(strict_types=1);


namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

#[ORM\Entity]
#[UniqueEntity(fields: ["uuid"])]
class WorkEntry
{
    #[ORM\Column(
        name: "id",
        type: "bigint",
        nullable: false
    )]
    #[ORM\Id]
    #[ORM\GeneratedValue(strategy: "IDENTITY")]
    private int $id;

    #[ORM\Column(
        name: "uuid",
        type: "string",
        length: 255,
        nullable: false
    )]
    private string $uuid;

    #[ORM\Column(
        name: "user_uuid",
        type: "string",
        length: 255,
        nullable: false
    )]
    #[ORM\ManyToOne(targetEntity: User::class)]
    #[ORM\JoinColumn(name: 'user_uuid', referencedColumnName: 'uuid')]
    private string $userUuid;

    #[ORM\Column(
        name: "start_date",
        type: "datetime",
        nullable: false
    )]
    private DateTime $startDate;

    #[ORM\Column(
        name: "end_date",
        type: "datetime",
        nullable: true
    )]
    private ?DateTime $endDate;

    #[ORM\Column(
        name: "created_at",
        type: "datetime",
        nullable: false
    )]
    private DateTime $createdAt;

    #[ORM\Column(
        name: "updated_at",
        type: "datetime",
        nullable: true
    )]
    private ?DateTime $updatedAt;

    #[ORM\Column(
        name: "deleted_at",
        type: "datetime",
        nullable: true
    )]
    private ?DateTime $deletedAt;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getUuid(): string
    {
        return $this->uuid;
    }

    /**
     * @param string $uuid
     */
    public function setUuid(string $uuid): void
    {
        $this->uuid = $uuid;
    }

    /**
     * @return string
     */
    public function getUserUuid(): string
    {
        return $this->userUuid;
    }

    /**
     * @param string $userUuid
     */
    public function setUserUuid(string $userUuid): void
    {
        $this->userUuid = $userUuid;
    }

    /**
     * @return DateTime
     */
    public function getStartDate(): DateTime
    {
        return $this->startDate;
    }

    /**
     * @param DateTime $startDate
     */
    public function setStartDate(DateTime $startDate): void
    {
        $this->startDate = $startDate;
    }

    /**
     * @return DateTime|null
     */
    public function getEndDate(): ?DateTime
    {
        return $this->endDate;
    }

    /**
     * @param DateTime|null $endDate
     */
    public function setEndDate(?DateTime $endDate): void
    {
        $this->endDate = $endDate;
    }

    /**
     * @return DateTime
     */
    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param DateTime $createdAt
     */
    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return DateTime|null
     */
    public function getUpdatedAt(): ?DateTime
    {
        return $this->updatedAt;
    }

    /**
     * @param DateTime|null $updatedAt
     */
    public function setUpdatedAt(?DateTime $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }

    /**
     * @return DateTime|null
     */
    public function getDeletedAt(): ?DateTime
    {
        return $this->deletedAt;
    }

    /**
     * @param DateTime|null $deletedAt
     */
    public function setDeletedAt(?DateTime $deletedAt): void
    {
        $this->deletedAt = $deletedAt;
    }

}
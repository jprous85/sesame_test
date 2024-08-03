<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;


#[ORM\Entity]
#[UniqueEntity(fields: ["uuid", "email"])]
class User implements PasswordAuthenticatedUserInterface, UserInterface
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
        name: "name",
        type: "string",
        length: 255,
        nullable: false
    )]
    private string $name;

    #[ORM\Column(
        name: "email",
        type: "string",
        length: 255,
        nullable: false
    )]
    private string $email;

    #[ORM\Column(
        name: "password",
        type: "string",
        length: 255,
        nullable: false
    )]
    private string $password;

    #[ORM\Column(
        name: "role",
        type: "string",
        length: 255,
        nullable: false
    )]
    private string $role;

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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @param string $role
     */
    public function setRole(string $role): void
    {
        $this->role = $role;
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


    public function eraseCredentials(): void
    {
    }

    public function getUserIdentifier(): string
    {
        return (string)$this->id;
    }

    public function getRoles(): array
    {
        return [$this->role];
    }

    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }
}

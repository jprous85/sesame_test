<?php

declare(strict_types=1);


namespace App\User\Application\Response;


use App\User\Domain\User;

final class UserResponse
{
    public function __construct(
        private readonly string $uuid,
        private readonly string $name,
        private readonly string $email,
        private readonly string $password,
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
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
            "uuid"       => $this->uuid,
            "name"       => $this->name,
            "email"      => $this->email,
            "password"   => $this->password,
            "created_at" => $this->createdAt,
            "updated_at" => $this->updatedAt,
            "deleted_at" => $this->deletedAt,
        ];
    }

    public static function userResponseMapper(User $user): UserResponse
    {
        return new self(
            $user->getUuid()->uuid(),
            $user->getName()->value(),
            $user->getEmail()->value(),
            $user->getPassword()->value(),
            $user->getCreatedAt()->value()->format('Y-m-d h:i'),
            $user->getUpdatedAt()->value()?->format('Y-m-d h:i'),
            $user->getDeletedAt()->value()?->format('Y-m-d h:i')
        );
    }
}
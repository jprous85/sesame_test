<?php

declare(strict_types=1);


namespace App\User\Domain;


use App\User\Domain\ValueObjects\UserCreatedAtVO;
use App\User\Domain\ValueObjects\UserDeletedAtVO;
use App\User\Domain\ValueObjects\UserEmailVO;
use App\User\Domain\ValueObjects\UserNameVO;
use App\User\Domain\ValueObjects\UserPasswordVO;
use App\User\Domain\ValueObjects\UserRoleVO;
use App\User\Domain\ValueObjects\UserUpdatedAtVO;
use App\User\Domain\ValueObjects\UserUuidVO;

final class User
{
    public function __construct(
        private UserUuidVO      $uuid,
        private UserNameVO      $name,
        private UserEmailVO     $email,
        private UserPasswordVO  $password,
        private UserRoleVO      $role,
        private UserCreatedAtVO $createdAt,
        private UserUpdatedAtVO $updatedAt,
        private UserDeletedAtVO $deletedAt,
    )
    {
    }

    public static function create(
        UserUuidVO      $uuid,
        UserNameVO      $name,
        UserEmailVO     $email,
        UserPasswordVO  $password,
        UserRoleVO      $role,
        UserCreatedAtVO $createdAt
    ): self
    {
        return new self(
            $uuid,
            $name,
            $email,
            $password,
            $role,
            $createdAt,
            new UserUpdatedAtVO(null),
            new UserDeletedAtVO(null),
        );
    }

    public function update(
        UserUuidVO      $uuid,
        UserNameVO      $name,
        UserEmailVO     $email,
        UserPasswordVO  $password,
        UserRoleVO      $role,
        UserCreatedAtVO $createdAt,
        UserUpdatedAtVO $updatedAt,
        UserDeletedAtVO $deletedAt,
    ): void
    {
        $this->uuid      = $uuid;
        $this->name      = $name;
        $this->email     = $email;
        $this->password  = $password;
        $this->role      = $role;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->deletedAt = $deletedAt;
    }

    /**
     * @return UserUuidVO
     */
    public function getUuid(): UserUuidVO
    {
        return $this->uuid;
    }

    /**
     * @return UserNameVO
     */
    public function getName(): UserNameVO
    {
        return $this->name;
    }

    /**
     * @return UserEmailVO
     */
    public function getEmail(): UserEmailVO
    {
        return $this->email;
    }

    /**
     * @return UserPasswordVO
     */
    public function getPassword(): UserPasswordVO
    {
        return $this->password;
    }

    /**
     * @return UserRoleVO
     */
    public function getRole(): UserRoleVO
    {
        return $this->role;
    }

    /**
     * @return UserCreatedAtVO
     */
    public function getCreatedAt(): UserCreatedAtVO
    {
        return $this->createdAt;
    }

    /**
     * @return UserUpdatedAtVO
     */
    public function getUpdatedAt(): UserUpdatedAtVO
    {
        return $this->updatedAt;
    }

    /**
     * @return UserDeletedAtVO
     */
    public function getDeletedAt(): UserDeletedAtVO
    {
        return $this->deletedAt;
    }

}
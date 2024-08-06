<?php

declare(strict_types=1);


namespace App\User\Domain;


use App\Shared\Infrastructure\Services\DateTimeService;
use App\User\Domain\ValueObjects\UserCreatedAtVO;
use App\User\Domain\ValueObjects\UserDeletedAtVO;
use App\User\Domain\ValueObjects\UserEmailVO;
use App\User\Domain\ValueObjects\UserNameVO;
use App\User\Domain\ValueObjects\UserPasswordVO;
use App\User\Domain\ValueObjects\UserUpdatedAtVO;
use App\User\Domain\ValueObjects\UserUuidVO;
use Exception;

final class User
{
    public function __construct(
        private UserUuidVO      $uuid,
        private UserNameVO      $name,
        private UserEmailVO     $email,
        private UserPasswordVO  $password,
        private UserCreatedAtVO $createdAt,
        private UserUpdatedAtVO $updatedAt,
        private UserDeletedAtVO $deletedAt,
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
        UserUuidVO      $uuid,
        UserNameVO      $name,
        UserEmailVO     $email,
        UserPasswordVO  $password
    ): self
    {
        return new self(
            $uuid,
            $name,
            $email,
            $password,
            new UserCreatedAtVO(DateTimeService::nowWithDateTimeFormat()),
            new UserUpdatedAtVO(null),
            new UserDeletedAtVO(null),
        );
    }

    /**
     * @throws Exception
     */
    public function update(
        UserNameVO      $name,
        UserEmailVO     $email,
        UserPasswordVO  $password
    ): void
    {
        $this->name      = $name;
        $this->email     = $email;
        $this->password  = $password;
        $this->updatedAt = new UserUpdatedAtVO(DateTimeService::nowWithDateTimeFormat());
    }

    /**
     * @throws Exception
     */
    public function deleted()
    {
        $this->deletedAt = new UserDeletedAtVO(DateTimeService::nowWithDateTimeFormat());
    }


    /*************
     *  GETTERS  *
     *************/


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
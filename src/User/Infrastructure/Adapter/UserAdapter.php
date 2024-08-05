<?php

declare(strict_types=1);


namespace App\User\Infrastructure\Adapter;


use App\User\Domain\User;
use App\User\Domain\UserAdapterRepository;
use App\User\Domain\ValueObjects\UserCreatedAtVO;
use App\User\Domain\ValueObjects\UserDeletedAtVO;
use App\User\Domain\ValueObjects\UserEmailVO;
use App\User\Domain\ValueObjects\UserNameVO;
use App\User\Domain\ValueObjects\UserPasswordVO;
use App\User\Domain\ValueObjects\UserRoleVO;
use App\User\Domain\ValueObjects\UserUpdatedAtVO;
use App\User\Domain\ValueObjects\UserUuidVO;
use Exception;

final class UserAdapter implements UserAdapterRepository
{

    public function __construct(private ?\App\Entity\User $userEntity)
    {
    }

    /**
     * @throws Exception
     */
    public function userDatabaseAdapter(): ?User
    {

        if (!$this->userEntity) {
            return null;
        }

        return new User(
            new UserUuidVO($this->getUuid()),
            new UserNameVO($this->getName()),
            new UserEmailVO($this->getEmail()),
            new UserPasswordVO($this->getPassword()),
            new UserRoleVO($this->getRole()),
            new UserCreatedAtVO($this->getCreatedAt()),
            new UserUpdatedAtVO($this->getUpdatedAt()),
            new UserDeletedAtVO($this->getDeletedAt()),
        );
    }

    private function getUuid()
    {
        return $this->userEntity->getUuid();
    }

    private function getName()
    {
        return $this->userEntity->getName();
    }

    private function getEmail()
    {
        return $this->userEntity->getEmail();
    }

    private function getPassword()
    {
        return $this->userEntity->getPassword();
    }

    private function getRole()
    {
        return $this->userEntity->getRole();
    }

    private function getCreatedAt()
    {
        return $this->userEntity->getCreatedAt();
    }

    private function getUpdatedAt()
    {
        return $this->userEntity->getUpdatedAt();
    }

    private function getDeletedAt()
    {
        return $this->userEntity->getDeletedAt();
    }
}
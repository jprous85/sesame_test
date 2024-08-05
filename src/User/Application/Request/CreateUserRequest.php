<?php

declare(strict_types=1);


namespace App\User\Application\Request;


final class CreateUserRequest
{
    public function __construct(
        private readonly string $uuid,
        private readonly string $name,
        private readonly string $email,
        private readonly string $password,
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
}
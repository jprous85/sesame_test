<?php

namespace App\User\Domain;

use App\User\Domain\ValueObjects\UserUuidVO;

interface UserRepository
{
    public function getUserByUuid(UserUuidVO $uuid): ?User;

    public function getAllUsers(): array;

    public function save(User $user): void;

    public function update(User $user): void;

    public function delete(User $user): void;
}
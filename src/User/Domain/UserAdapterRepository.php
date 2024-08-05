<?php

namespace App\User\Domain;

interface UserAdapterRepository
{
    public function userDatabaseAdapter(): ?User;
}
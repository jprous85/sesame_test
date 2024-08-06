<?php

namespace App\WorkEntry\Domain;


interface WorkEntryAdapterRepository
{
    public function workEntryDatabaseAdapter(): ?WorkEntry;
}
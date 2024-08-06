<?php

declare(strict_types=1);


namespace App\WorkEntry\Domain\Event;


use App\WorkEntry\Domain\ValueObjects\WorkEntryUuidVO;
use Symfony\Contracts\EventDispatcher\Event;

final class CreateWorkEntryDomainEvent extends Event
{
    public const NAME = 'work_entry.created';

    public function __construct(private readonly WorkEntryUuidVO $workEntryUuidVO)
    {
    }

    /**
     * @return WorkEntryUuidVO
     */
    public function getWorkEntry(): WorkEntryUuidVO
    {
        return $this->workEntryUuidVO;
    }
}
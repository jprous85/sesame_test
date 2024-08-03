<?php
declare(strict_types=1);

namespace App\Shared\Domain\Aggregate;


use Symfony\Contracts\EventDispatcher\Event;

abstract class AggregateRoot
{
    private array $domainEvents = [];

    final public function pullDomainEvents(): array
    {
        $domainEvents = $this->domainEvents;
        $this->domainEvents = [];

        return $domainEvents;
    }

    final protected function addEvent(Event $event): void
    {
        $this->domainEvents[] = $event;
    }
}

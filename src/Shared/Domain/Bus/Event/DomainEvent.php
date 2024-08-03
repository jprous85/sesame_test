<?php

declare(strict_types = 1);

namespace App\Shared\Domain\Bus\Event;

use App\Shared\Infrastructure\Services\DateTimeService;
use Exception;
use Symfony\Component\Uid\Uuid;


abstract class DomainEvent
{
    private readonly string $eventId;
    private readonly string $occurredOn;

    /**
     * @throws Exception
     */
    public function __construct(private readonly string $aggregateId, string $eventId = null, string $occurredOn = null)
    {
        $this->eventId = $eventId ?: (string) Uuid::v4();
        $this->occurredOn = $occurredOn ?: DateTimeService::now();
    }

    abstract public static function fromPrimitives(
        string $aggregateId,
        array $body,
        string $eventId,
        string $occurredOn
    ): self;

    abstract public static function eventName(): string;

    abstract public function toPrimitives(): array;

    final public function aggregateId(): string
    {
        return $this->aggregateId;
    }

    final public function eventId(): string
    {
        return $this->eventId;
    }

    final public function occurredOn(): string
    {
        return $this->occurredOn;
    }

}

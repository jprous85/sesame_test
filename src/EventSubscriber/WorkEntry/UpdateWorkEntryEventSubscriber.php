<?php

declare(strict_types=1);


namespace App\EventSubscriber\WorkEntry;


use App\Shared\Infrastructure\Controller\BaseController;
use App\WorkEntry\Application\Request\WorkEntryUuidRequest;
use App\WorkEntry\Application\UseCases\GetWorkEntryByUuidQuery;
use App\WorkEntry\Domain\Event\UpdateWorkEntryDomainEvent;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Messenger\MessageBusInterface;
use Throwable;

final class UpdateWorkEntryEventSubscriber extends BaseController implements EventSubscriberInterface
{

    public function __construct(
        private readonly MessageBusInterface $commandBus,
        private readonly MessageBusInterface $queryBus,
        private readonly LoggerInterface $logger
    )
    {
        parent::__construct($this->commandBus, $this->queryBus);
    }

    public static function getSubscribedEvents(): array
    {
        return [
            UpdateWorkEntryDomainEvent::class => 'updateWorkEntry'
        ];
    }

    /**
     * @throws Throwable
     */
    public function updateWorkEntry(UpdateWorkEntryDomainEvent $event): void
    {
        $uuidRequest = new WorkEntryUuidRequest($event->getWorkEntry()->uuid());
        $workEntryQuery = new GetWorkEntryByUuidQuery($uuidRequest);
        $workEntry = $this->manageQuery($workEntryQuery);

        $this->logger->info('[GLOBAL] workEntry updated correctly with uuid: ' . $workEntry['uuid'] . ' and start date: '. $workEntry['start_date']. ' and end date: '. $workEntry['end_date']);
    }
}
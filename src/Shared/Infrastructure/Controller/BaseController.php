<?php

namespace App\Shared\Infrastructure\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Messenger\Envelope;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\HandledStamp;
use Throwable;

class BaseController extends AbstractController
{
    use HttpResponse;

    public function __construct(
        private readonly MessageBusInterface $commandBus,
        private readonly MessageBusInterface $queryBus
    )
    {
        $this->startTime();
    }

    /**
     * @throws Throwable
     */
    protected function manageCommand($command): array
    {
        try {
            $envelope = $this->commandBus->dispatch($command);
        } catch (HandlerFailedException|Throwable $e) {
            $this->processBusException($e);
        }
        return $this->processEnvelope($envelope);
    }

    /**
     * @throws Throwable
     */
    protected function manageQuery($query): array
    {
        try {
            $envelope = $this->queryBus->dispatch($query);
        } catch (HandlerFailedException|Throwable $e) {
            $this->processBusException($e);
        }
        return $this->processEnvelope($envelope);
    }

    private function processEnvelope(Envelope $envelope): array
    {
        $handledStamps = $envelope->last(HandledStamp::class);
        $data = $handledStamps->getResult();

        return (is_array($data)) ? $data : (array)$data;
    }

    /**
     * @throws Throwable
     */
    private function processBusException(HandlerFailedException $exception)
    {
        while ($exception instanceof HandlerFailedException) {
            /** @var Throwable $exception */
            $exception = $exception->getPrevious();
        }

        throw $exception;
    }
}
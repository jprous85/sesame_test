<?php

declare(strict_types=1);


namespace App\WorkEntry\Infrastructure\Controllers;


use App\Shared\Infrastructure\Controller\BaseController;
use App\WorkEntry\Application\Request\WorkEntryUuidRequest;
use App\WorkEntry\Application\UseCases\GetAllWorksEntriesQuery;
use App\WorkEntry\Application\UseCases\GetWorkEntryByUuidQuery;
use App\WorkEntry\Application\UseCases\GetWorksEntriesByUserUuidQuery;
use Exception;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Throwable;

final class WorkEntryGetController extends BaseController
{
    public function __construct(
        private MessageBusInterface $commandBus,
        private MessageBusInterface $queryBus,
        private readonly Security $security
    )
    {
        parent::__construct($this->commandBus, $this->queryBus);
    }

    /**
     * @throws Throwable
     */
    public function show(Request $request): JsonResponse
    {
        $workEntryRequest = $request->get('uuid');

        $getWorkEntryByUuidQuery = new GetWorkEntryByUuidQuery(
            new WorkEntryUuidRequest($workEntryRequest)
        );

        try {
            $result = $this->manageQuery($getWorkEntryByUuidQuery);
            return $this->successResponse($result);
        } catch (Exception $e) {
            return $this->errorResponse([$e->getMessage()]);
        }
    }

    /**
     * @throws Throwable
     */
    public function showAll(): JsonResponse
    {
        $getAllWorksEntriesQuery = new GetAllWorksEntriesQuery();
        $result = $this->manageQuery($getAllWorksEntriesQuery);

        return $this->successResponse($result);
    }

    /**
     * @throws Throwable
     */
    public function showAllWorksEntriesByUserUuid(Request $request): JsonResponse
    {
        $workEntryRequest = $request->get('uuid');

        $user = $this->security->getUser();

        if ($workEntryRequest !== $user->getUuid()) {
            return $this->errorResponse(['This user have not permissions for this action']);
        }

        $getWorksEntriesByUserUuidQuery = new GetWorksEntriesByUserUuidQuery(
            new WorkEntryUuidRequest(
                $workEntryRequest
            )
        );

        $result = $this->manageQuery($getWorksEntriesByUserUuidQuery);

        return $this->successResponse($result);
    }
}
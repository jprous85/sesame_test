<?php

declare(strict_types=1);


namespace App\WorkEntry\Infrastructure\Controllers;


use App\Shared\Infrastructure\Controller\BaseController;
use App\WorkEntry\Application\Request\CreateWorkEntryRequest;
use App\WorkEntry\Application\Request\WorkEntryUuidAndUserUuidRequest;
use App\WorkEntry\Application\UseCases\CreateWorkEntryCommand;
use App\WorkEntry\Application\UseCases\UpsertWorkEntryByUserUuidCommand;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Uid\Uuid;
use Throwable;

final class WorkEntryPostController extends BaseController
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
    public function create(Request $request): JsonResponse
    {
        $requestData = json_decode($request->getContent(), true, JSON_THROW_ON_ERROR);

        $createWorkEntryRequest = new CreateWorkEntryRequest(
            (string) Uuid::v4(),
            $requestData['user_uuid']
        );

        try {
            $createWorkEntryCommand = new CreateWorkEntryCommand($createWorkEntryRequest);
            $this->manageCommand($createWorkEntryCommand);

            return $this->successResponse(['work entry has been created successfully']);
        } catch (\Exception $e) {
            return $this->errorResponse([$e->getMessage()]);
        }
    }

    /**
     * @throws Throwable
     */
    public function signing(Request $request): JsonResponse
    {
        $workEntryRequest = $request->get('uuid');

        $user = $this->security->getUser();

        if ($workEntryRequest !== $user->getUuid()) {
            return $this->errorResponse(['This user have not permissions for this action']);
        }

        $upsertWorkEntryByUserUuidCommand = new UpsertWorkEntryByUserUuidCommand(
            new WorkEntryUuidAndUserUuidRequest(
                (string) Uuid::v4(),
                $workEntryRequest
            )
        );

        try {
            $this->manageCommand($upsertWorkEntryByUserUuidCommand);
            return $this->successResponse(['Signing successfully']);
        } catch (\Exception $e) {
            return $this->errorResponse([$e->getMessage()]);
        }
    }
}
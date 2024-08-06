<?php

declare(strict_types=1);


namespace App\WorkEntry\Infrastructure\Controllers;


use App\Shared\Infrastructure\Controller\BaseController;
use App\WorkEntry\Application\Request\CreateWorkEntryRequest;
use App\WorkEntry\Application\UseCases\CreateWorkEntryCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Uid\Uuid;
use Throwable;

final class WorkEntryPostController extends BaseController
{
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

        $createWorkEntryCommand = new CreateWorkEntryCommand($createWorkEntryRequest);
        $this->manageCommand($createWorkEntryCommand);

        return $this->successResponse(['work entry has been created successfully']);
    }
}
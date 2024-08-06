<?php

declare(strict_types=1);


namespace App\WorkEntry\Infrastructure\Controllers;


use App\Shared\Infrastructure\Controller\BaseController;
use App\WorkEntry\Application\Request\WorkEntryUuidRequest;
use App\WorkEntry\Application\UseCases\GetAllWorksEntriesQuery;
use App\WorkEntry\Application\UseCases\GetWorkEntryByUuidQuery;
use Exception;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class WorkEntryGetController extends BaseController
{
    /**
     * @throws \Throwable
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
     * @throws \Throwable
     */
    public function showAll(): JsonResponse
    {
        $getAllWorksEntriesQuery = new GetAllWorksEntriesQuery();
        $result = $this->manageQuery($getAllWorksEntriesQuery);

        return $this->successResponse($result);
    }
}
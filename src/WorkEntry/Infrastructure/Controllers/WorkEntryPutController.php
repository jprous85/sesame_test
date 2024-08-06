<?php

declare(strict_types=1);


namespace App\WorkEntry\Infrastructure\Controllers;


use App\Shared\Infrastructure\Controller\BaseController;
use App\WorkEntry\Application\Request\UpdateWorkEntryRequest;
use App\WorkEntry\Application\UseCases\UpdateWorkEntryCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Throwable;

final class WorkEntryPutController extends BaseController
{
    /**
     * @throws Throwable
     */
    public function update(Request $request): JsonResponse
    {
        $workEntryRequest = $request->get('uuid');
        $requestData = json_decode($request->getContent(), true, JSON_THROW_ON_ERROR);

        $updateWorkEntryRequest = new UpdateWorkEntryRequest(
            $workEntryRequest,
            $requestData['start_date'],
            $requestData['end_date'],
        );

        try {
            $updateWorkEntryCommand = new UpdateWorkEntryCommand($updateWorkEntryRequest);
            $this->manageCommand($updateWorkEntryCommand);

            return $this->successResponse(['work entry has been updated successfully']);
        } catch (\Exception $e) {
            return $this->errorResponse([$e->getMessage()]);
        }
    }
}
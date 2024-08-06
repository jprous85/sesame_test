<?php

declare(strict_types=1);


namespace App\WorkEntry\Infrastructure\Controllers;


use App\Shared\Infrastructure\Controller\BaseController;
use App\WorkEntry\Application\Request\WorkEntryUuidRequest;
use App\WorkEntry\Application\UseCases\DeleteWorkEntryCommand;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Throwable;

final class WorkEntryDeleteController extends BaseController
{
    /**
     * @throws Throwable
     */
    public function delete(Request $request): JsonResponse
    {
        $workEntryRequest = $request->get('uuid');

        $deleteWorkEntryCommand = new DeleteWorkEntryCommand(
            new WorkEntryUuidRequest($workEntryRequest)
        );

        try {
            $this->manageCommand($deleteWorkEntryCommand);
            return $this->successResponse(['work entry has been deleted successfully']);
        } catch (\Exception $e) {
            return $this->errorResponse([$e->getMessage()]);
        }
    }
}
<?php

declare(strict_types=1);


namespace App\WorkEntry\Infrastructure\Controllers;


use App\Shared\Infrastructure\Controller\BaseController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class WorkEntryDeleteController extends BaseController
{
    public function delete(Request $request): JsonResponse
    {
        $workEntryRequest = $request->get('uuid');

        return $this->successResponse(['work entry has been deleted successfully']);
    }
}
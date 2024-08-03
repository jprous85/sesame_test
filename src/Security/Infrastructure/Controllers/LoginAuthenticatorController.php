<?php

namespace App\Security\Infrastructure\Controllers;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;


final class LoginAuthenticatorController extends AbstractController
{
    public function __construct(
    )
    {
    }

    public function login(
    ): JsonResponse
    {
        return new JsonResponse(['token' => 'token']);
    }
}
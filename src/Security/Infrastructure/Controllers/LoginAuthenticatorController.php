<?php

namespace App\Security\Infrastructure\Controllers;

use App\Entity\User;
use App\Shared\Infrastructure\Controller\BaseController;
use Doctrine\ORM\EntityManagerInterface;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;


final class LoginAuthenticatorController extends BaseController
{

    public function login(
        Request                     $request,
        JWTTokenManagerInterface    $jwtManager,
        UserPasswordHasherInterface $passwordHashed,
        EntityManagerInterface      $em
    ): JsonResponse
    {
        $requestData = json_decode($request->getContent(), true, JSON_THROW_ON_ERROR);
        $user = $em->getRepository(User::class)->findOneBy(['email' => $requestData['email']]);

        if (!$user) {
            throw new BadCredentialsException('User not exist');
        }

        if (!$passwordHashed->isPasswordValid($user, $requestData['password'])) {
            throw new AccessDeniedHttpException('Bad credentials');
        }

        $token = $jwtManager->create($user);

        return $this->successResponse(['token' => $token]);
    }
}
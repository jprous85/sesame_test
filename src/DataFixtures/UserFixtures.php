<?php

declare(strict_types=1);

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Uid\Uuid;

final class UserFixtures extends Fixture
{
    public function __construct(private readonly UserPasswordHasherInterface $passwordHashed)
    {
    }

    public function load(ObjectManager $manager): void
    {
        for ($i = 1; $i < 4; $i++) {
            $user = new User();

            $user->setId($i);
            $user->setUuid((string)Uuid::v4());
            $user->setName('Test' . $i);
            $user->setEmail('test' . $i . '@sesame.com');
            $user->setPassword($this->passwordHashed->hashPassword($user, 'password'));
            $user->setRole('admin');
            $user->setCreatedAt(new \DateTime('now'));

            $manager->persist($user);
            $manager->flush();
        }
    }
}
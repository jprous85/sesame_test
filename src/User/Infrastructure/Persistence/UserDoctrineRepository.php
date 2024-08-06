<?php

declare(strict_types=1);


namespace App\User\Infrastructure\Persistence;


use App\User\Domain\User;
use App\User\Domain\UserRepository;
use App\User\Domain\ValueObjects\UserUuidVO;
use App\User\Infrastructure\Adapter\UserAdapter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Persistence\ManagerRegistry;
use Exception;

final class UserDoctrineRepository extends ServiceEntityRepository implements UserRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, \App\Entity\User::class);
    }

    /**
     * @throws Exception
     */
    public function getUserByUuid(UserUuidVO $uuid): ?User
    {
        $userResult = $this->createQueryBuilder('u')
            ->where('u.uuid = :uuid')
            ->andWhere('u.deletedAt is NULL')
            ->setParameter('uuid', $uuid->uuid())
            ->getQuery()->getOneOrNullResult();

        return (new UserAdapter($userResult))->userDatabaseAdapter();
    }

    /**
     * @throws Exception
     */
    public function getAllUsers(): array
    {
        $userResults = $this->createQueryBuilder('u')
            ->where('u.deletedAt is NULL')
            ->getQuery()->execute();

        $users = [];
        foreach ($userResults as $userResult) {
            $users[] = (new UserAdapter($userResult))->userDatabaseAdapter();
        }
        return $users;
    }

    public function save(User $user): void
    {
        $userEntity = new \App\Entity\User();

        $userEntity->setUuid($user->getUuid()->uuid());
        $userEntity->setName($user->getName()->value());
        $userEntity->setEmail($user->getEmail()->value());
        $userEntity->setPassword($user->getPassword()->value());
        $userEntity->setCreatedAt($user->getCreatedAt()->value());
        $userEntity->setUpdatedAt($user->getUpdatedAt()->value());
        $userEntity->setDeletedAt($user->getDeletedAt()->value());

        $this->getEntityManager()->persist($userEntity);
        $this->getEntityManager()->flush();
    }

    public function update(User $user): void
    {
        $this->createQueryBuilder('u')
            ->update()
            ->set('u.name', ':name')
            ->set('u.email', ':email')
            ->set('u.password', ':password')
            ->set('u.updatedAt', ':updatedAt')
            ->where('u.uuid = :uuid')
            ->setParameter('uuid', $user->getUuid()->uuid())
            ->setParameter('name', $user->getName()->value())
            ->setParameter('email', $user->getEmail()->value())
            ->setParameter('password', $user->getPassword()->value())
            ->setParameter('updatedAt', $user->getUpdatedAt()->value())
            ->getQuery()->execute();
    }

    public function delete(User $user): void
    {
        $this->createQueryBuilder('u')
            ->update()
            ->set('u.deletedAt', ':deletedAt')
            ->where('u.uuid = :uuid')
            ->setParameters(
                [
                    'uuid'      => $user->getUuid()->uuid(),
                    'deletedAt' => $user->getUpdatedAt()->value(),
                ]
            )
            ->getQuery()->execute();
    }
}
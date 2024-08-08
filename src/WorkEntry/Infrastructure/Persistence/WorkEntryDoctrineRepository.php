<?php

declare(strict_types=1);


namespace App\WorkEntry\Infrastructure\Persistence;


use App\WorkEntry\Domain\ValueObjects\WorkEntryUserUuidVO;
use App\WorkEntry\Domain\ValueObjects\WorkEntryUuidVO;
use App\WorkEntry\Domain\WorkEntry;
use App\WorkEntry\Domain\WorkEntryRepository;
use App\WorkEntry\Infrastructure\Adapter\WorkEntryAdapter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Exception;

final class WorkEntryDoctrineRepository extends ServiceEntityRepository implements WorkEntryRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, \App\Entity\WorkEntry::class);
    }

    /**
     * @throws Exception
     */
    public function getWorkEntryByUuid(WorkEntryUuidVO $uuid): ?WorkEntry
    {
        $workEntryResult = $this->createQueryBuilder('we')
            ->where('we.uuid = :uuid')
            ->andWhere('we.deletedAt is NULL')
            ->setParameter('uuid', $uuid->uuid())
            ->getQuery()->getOneOrNullResult();

        return (new WorkEntryAdapter($workEntryResult))->workEntryDatabaseAdapter();
    }

    /**
     * @throws Exception
     */
    public function getWorksEntriesByUserUuid(WorkEntryUserUuidVO $uuid): array
    {
        $workEntryResults = $this->createQueryBuilder('we')
            ->where('we.userUuid = :uuid')
            ->andWhere('we.deletedAt is NULL')
            ->setParameter('uuid', $uuid->uuid())
            ->orderBy('we.startDate')
            ->getQuery()->execute();

        $worksEntries = [];
        foreach ($workEntryResults as $workEntry) {
            $worksEntries[] = (new WorkEntryAdapter($workEntry))->workEntryDatabaseAdapter();
        }
        return $worksEntries;
    }

    /**
     * @throws Exception
     */
    public function getWorkEntryByUserUuid(WorkEntryUserUuidVO $uuid): ?WorkEntry
    {
        $workEntryResults = $this->createQueryBuilder('we')
            ->where('we.userUuid = :uuid')
            ->andWhere('we.endDate is NULL')
            ->andWhere('we.deletedAt is NULL')
            ->setParameter('uuid', $uuid->uuid())
            ->getQuery()->getOneOrNullResult();

        return (new WorkEntryAdapter($workEntryResults))->workEntryDatabaseAdapter();
    }

    /**
     * @throws Exception
     */
    public function getAllWorksEntries(): array
    {
        $workEntryResults = $this->createQueryBuilder('we')
            ->where('we.deletedAt is NULL')
            ->getQuery()->execute();

        $worksEntries = [];
        foreach ($workEntryResults as $workEntry) {
            $worksEntries[] = (new WorkEntryAdapter($workEntry))->workEntryDatabaseAdapter();
        }
        return $worksEntries;
    }

    public function save(WorkEntry $workEntry): void
    {
        $workEntryEntity = new \App\Entity\WorkEntry();

        $workEntryEntity->setUuid($workEntry->getUuid()->uuid());
        $workEntryEntity->setUserUuid($workEntry->getUserUuid()->uuid());
        $workEntryEntity->setStartDate($workEntry->getStartDate()->value());
        $workEntryEntity->setEndDate($workEntry->getEndDate()->value());
        $workEntryEntity->setCreatedAt($workEntry->getCreatedAt()->value());
        $workEntryEntity->setUpdatedAt($workEntry->getUpdatedAt()->value());
        $workEntryEntity->setDeletedAt($workEntry->getDeletedAt()->value());

        $this->getEntityManager()->persist($workEntryEntity);
        $this->getEntityManager()->flush();
    }

    public function update(WorkEntry $workEntry): void
    {
        $this->createQueryBuilder('we')
            ->update()
            ->set('we.startDate', ':startDate')
            ->set('we.endDate', ':endDate')
            ->set('we.updatedAt', ':updatedAt')
            ->where('we.uuid = :uuid')
            ->setParameter('uuid', $workEntry->getUuid()->uuid())
            ->setParameter('startDate', $workEntry->getStartDate()->value())
            ->setParameter('endDate', $workEntry->getEndDate()->value())
            ->setParameter('updatedAt', $workEntry->getUpdatedAt()->value())
            ->getQuery()->execute();
    }

    public function delete(WorkEntry $workEntry): void
    {
        $this->createQueryBuilder('we')
            ->update()
            ->set('we.deletedAt', ':deletedAt')
            ->where('we.uuid = :uuid')
            ->setParameter('uuid', $workEntry->getUuid()->uuid())
            ->setParameter('deletedAt', $workEntry->getUpdatedAt()->value())
            ->getQuery()->execute();
    }
}
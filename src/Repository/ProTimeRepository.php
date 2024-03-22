<?php

namespace App\Repository;

use App\Entity\ProTime;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ProTime>
 *
 * @method ProTime|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProTime|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProTime[]    findAll()
 * @method ProTime[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProTimeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProTime::class);
    }

    //    /**
    //     * @return ProTime[] Returns an array of ProTime objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('p.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?ProTime
    //    {
    //        return $this->createQueryBuilder('p')
    //            ->andWhere('p.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}

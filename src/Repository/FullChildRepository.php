<?php

namespace App\Repository;

use App\Entity\FullChild;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FullChild>
 *
 * @method FullChild|null find($id, $lockMode = null, $lockVersion = null)
 * @method FullChild|null findOneBy(array $criteria, array $orderBy = null)
 * @method FullChild[]    findAll()
 * @method FullChild[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FullChildRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FullChild::class);
    }

    //    /**
    //     * @return FullChild[] Returns an array of FullChild objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('f.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?FullChild
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}

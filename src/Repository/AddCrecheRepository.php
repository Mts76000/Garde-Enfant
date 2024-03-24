<?php

namespace App\Repository;

use App\Entity\AddCreche;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AddCreche>
 *
 * @method AddCreche|null find($id, $lockMode = null, $lockVersion = null)
 * @method AddCreche|null findOneBy(array $criteria, array $orderBy = null)
 * @method AddCreche[]    findAll()
 * @method AddCreche[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AddCrecheRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AddCreche::class);
    }

    //    /**
    //     * @return AddCreche[] Returns an array of AddCreche objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('a.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?AddCreche
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

}

<?php

namespace App\Repository;

use App\Entity\ContactCreche;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<ContactCreche>
 *
 * @method ContactCreche|null find($id, $lockMode = null, $lockVersion = null)
 * @method ContactCreche|null findOneBy(array $criteria, array $orderBy = null)
 * @method ContactCreche[]    findAll()
 * @method ContactCreche[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContactCrecheRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ContactCreche::class);
    }

//    /**
//     * @return ContactCreche[] Returns an array of ContactCreche objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?ContactCreche
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

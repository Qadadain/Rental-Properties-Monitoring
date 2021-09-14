<?php

namespace App\Repository;

use App\Entity\PropertyAccounting;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PropertyAccounting|null find($id, $lockMode = null, $lockVersion = null)
 * @method PropertyAccounting|null findOneBy(array $criteria, array $orderBy = null)
 * @method PropertyAccounting[]    findAll()
 * @method PropertyAccounting[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyAccountingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PropertyAccounting::class);
    }

    // /**
    //  * @return PropertyAccounting[] Returns an array of PropertyAccounting objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PropertyAccounting
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

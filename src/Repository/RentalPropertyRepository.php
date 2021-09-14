<?php

namespace App\Repository;

use App\Entity\RentalProperty;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RentalProperty|null find($id, $lockMode = null, $lockVersion = null)
 * @method RentalProperty|null findOneBy(array $criteria, array $orderBy = null)
 * @method RentalProperty[]    findAll()
 * @method RentalProperty[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RentalPropertyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RentalProperty::class);
    }

    // /**
    //  * @return RentalProperty[] Returns an array of RentalProperty objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?RentalProperty
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

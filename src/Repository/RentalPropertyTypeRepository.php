<?php

namespace App\Repository;

use App\Entity\RentalPropertyType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RentalPropertyType|null find($id, $lockMode = null, $lockVersion = null)
 * @method RentalPropertyType|null findOneBy(array $criteria, array $orderBy = null)
 * @method RentalPropertyType[]    findAll()
 * @method RentalPropertyType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RentalPropertyTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RentalPropertyType::class);
    }

    // /**
    //  * @return RentalPropertyType[] Returns an array of RentalPropertyType objects
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
    public function findOneBySomeField($value): ?RentalPropertyType
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

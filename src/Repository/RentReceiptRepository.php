<?php

namespace App\Repository;

use App\Entity\RentReceipt;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RentReceipt|null find($id, $lockMode = null, $lockVersion = null)
 * @method RentReceipt|null findOneBy(array $criteria, array $orderBy = null)
 * @method RentReceipt[]    findAll()
 * @method RentReceipt[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RentReceiptRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RentReceipt::class);
    }

    // /**
    //  * @return RentReceipt[] Returns an array of RentReceipt objects
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
    public function findOneBySomeField($value): ?RentReceipt
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

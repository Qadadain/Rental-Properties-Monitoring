<?php

namespace App\Repository;

use App\Entity\RentalPropertyAccounting;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RentalPropertyAccounting|null find($id, $lockMode = null, $lockVersion = null)
 * @method RentalPropertyAccounting|null findOneBy(array $criteria, array $orderBy = null)
 * @method RentalPropertyAccounting[]    findAll()
 * @method RentalPropertyAccounting[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RentalPropertyAccountingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RentalPropertyAccounting::class);
    }

    public function totalRentalPropertyAccounting()
    {
        return $this->createQueryBuilder('rpa')
            ->select('SUM(rpa.value)')
            ->getQuery()->getOneOrNullResult();
    }

    public function sumByLabel($label)
    {
        return$this->createQueryBuilder('rpa')
            ->select('SUM(rpa.value)')
            ->andWhere('rpa.label = :label')
            ->setParameter('label', $label)
            ->getQuery()->getResult();
    }
}

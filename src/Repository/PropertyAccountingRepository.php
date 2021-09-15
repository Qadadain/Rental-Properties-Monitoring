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

    public function totalPropertyAccounting()
    {
        return $this->createQueryBuilder('p')
            ->select('SUM(p.value)')
            ->getQuery()->getOneOrNullResult();
    }

    public function sumByLabel($label)
    {
        return $this->createQueryBuilder('pa')
            ->select('SUM(pa.value)')
            ->andWhere('pa.label = :label')
            ->setParameter('label', $label)
            ->getQuery()->getResult();
    }
}

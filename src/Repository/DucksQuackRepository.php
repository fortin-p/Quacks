<?php

namespace App\Repository;

use App\Entity\DucksQuack;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DucksQuack|null find($id, $lockMode = null, $lockVersion = null)
 * @method DucksQuack|null findOneBy(array $criteria, array $orderBy = null)
 * @method DucksQuack[]    findAll()
 * @method DucksQuack[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DucksQuackRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DucksQuack::class);
    }

    // /**
    //  * @return DucksQuack[] Returns an array of DucksQuack objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DucksQuack
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

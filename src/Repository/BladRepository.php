<?php

namespace App\Repository;

use App\Entity\Blad;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Blad|null find($id, $lockMode = null, $lockVersion = null)
 * @method Blad|null findOneBy(array $criteria, array $orderBy = null)
 * @method Blad[]    findAll()
 * @method Blad[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BladRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Blad::class);
    }

    // /**
    //  * @return Blad[] Returns an array of Blad objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Blad
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

<?php

namespace App\Repository;

use App\Entity\TypOdznaki;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method TypOdznaki|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypOdznaki|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypOdznaki[]    findAll()
 * @method TypOdznaki[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypOdznakiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypOdznaki::class);
    }

    // /**
    //  * @return TypOdznaki[] Returns an array of TypOdznaki objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypOdznaki
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

<?php

namespace App\Repository;

use App\Entity\PrzodownikTurystykiGorskiejPTTK;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PrzodownikTurystykiGorskiejPTTK|null find($id, $lockMode = null, $lockVersion = null)
 * @method PrzodownikTurystykiGorskiejPTTK|null findOneBy(array $criteria, array $orderBy = null)
 * @method PrzodownikTurystykiGorskiejPTTK[]    findAll()
 * @method PrzodownikTurystykiGorskiejPTTK[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PrzodownikTurystykiGorskiejPTTKRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PrzodownikTurystykiGorskiejPTTK::class);
    }

    // /**
    //  * @return PrzodownikTurystykiGorskiejPTTK[] Returns an array of PrzodownikTurystykiGorskiejPTTK objects
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
    public function findOneBySomeField($value): ?PrzodownikTurystykiGorskiejPTTK
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

<?php

namespace App\Repository;

use App\Entity\Follow;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Follow|null find($id, $lockMode = null, $lockVersion = null)
 * @method Follow|null findOneBy(array $criteria, array $orderBy = null)
 * @method Follow[]    findAll()
 * @method Follow[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FollowRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Follow::class);
    }

    // /**
    //  * @return Follow[] Returns an array of Follow objects
    //  */
    
    public function findByUserId($value)
    {
        return $this->createQueryBuilder('f')
            ->select('f.follow_id')
            ->where('f.user_id = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }
    
    public function findOneBySomeField($value, $value1): ?Follow
    {
        return $this->createQueryBuilder('f')
            ->where('f.user_id = :val AND f.follow_id = :val1')
            ->setParameter('val', $value)
            ->setParameter('val1', $value1)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}

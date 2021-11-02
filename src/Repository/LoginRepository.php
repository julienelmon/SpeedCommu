<?php

namespace App\Repository;

use App\Entity\Login;
use App\Entity\PeopleSearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\PasswordUpgraderInterface;

/**
 * @method Login|null find($id, $lockMode = null, $lockVersion = null)
 * @method Login|null findOneBy(array $criteria, array $orderBy = null)
 * @method Login[]    findAll()
 * @method Login[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class LoginRepository extends ServiceEntityRepository implements PasswordUpgraderInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Login::class);
    }

    /**
     * Used to upgrade (rehash) the user's password automatically over time.
     */
    public function upgradePassword(PasswordAuthenticatedUserInterface $user, string $newHashedPassword): void
    {
        if (!$user instanceof Login) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', \get_class($user)));
        }

        $user->setPassword($newHashedPassword);
        $this->_em->persist($user);
        $this->_em->flush();
    }

     /**
      * @return Login[] Returns an array of Login objects
      */
    
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findLatest()
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.visible = true')
            ->setMaxResults(5)
            ->orderBy('u.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }
    
    public function findOneBySomeField($value): ?Login
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }

    public function findBySearch($category)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.category = :category')
            ->setParameter('category', $category->getCategory())
            ->orderBy('u.id', 'DESC')
            ->getQuery()
            ->getResult()
        ;
    }
    /*
    public function findByFollowId($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.post = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
<?php

namespace App\Repository;

use App\Entity\Contatct;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Contatct|null find($id, $lockMode = null, $lockVersion = null)
 * @method Contatct|null findOneBy(array $criteria, array $orderBy = null)
 * @method Contatct[]    findAll()
 * @method Contatct[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ContatctRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Contatct::class);
    }

    // /**
    //  * @return Contatct[] Returns an array of Contatct objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Contatct
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

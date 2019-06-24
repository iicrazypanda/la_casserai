<?php

namespace App\Repository;

use App\Entity\Functie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Functie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Functie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Functie[]    findAll()
 * @method Functie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FunctieRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Functie::class);
    }

    // /**
    //  * @return Functie[] Returns an array of Functie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Functie
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

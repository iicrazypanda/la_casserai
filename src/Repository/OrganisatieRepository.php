<?php

namespace App\Repository;

use App\Entity\Organisatie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Organisatie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Organisatie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Organisatie[]    findAll()
 * @method Organisatie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class OrganisatieRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Organisatie::class);
    }

    // /**
    //  * @return Organisatie[] Returns an array of Organisatie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Organisatie
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

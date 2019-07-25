<?php

namespace App\Repository;

use App\Entity\Panier;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use App\Entity\Client;
use App\Entity\Produit;

/**
 * @method Panier|null find($id, $lockMode = null, $lockVersion = null)
 * @method Panier|null findOneBy(array $criteria, array $orderBy = null)
 * @method Panier[]    findAll()
 * @method Panier[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PanierRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Panier::class);
    }

    // /**
    //  * @return Panier[] Returns an array of Panier objects
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

    public function findPanierByClientAndProduct (Client $client, Produit $produit): ? Panier {
    return $this->createQueryBuilder('p')
        ->andWhere('p.client = :cli')
        ->setParameter('cli', $client)
        ->andWhere('p.produit = :pro')
        ->setParameter('pro', $produit)
        ->getQuery()
        ->getOneOrNullResult();
}
    
    // public function findPanierByClientAndProduct($clientId, $produitId): ?Panier
    // {
    //     return $this->createQueryBuilder('p')
    //         ->andWhere('p.client_id = :cli')
    //         ->setParameter('cli', $clientId)
    //         ->andWhere('p.produit_id = :pro')
    //         ->setParameter('pro', $produitId)
    //         ->getQuery()
    //         ->getOneOrNullResult()
    //     ;
    // }
    
}

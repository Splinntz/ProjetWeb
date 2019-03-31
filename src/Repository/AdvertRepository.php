<?php

namespace App\Repository;

use App\Entity\Advert;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Elastica\Processor\Date;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Advert|null find($id, $lockMode = null, $lockVersion = null)
 * @method Advert|null findOneBy(array $criteria, array $orderBy = null)
 * @method Advert[]    findAll()
 * @method Advert[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AdvertRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Advert::class);
    }

   /* public function findByUserId($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.idUser = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }*/

    public function findWithFilter($date,$price,$disciplines){


        $query =  $this->createQueryBuilder('a');

        if($date != null){

            $dateAux = new \DateTime($date->format("Y-m-d"));
            $dateAux->format("Y-m-d");
            $query->andWhere('a.date >= :valDate1')->setParameter('valDate1',$dateAux);
        }
        if ($price != null){
            $query->andWhere('a.price <= :val+10')->andWhere('a.price >= :val-10')->setParameter('val',$price);
        }
        if ($disciplines != null){
            $query->innerJoin('a.disciplines', 'p','WITH', 'p.name=:valdis')->setParameter('valdis',$disciplines);
        }

        return $query->getQuery()->getResult();
    }


    // /**
    //  * @return Advert[] Returns an array of Advert objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Advert
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */


}

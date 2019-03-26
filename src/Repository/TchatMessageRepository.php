<?php

namespace App\Repository;

use App\Entity\TchatMessage;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TchatMessage|null find($id, $lockMode = null, $lockVersion = null)
 * @method TchatMessage|null findOneBy(array $criteria, array $orderBy = null)
 * @method TchatMessage[]    findAll()
 * @method TchatMessage[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TchatMessageRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TchatMessage::class);
    }

    // /**
    //  * @return TchatMessage[] Returns an array of TchatMessage objects
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

    
    public function findOneById($value): ?TchatMessage
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.id  = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    
}

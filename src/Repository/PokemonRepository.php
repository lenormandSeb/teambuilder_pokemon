<?php

namespace App\Repository;

use App\Entity\Pokemon;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Pokemon|null find($id, $lockMode = null, $lockVersion = null)
 * @method Pokemon|null findOneBy(array $criteria, array $orderBy = null)
 * @method Pokemon[]    findAll()
 * @method Pokemon[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PokemonRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Pokemon::class);
    }

    public function findAllByNumDex()
    {
        return $this->createQueryBuilder('p')
                ->orderBy('p.num_dex', 'ASC')
                ->getQuery()
                ->getResult()
        ;
    }
    // /**
    //  * @return Pokemon[] Returns an array of Pokemon objects
    //  */
    public function findByGeneration($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.generation = :val')
            ->setParameter('val', $value)
            ->orderBy('p.num_dex', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByNumDex($value): ?Pokemon
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.num_dex = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
}

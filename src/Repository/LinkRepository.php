<?php

namespace App\Repository;

use App\Entity\Link;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class LinkRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Link::class);
    }

    public function findAllValids()
    {
        return $this->createQueryBuilder('l')
            ->where('l.invalid = 0')
            ->getQuery()
            ->getResult();
    }

    public function countActive()
    {
        return $this->createQueryBuilder('l')
            ->select('COUNT(1)')
            ->where('l.active = 1')
            ->getQuery()
            ->getSingleScalarResult();
    }

    public function randomLink($max)
    {
        $rand = rand(0, $max - 1);

        return $this->createQueryBuilder('l')
            ->where('l.active = 1')
            ->setMaxResults(1)
            ->setFirstResult($rand)
            ->getQuery()
            ->getSingleResult();
    }

    /*
public function findBySomething($value)
{
return $this->createQueryBuilder('l')
->where('l.something = :value')->setParameter('value', $value)
->orderBy('l.id', 'ASC')
->setMaxResults(10)
->getQuery()
->getResult()
;
}
 */
}

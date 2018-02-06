<?php

namespace App\Repository;

use App\Entity\LinkDetails;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class LinkDetailsRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, LinkDetails::class);
    }

    public function findByUpdatable()
    {
        return $this->createQueryBuilder('ld')
            ->where('ld.updateDate IS NULL')
            ->orWhere('DATE_DIFF(ld.updateDate, CURRENT_TIME()) > 7')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult();
    }

}

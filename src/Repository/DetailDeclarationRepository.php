<?php

namespace App\Repository;

use App\Entity\DetailDeclaration;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<DetailDeclaration>
 *
 * @method DetailDeclaration|null find($id, $lockMode = null, $lockVersion = null)
 * @method DetailDeclaration|null findOneBy(array $criteria, array $orderBy = null)
 * @method DetailDeclaration[]    findAll()
 * @method DetailDeclaration[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetailDeclarationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DetailDeclaration::class);
    }

//    /**
//     * @return DetailDeclaration[] Returns an array of DetailDeclaration objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('d.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?DetailDeclaration
//    {
//        return $this->createQueryBuilder('d')
//            ->andWhere('d.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

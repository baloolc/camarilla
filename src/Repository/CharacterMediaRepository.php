<?php

namespace App\Repository;

use App\Entity\CharacterMedia;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<CharacterMedia>
 *
 * @method CharacterMedia|null find($id, $lockMode = null, $lockVersion = null)
 * @method CharacterMedia|null findOneBy(array $criteria, array $orderBy = null)
 * @method CharacterMedia[]    findAll()
 * @method CharacterMedia[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CharacterMediaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CharacterMedia::class);
    }

    public function save(CharacterMedia $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(CharacterMedia $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

//    /**
//     * @return CharacterMedia[] Returns an array of CharacterMedia objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('c.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?CharacterMedia
//    {
//        return $this->createQueryBuilder('c')
//            ->andWhere('c.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

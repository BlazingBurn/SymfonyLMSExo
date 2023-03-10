<?php

namespace App\Repository;

use App\Entity\Product;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Product>
 *
 * @method Product|null find($id, $lockMode = null, $lockVersion = null)
 * @method Product|null findOneBy(array $criteria, array $orderBy = null)
 * @method Product[]    findAll()
 * @method Product[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProductRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Product::class);
    }

    public function save(Product $entity, bool $flush = false): void
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function remove(Product $entity, bool $flush = false): void
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }
    }

    public function select3Random(): array
    {
        return $this->createQueryBuilder('p')
            ->orderBy('RAND()')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult()
        ;
    }
    
    public function nbTotalProduct(): int
    {
        return $this->createQueryBuilder('p')
        ->select('COUNT(p.id)')
        ->getQuery()
        ->getSingleScalarResult()
        ;
    }

    public function select12Page($page): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.id < :val1 and p.id > :val2')
            ->setParameter('val1', $page*12)
            ->setParameter('val2', ($page-1)*12)
            ->setMaxResults(12)
            ->getQuery()
            ->getResult()
        ;
    }

    public function search($research): array
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.name LIKE :research')
            ->setParameter('research', '%'.$research.'%')
            ->getQuery()
            ->getResult()
        ;
    }

//    /**
//     * @return Product[] Returns an array of Product objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('p.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Product
//    {
//        return $this->createQueryBuilder('p')
//            ->andWhere('p.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}

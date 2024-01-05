<?php

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Article>
 *
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Article::class);
    }

    public function getRecentArticles(int $count)
    {
        return $this->createQueryBuilder('article')
            ->orderBy('article.createdAt', 'desc')
            ->getQuery()
            ->setMaxResults($count)
            ->getResult();

    }
    public function searchArticles(string $searchTerm)
    {
        return $this->createQueryBuilder('article')
            ->where('article.title = :searchTerm')
            ->setParameter('searchTerm', $searchTerm)
            ->getQuery()
            ->getResult();
    }

    public function findBySearchQuery(string $searchTerm): array
    {
        $qb = $this->createQueryBuilder('a');

        return $qb->where($qb->expr()->like('a.title', ':searchTerm'))
            ->orWhere($qb->expr()->like('a.body', ':searchTerm'))
            ->setParameter('searchTerm', '%' . $searchTerm . '%')
            ->getQuery()
            ->getResult();
    }
}


//    /**
//     * @return Article[] Returns an array of Article objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('a.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Article
//    {
//        return $this->createQueryBuilder('a')
//            ->andWhere('a.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
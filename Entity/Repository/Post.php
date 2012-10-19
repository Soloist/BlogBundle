<?php

namespace Soloist\Bundle\BlogBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Post repository
 */
class Post extends EntityRepository
{
    /**
     * Returns the query for getting the last lead post, last post if no lead
     *
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function findLeadQueryBuilder()
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.isLead', 'DESC')
            ->orderBy('p.createdAt', 'DESC')
            ->setMaxResults(1)
        ;
    }

    /**
     * Returns the last lead post, last post if no lead
     *
     * @return Soloist\Bundle\BlogBundle\Entity\Post
     */
    public function findLead()
    {
        return $this
            ->findLeadQueryBuilder()
            ->getQuery()
            ->getSingleResult()
        ;
    }

    /**
     * Returns the query for retrieving last blog posts
     *
     * @param $nb
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function findLastsQueryBuilder($nb)
    {
        return $this->createQueryBuilder('p')
            ->orderBy('p.createdAt', 'DESC')
            ->setMaxResults($nb)
        ;
    }

    /**
     * Returns the lasts blog posts
     *
     * @param int $nb
     * @return array
     */
    public function findLasts($nb = 5)
    {
        return $this
            ->findLastsQueryBuilder($nb)
            ->getQuery()
            ->getResult()
        ;
    }

    public function findByCategory($category, $limit = 5)
    {
        return $this
            ->findBy(array('category' => $category), array('publishedAt' => 'DESC'), $limit)
        ;
    }
}

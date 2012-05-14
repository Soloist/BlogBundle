<?php

namespace Soloist\Bundle\BlogBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;

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
}

<?php

namespace AppBundle\Repository;
use Doctrine\ORM\Tools\Pagination\Paginator;


/**
 * ThemeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ThemeRepository extends \Doctrine\ORM\EntityRepository
{
    public function findByPage($page = 1, $count = 20)
    {
        $query = $this->createQueryBuilder('th')
            ->select('th.name, th.description, th.author')
            ->setFirstResult($page)
            ->setMaxResults($count);

        return $query->getQuery()->getResult();
    }
}
<?php

namespace AppBundle\Repository;

/**
 * ProductRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProductRepository extends \Doctrine\ORM\EntityRepository
{
    /**
     * @return array
     */
    public function getProductList()
    {
        $queryBuilder = $this->createQueryBuilder('c');
        $queryBuilder->where($queryBuilder->expr()->isNull('c.deleted'));
        $queryBuilder->andWhere($queryBuilder->expr()->eq('c.published', ':published'));
        $queryBuilder->setParameters(['published' => 1]);
        $queryBuilder->orderBy('c.id', 'desc');
        return $queryBuilder->getQuery()->getResult();
    }
}

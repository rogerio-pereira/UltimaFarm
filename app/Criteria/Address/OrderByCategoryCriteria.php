<?php

namespace App\Criteria\Address;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class CategoryCriteria.
 *
 * @package namespace App\Criteria\Address;
 */
class OrderByCategoryCriteria implements CriteriaInterface
{
    /**
     * Apply criteria in query repository
     *
     * @param string              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */
    public function apply($model, RepositoryInterface $repository)
    {
        $model = $model
                    ->orderBY('address_category_id');

        return $model;
    }
}

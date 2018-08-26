<?php

namespace App\Criteria\Painel;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class UserNotClientCriteria.
 *
 * @package namespace App\Criteria\Painel;
 */
class UserNotClientCriteria implements CriteriaInterface
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
        $model = $model->where('role', '<>', 'Cliente');
        return $model;
    }
}

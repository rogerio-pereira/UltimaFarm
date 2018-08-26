<?php

namespace App\Criteria\Painel\Investor;

use Illuminate\Support\Facades\Auth;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class InvestorCriteria.
 *
 * @package namespace App\Criteria\Painel\Investor;
 */
class InvestorCriteria implements CriteriaInterface
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
        $model = $model->where(['client_id' => Auth::user()->client->id]);
        
        return $model;
    }
}

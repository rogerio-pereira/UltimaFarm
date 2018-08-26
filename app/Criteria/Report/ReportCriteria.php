<?php

namespace App\Criteria\Report;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class ReportCriteria.
 *
 * @package namespace App\Criteria\Report;
 */
class ReportCriteria implements CriteriaInterface
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
        $beginDate = Carbon::now()->subYear()->startOfMonth();

        $model = $model
                    ->groupBy(DB::raw("YEAR(created_at)"))
                    ->groupBy(DB::raw("MONTH(created_at)"))
                    ->where('created_at', '>', "'".$beginDate."'")
                    ->orderBy('y')
                    ->orderBy('m');

        return $model;
    }
}

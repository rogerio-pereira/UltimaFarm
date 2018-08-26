<?php

namespace App\Criteria\Blog;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class ArchiveCriteria.
 *
 * @package namespace App\Criteria\Blog;
 */
class ArchiveCriteria implements CriteriaInterface
{
    private $year;
    private $month;

    public function __construct($year, $month)
    {
        $this->year = $year;
        $this->month = $month;
    }

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
                    ->whereYear('created_at', '=', $this->year)
                    ->whereMonth('created_at', '=', $this->month)
                    ->orderBy('created_at', 'DESC');

        return $model;
    }
}

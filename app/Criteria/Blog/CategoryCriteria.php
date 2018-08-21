<?php

namespace App\Criteria\Blog;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class CategoryCriteria.
 *
 * @package namespace App\Criteria\Blog;
 */
class CategoryCriteria implements CriteriaInterface
{
    private $categoryId;

    public function __construct($categoryId)
    {
        $this->categoryId = $categoryId;
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
        $model = $model->where('post_category_id', $this->categoryId);

        return $model;
    }
}

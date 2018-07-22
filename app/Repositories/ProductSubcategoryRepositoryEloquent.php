<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ProductSubcategoryRepository;
use App\Models\ProductSubcategory;
use App\Validators\ProductSubcategoryValidator;

/**
 * Class ProductSubcategoryRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ProductSubcategoryRepositoryEloquent extends BaseRepository implements ProductSubcategoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ProductSubcategory::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}

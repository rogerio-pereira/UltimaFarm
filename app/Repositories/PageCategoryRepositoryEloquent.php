<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PageCategoryRepository;
use App\Models\PageCategory;
use App\Validators\PageCategoryValidator;

/**
 * Class PageCategoryRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class PageCategoryRepositoryEloquent extends BaseRepository implements PageCategoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PageCategory::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}

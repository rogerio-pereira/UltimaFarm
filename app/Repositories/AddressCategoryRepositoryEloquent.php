<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\AddressCategoryRepository;
use App\Models\AddressCategory;
use App\Validators\AddressCategoryValidator;

/**
 * Class AddressCategoryRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class AddressCategoryRepositoryEloquent extends BaseRepository implements AddressCategoryRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return AddressCategory::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}

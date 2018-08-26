<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\BusinessInfoRepository;
use App\Models\BusinessInfo;
use App\Validators\BusinessInfoValidator;

/**
 * Class BusinessInfoRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class BusinessInfoRepositoryEloquent extends BaseRepository implements BusinessInfoRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return BusinessInfo::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}

<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\ComissionRepository;
use App\Models\Comission;
use App\Validators\ComissionValidator;

/**
 * Class ComissionRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class ComissionRepositoryEloquent extends BaseRepository implements ComissionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Comission::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}

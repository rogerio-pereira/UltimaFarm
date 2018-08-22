<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\DepoimentRepository;
use App\Models\Depoiment;
use App\Validators\DepoimentValidator;

/**
 * Class DepoimentRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class DepoimentRepositoryEloquent extends BaseRepository implements DepoimentRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Depoiment::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}

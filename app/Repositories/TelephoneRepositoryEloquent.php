<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\TelephoneRepository;
use App\Models\Telephone;
use App\Validators\TelephoneValidator;

/**
 * Class TelephoneRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class TelephoneRepositoryEloquent extends BaseRepository implements TelephoneRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Telephone::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}

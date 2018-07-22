<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\PermissionUserRepository;
use App\Models\PermissionUser;
use App\Validators\PermissionUserValidator;

/**
 * Class PermissionUserRepositoryEloquent
 * @package namespace App\Repositories;
 */
class PermissionUserRepositoryEloquent extends BaseRepository implements PermissionUserRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PermissionUser::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}

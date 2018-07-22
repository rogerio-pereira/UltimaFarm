<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\SocialMediaRepository;
use App\Models\SocialMedia;
use App\Validators\SocialMediaValidator;

/**
 * Class SocialMediaRepositoryEloquent.
 *
 * @package namespace App\Repositories;
 */
class SocialMediaRepositoryEloquent extends BaseRepository implements SocialMediaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return SocialMedia::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}

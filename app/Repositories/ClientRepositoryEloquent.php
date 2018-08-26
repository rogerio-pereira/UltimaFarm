<?php

namespace App\Repositories;

use App\Models\Client;
use App\Repositories\ClientRepository;
use App\Validators\ClientValidator;
use Illuminate\Support\Facades\DB;
use Prettus\Repository\Criteria\RequestCriteria;
use Prettus\Repository\Eloquent\BaseRepository;

/**
 * Class ClientRepositoryEloquent
 * @package namespace App\Repositories;
 */
class ClientRepositoryEloquent extends BaseRepository implements ClientRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Client::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    /**
     * Generate Array to be used in comboboxes
     * @return array Title,ID
     */
    public function comboboxList()
    {
        return $this->model
                    ->join('users', 'clients.user_id', '=', 'users.id')
                    ->orderBy('users.name')
                    ->pluck('users.name', 'clients.id');
    }
}

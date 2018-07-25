<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Spatie\Activitylog\Traits\LogsActivity;

class Client extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;
    use LogsActivity;

    protected $fillable = [
        'name',
        'email',
        'telephone',
        'document',
        'zipcode',
        'street',
        'number',
        'complement',
        'neighborhood',
        'city',
        'state',
        'created_at'
    ];
    
    /*
     * The attributes that are logged
     *
     * @var array
     */
    protected static $logAttributes = [
        'id', 
        'name',
        'email',
        'telephone',
        'document',
        'zipcode',
        'street',
        'number',
        'complement',
        'neighborhood',
        'city',
        'state',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['created_at', 'deleted_at'];

}
